<?php

namespace App;

use Figures\DTO\FigureDTO;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Figure
 *
 * @property int $uid
 * @property string $id
 * @property int $type
 * @property string $color
 * @property int $revision
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Figure newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Figure newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Figure query()
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Figure actualRecords()
 */
class Figure extends Model
{
    protected $primaryKey = 'uid';

    public $timestamps = false;

    public function convertToDTO(): FigureDTO
    {
        return new FigureDTO($this->id, $this->type, $this->color, $this->revision, $this->uid);
    }

    public function scopeActualRecords(Builder $builder)
    {
        return $builder->whereIn('uid', self::selectRaw('Max(uid)')->groupBy('id'));
    }


}
