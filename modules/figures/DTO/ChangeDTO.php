<?php

namespace Figures\DTO;

class ChangeDTO
{
    /** @var int */
    private $revision;

    /** @var array */
    private $description;

    public function __construct(int $revision, array $description)
    {
        $this->revision = $revision;
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getRevision(): int
    {
        return $this->revision;
    }

    /**
     * @return array
     */
    public function getDescription(): array
    {
        return $this->description;
    }
}
