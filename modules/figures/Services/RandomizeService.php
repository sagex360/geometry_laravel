<?php

namespace Figures\Services;

use Figures\Mappers\FiguresMapper;

class RandomizeService
{
    public function getRandomType(int $maxQuantityAngle = 6): int
    {
        return rand(3, $maxQuantityAngle);
    }

    public function getRandomQuantity(int $min = 1, $max = 5): int
    {
        return rand($min, $max);
    }

    public function getRandomColor(string $exclude = null): string
    {
        $colors = array_keys(FiguresMapper::COLORS);

        if ($exclude) {
            $excludeKey = array_search($exclude, $colors, true);
            unset($colors[$excludeKey]);
        }

        return $colors[array_rand($colors)];
    }

    public function getID(): string
    {
        return uniqid('', false);
    }
}
