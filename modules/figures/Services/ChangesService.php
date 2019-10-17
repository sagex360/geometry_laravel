<?php

namespace Figures\Services;

use Figures\DTO\ChangeDTO;
use Figures\DTO\FigureDTO;
use Figures\DTO\RevisionDTO;
use Figures\Interfaces\RevisionServiceInterface;

class ChangesService
{
    /** @var RevisionServiceInterface */
    private $revisionService;

    public function __construct(RevisionServiceInterface $revisionService)
    {
        $this->revisionService = $revisionService;
    }

    /**
     * @return array|ChangeDTO[]
     */
    public function getList(): array
    {
        return array_map(function (RevisionDTO $revision) {
            return new ChangeDTO($revision->getSequence(), $this->getChangesDescription($revision));
        }, $this->revisionService->getAllRevisions());
    }

    /**
     * @param RevisionDTO $revision
     * @return array|string[]
     */
    private function getChangesDescription(RevisionDTO $revision): array
    {
        if (!$revision->getPreviousFigures()) {
            return ["Has been generated {$revision->getFiguresQuantity()} figures"];
        }

        $descriptions = [];
        foreach ($revision->getFigures() as $figure) {
            $previousFigure = $this->getChangedFigure($revision->getPreviousFigures(), $figure);

            if (!$previousFigure) {
                $descriptions[] = "Has been created figure #{$figure->getId()}";
                continue;
            }

            if ($previousFigure->getColor() !== $figure->getColor()) {
                $descriptions[] = "Color for figure #{$figure->getId()} has been changed";
                continue;
            }
        }

        return $descriptions;
    }

    /**
     * @param array|FigureDTO $previousFigures
     * @param FigureDTO $figureDTO
     * @return FigureDTO|null
     */
    private function getChangedFigure(array $previousFigures, FigureDTO $figureDTO):? FigureDTO
    {
        return array_filter($previousFigures, static function (FigureDTO $previousFigure) use ($figureDTO) {
                return $previousFigure->getId() === $figureDTO->getId();
            })[0] ?? null;
    }
}
