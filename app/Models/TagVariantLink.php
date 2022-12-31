<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TagVariantLink
 * @package App\Models\TagVariantLink
 * @property $fk_tagID
 * @property $fk_variantID
 * @property $value
 *
 * @mixin Eloquent
 */
class TagVariantLink extends Model
{
    use HasFactory;

    protected $table = 'tagVariantLink';
    protected $primaryKey = 'tagVariantLinkID';
    public $timestamps = false;

    protected $fillable = [
        'fk_tagID',
        'fk_variantID',
        'value',
    ];
}
