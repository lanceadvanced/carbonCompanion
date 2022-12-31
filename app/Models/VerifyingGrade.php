<?php

namespace App\Models;

use App\Traits\Initialize;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class VerifyingGrade
 * @package App\Models\VerifyingGrade
 * @property $title
 * @property $grade
 *
 * @mixin Eloquent
 */
class VerifyingGrade extends Model
{
    use HasFactory, Initialize;

    protected $table = 'verifyingGrade';
    protected $primaryKey = 'verifyingGradeID';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'grade',
    ];

    private array $defaultValues = [
        [
            'title' => 'Information by manufacturer',
            'grade' => 1,
        ], [
            'title' => 'Certified by manufacturer',
            'grade' => 2,
        ], [
            'title' => 'Independent confirmation by CC partner',
            'grade' => 3
        ]
    ];
}
