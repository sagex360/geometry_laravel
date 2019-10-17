<?php

namespace Figures\Commands;

use Figures\Interfaces\RevisionServiceInterface;

class UndoRevisionCommand
{
    /** @var RevisionServiceInterface */
    private $revisionService;

    public function __construct(RevisionServiceInterface $revisionService)
    {
        $this->revisionService = $revisionService;
    }

    public function execute(int $revision): void
    {
        $this->revisionService->revertRevision($revision);
    }
}
