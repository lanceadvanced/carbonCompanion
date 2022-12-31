<?php

namespace App\Models;

use App\Traits\Initialize;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FootprintUnit
 * @package App\Models\FootprintUnit
 * @property $title
 * @property $unit
 *
 * @mixin Eloquent
 */
class FootprintUnit extends Model
{
    use HasFactory, Initialize;

    protected $table = 'footprintUnit';
    protected $primaryKey = 'footprintUnitID';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'unit'
    ];

    private array $defaultValues = [
        [
            'title' => 'Gram',
            'unit' => 'g',
        ], [
            'title' => 'Kilogram',
            'unit' => 'kg',
        ], [
            'title' => 'Ton',
            'unit' => 't',
        ]
    ];
}
