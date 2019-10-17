<?php

namespace App\Services;

use App\Figure;
use Figures\DTO\FigureDTO;
use Figures\Interfaces\FigureServiceInterface;

class FigureService implements FigureServiceInterface
{

    public function create(FigureDTO $figure): FigureDTO
    {
        $newFigure = new Figure();
        $newFigure->id = $figure->getId();
        $newFigure->color = $figure->getColor();
        $newFigure->type = $figure->getType();
        $newFigure->revision = $figure->getRevision();
        $newFigure->save();

        return $newFigure->convertToDTO();
    }

    /**
     * @return array|FigureDTO[]
     */
    public function list(): array
    {
        return Figure::actualRecords()
            ->orderBy('id')
            ->orderByDesc('revision')
            ->get()
            ->map(static function (Figure $figure) {
                return $figure->convertToDTO();
            })->toArray();
    }

    public function getRandom(): FigureDTO
    {
        $figure = Figure::actualRecords()->inRandomOrder()->firstOrFail();

        return $figure ? $figure->convertToDTO() : null;
    }
}
