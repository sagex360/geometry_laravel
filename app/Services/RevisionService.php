<?php

namespace App\Services;

use App\Figure;
use Figures\DTO\FigureDTO;
use Figures\DTO\RevisionDTO;
use Figures\Interfaces\RevisionServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class RevisionService implements RevisionServiceInterface
{

    public function getCurrentRevision(): int
    {
        return (int)Figure::max('revision');
    }

    public function getNextRevision(): int
    {
        return $this->getCurrentRevision() + 1;
    }

    /**
     * @return array|RevisionDTO[]
     */
    public function getAllRevisions(): array
    {
        $figures = Figure::all();
        $groupedByRevision = $figures->groupBy('revision');
        /** @var array|RevisionDTO[] $revisions */
        $revisions = [];

        foreach ($groupedByRevision as $sequence => $revision) {
            $revisionFigures = $revision->map(static function (Figure $figure) {
                return $figure->convertToDTO();
            })->toArray();

            $previousRevisionFigures = $this->getPreviousRevision($revisionFigures, $figures);

            $revisions[] = new RevisionDTO($sequence, $revisionFigures, $previousRevisionFigures);
        }

        return $revisions;
    }

    public function revertLastRevisions(int $quantity): void
    {
        $revisionsListQuery = DB::table('figures')->select(['revision'])
            ->groupBy('revision')
            ->orderBy('revision', 'desc')
            ->limit($quantity);

        Figure::joinSub($revisionsListQuery, 'list', 'list.revision', '=', 'figures.revision')->delete();
    }

    public function revertRevision(int $revision): void
    {
        $relatedFigures = Figure::where('revision', $revision)->pluck('id');
        Figure::whereIn('id', $relatedFigures)->where('revision', '>=', $revision)->delete();
    }

    /**
     * @param array|FigureDTO[] $figures
     * @param Collection|Figure[] $allFigures
     * @return array|FigureDTO[]
     */
    private function getPreviousRevision(array $figures, Collection $allFigures): array
    {
        $previousRevisionFigures = [];

        foreach ($figures as $figure) {
            /** @var null|Figure $previousRevisionFigure */
            $previousRevisionFigure = $allFigures->where('id', $figure->getId())
                ->where('revision', '<', $figure->getRevision())
                ->sortByDesc('revision')
                ->first();

            if ($previousRevisionFigure) {
                $previousRevisionFigures[] = $previousRevisionFigure->convertToDTO();
            }
        }

        return $previousRevisionFigures;
    }
}
