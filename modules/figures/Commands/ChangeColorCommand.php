<?php

namespace Figures\Commands;

use Figures\DTO\FigureDTO;
use Figures\Interfaces\FigureServiceInterface;
use Figures\Interfaces\RevisionServiceInterface;
use Figures\Services\RandomizeService;

class ChangeColorCommand
{
    /** @var FigureServiceInterface */
    private $figureService;

    /** @var RandomizeService */
    private $randomizeService;

    /** @var RevisionServiceInterface */
    private $revisionService;

    public function __construct(
        FigureServiceInterface $figureService,
        RevisionServiceInterface $revisionService,
        RandomizeService $randomizeService
    ) {
        $this->figureService = $figureService;
        $this->randomizeService = $randomizeService;
        $this->revisionService = $revisionService;
    }

    public function execute(): void
    {
        $figure = $this->figureService->getRandom();
        $revision = $this->revisionService->getNextRevision();
        $color = $this->randomizeService->getRandomColor($figure->getColor());
        $newFigure = new FigureDTO($figure->getId(), $figure->getType(), $color, $revision);
        $this->figureService->create($newFigure);
    }
}
