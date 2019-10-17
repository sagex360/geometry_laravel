<?php

namespace Figures\Mappers;

use Figures\DTO\FigureDTO;

class FiguresMapper
{
    public const TYPES = [
        3 => 'triangle',
        4 => 'quadrangle',
        5 => 'pentagon',
        6 => 'hexagon'
    ];

    public const COLORS = [
        '#1771F1' => 'blue',
        '#64C7FF' => 'light blue',
        '#48CFAF' => 'green',
        '#FFF851' => 'yellow',
        '#F85C50' => 'red'
    ];

    /**
     * @param array|FigureDTO $figures
     * @return array
     */
    public function map(array $figures): array
    {
        return array_map(static function (FigureDTO $figure) {
            $color = ucfirst(self::COLORS[$figure->getColor()] ?? 'unknown color');
            $type = self::TYPES[$figure->getType()] ?? 'unknown figure';

            return [
                'description' => "{$color} {$type} #{$figure->getId()}",
                'type' => $figure->getType(),
                'color' => $figure->getColor()
            ];
        }, $figures);
    }
}
