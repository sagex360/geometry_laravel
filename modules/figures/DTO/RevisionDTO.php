<?php

namespace Figures\DTO;

class RevisionDTO
{
    /** @var int */
    private $sequence;

    /** @var array|FigureDTO[] */
    private $figures;

    /** @var array|FigureDTO[] */
    private $previousFigures;

    /**
     * RevisionDTO constructor.
     * @param int $sequence
     * @param array|FigureDTO[] $figures
     * @param array|FigureDTO[] $previousFigures
     */
    public function __construct(int $sequence, array $figures, array $previousFigures = [])
    {
        $this->sequence = $sequence;
        $this->figures = $figures;
        $this->previousFigures = $previousFigures;
    }

    public function getSequence(): int
    {
        return $this->sequence;
    }

    /**
     * @return array|FigureDTO[]
     */
    public function getFigures(): array
    {
        return $this->figures;
    }

    public function getFiguresQuantity(): int
    {
        return count($this->figures);
    }

    /**
     * @return array|FigureDTO[]
     */
    public function getPreviousFigures(): array
    {
        return $this->previousFigures;
    }
}
