<?php

namespace App\Models;

use App\Traits\Associated;
use Auth;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Variant
 * @package App\Models\Variant
 *
 * @property $title
 * @property $reference
 * @property $fk_productID
 * @property $footprint
 * @property $fk_footprintUnitID
 * @property $fk_verifyingGradeID
 *
 * @mixin Eloquent
 */
class Variant extends Model
{
    use HasFactory, Associated;

    protected $table = 'variant';
    protected $primaryKey = 'variantID';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'reference',
        'fk_productID',
        'footprint',
        'fk_footprintUnitID',
        'fk_verifyingGradeID',
    ];

    public function checkAccess(): bool
    {
        /** @var Product $product */
        $product = $this->association('product');
        return $product->checkAccess();
     }

    private array $associations = [
        'product' => ['fk_productID', Product::class],
        'footprintUnit' => ['fk_footprintUnitID', FootprintUnit::class],
        'verifyingGrade' => ['fk_verifyingGradeID', VerifyingGrade::class],
        'tags' => [
            'complex' => true,
            'linking' => ['fk_variantID', TagVariantLink::class],
            'target' => ['fk_tagID', Tag::class],
            'keep' => [
                'linking' => [
                    'prefix' => 'tag',
                    'attributes' => ['value']
                ],
                'target' => [
                    'prefix' => 'tag',
                    'attributes' => ['title']
                ],
            ]
        ]
    ];
}
