<?php

namespace Figures\Mappers;

use Figures\DTO\ChangeDTO;
use Figures\DTO\FigureDTO;

class ResponseMapper
{
    /** @var FiguresMapper */
    private $figuresMapper;

    /** @var ChangesMapper */
    private $changesMapper;

    public function __construct(FiguresMapper $figuresMapper, ChangesMapper $changesMapper)
    {
        $this->figuresMapper = $figuresMapper;
        $this->changesMapper = $changesMapper;
    }

    /**
     * @param array|FigureDTO[] $figures
     * @param array|ChangeDTO[] $changes
     * @return array
     */
    public function map(array $figures, array $changes): array
    {
        return [
            'figures' => $this->figuresMapper->map($figures),
            'history' => $this->changesMapper->map($changes)
        ];
    }
}
