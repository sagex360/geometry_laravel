<?php

namespace Figures\Interfaces;

use Figures\DTO\RevisionDTO;

interface RevisionServiceInterface
{
    public function getCurrentRevision(): int;

    public function getNextRevision(): int;

    /**
     * @return array|RevisionDTO[]
     */
    public function getAllRevisions(): array;

    public function revertLastRevisions(int $quantity): void;

    public function revertRevision(int $revision): void;
}
