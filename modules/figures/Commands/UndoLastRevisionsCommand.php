<?php

namespace Figures\Commands;

use Figures\Interfaces\RevisionServiceInterface;

class UndoLastRevisionsCommand
{
    /** @var RevisionServiceInterface */
    private $revisionService;

    public function __construct(RevisionServiceInterface $revisionService)
    {
        $this->revisionService = $revisionService;
    }

    public function execute(int $quantity = 1): void
    {
        $this->revisionService->revertLastRevisions($quantity);
    }
}
