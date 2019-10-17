<?php

namespace App\Http\Controllers;

use App\Services\FigureService;
use Figures\Commands\UndoLastRevisionsCommand;
use Figures\Commands\UndoRevisionCommand;
use Figures\Mappers\ResponseMapper;
use Figures\Services\ChangesService;
use Illuminate\Http\JsonResponse;

class RevisionsController extends Controller
{
    /** @var UndoRevisionCommand */
    private $undoRevisionCommand;

    /** @var ResponseMapper */
    private $responseMapper;

    /** @var FigureService */
    private $figureService;

    /** @var ChangesService */
    private $changesService;

    /** @var UndoLastRevisionsCommand */
    private $undoLastRevisionsCommand;

    public function __construct(
        UndoRevisionCommand $undoRevisionCommand,
        ResponseMapper $responseMapper,
        FigureService $figureService,
        ChangesService $changesService,
        UndoLastRevisionsCommand $undoLastRevisionsCommand
    ) {
        $this->undoRevisionCommand = $undoRevisionCommand;
        $this->responseMapper = $responseMapper;
        $this->figureService = $figureService;
        $this->changesService = $changesService;
        $this->undoLastRevisionsCommand = $undoLastRevisionsCommand;
    }

    public function revert(int $revision): JsonResponse
    {
        $this->undoRevisionCommand->execute($revision);

        return response()->json(
            $this->responseMapper->map($this->figureService->list(), $this->changesService->getList())
        );
    }

    public function revertLast(int $quantity): JsonResponse
    {
        $this->undoLastRevisionsCommand->execute($quantity);

        return response()->json(
            $this->responseMapper->map($this->figureService->list(), $this->changesService->getList())
        );
    }
}
