<?php

namespace App\Http\Controllers;

use Figures\Commands\ChangeColorCommand;
use Figures\Commands\CreateCommand;
use Figures\Interfaces\FigureServiceInterface;
use Figures\Mappers\ResponseMapper;
use Figures\Services\ChangesService;
use Illuminate\Http\JsonResponse;

class FiguresController extends Controller
{
    /** @var FigureServiceInterface */
    private $figureService;

    /** @var CreateCommand */
    private $createCommand;

    /** @var ChangeColorCommand */
    private $changeColorCommand;

    /** @var ResponseMapper */
    private $responseMapper;

    /** @var ChangesService */
    private $changesService;

    public function __construct(
        FigureServiceInterface $figureService,
        ChangesService $changesService,
        ResponseMapper $responseMapper,
        CreateCommand $createCommand,
        ChangeColorCommand $changeColorCommand
    ) {
        $this->figureService = $figureService;
        $this->createCommand = $createCommand;
        $this->changeColorCommand = $changeColorCommand;
        $this->responseMapper = $responseMapper;
        $this->changesService = $changesService;
    }

    public function index(): JsonResponse
    {
        return response()->json(
            $this->responseMapper->map($this->figureService->list(), $this->changesService->getList())
        );
    }

    public function store(): JsonResponse
    {
        $this->createCommand->execute();

        return response()->json(
            $this->responseMapper->map($this->figureService->list(), $this->changesService->getList())
        );
    }

    public function changeColor(): JsonResponse
    {
        $this->changeColorCommand->execute();

        return response()->json(
            $this->responseMapper->map($this->figureService->list(), $this->changesService->getList())
        );
    }
}
