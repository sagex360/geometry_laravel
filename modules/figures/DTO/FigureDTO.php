<?php

namespace Figures\DTO;

class FigureDTO
{
    /** @var string */
    private $id;

    /** @var int */
    private $type;

    /** @var string */
    private $color;

    /** @var int */
    private $revision;

    /** @var int|null */
    private $uid;

    public function __construct(string $id, int $type, string $color, int $revision, int $uid = null)
    {
        $this->id = $id;
        $this->type = $type;
        $this->color = $color;
        $this->revision = $revision;
        $this->uid = $uid;
    }

    public function getUid(): ?int
    {
        return $this->uid;
    }

    public function setUid(int $value = null): void
    {
        $this->uid = $value;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function getRevision(): int
    {
        return $this->revision;
    }
}
