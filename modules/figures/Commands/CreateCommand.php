<?php

namespace Figures\Commands;

use Figures\DTO\FigureDTO;
use Figures\Interfaces\FigureServiceInterface;
use Figures\Interfaces\RevisionServiceInterface;
use Figures\Services\RandomizeService;

class CreateCommand
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
        $quantity = $this->randomizeService->getRandomQuantity();
        $revision = $this->revisionService->getNextRevision();

        for ($i = 0; $i < $quantity; $i++) {
            $id = $this->randomizeService->getID();
            $type = $this->randomizeService->getRandomType();
            $color = $this->randomizeService->getRandomColor();
            $this->figureService->create(new FigureDTO($id, $type, $color, $revision));
        }
    }
}
