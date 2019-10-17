<?php

namespace Figures\Mappers;

use Figures\DTO\ChangeDTO;

class ChangesMapper
{
    /**
     * @param array|ChangeDTO[] $changes
     * @return array
     */
    public function map(array $changes): array
    {
        return array_map(static function (ChangeDTO $item) {
            return [
                'id' => $item->getRevision(),
                'description' => $item->getDescription()
            ];
        }, $changes);
    }
}
