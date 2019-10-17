<?php

namespace Figures\Interfaces;

use Figures\DTO\FigureDTO;

interface FigureServiceInterface
{
    public function create(FigureDTO $figure): FigureDTO;

    /**
     * @return array|FigureDTO[]
     */
    public function list(): array;

    public function getRandom(): FigureDTO;
}
