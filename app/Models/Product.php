<?php

namespace App\Models;

use Auth;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * Class Product
 * @package App\Models\Product
 * @property $title
 * @property $fk_userID
 *
 * @mixin Eloquent
 */
class Product extends Model
{
    use HasFactory;

    protected $table = 'product';
    protected $primaryKey = 'productID';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'fk_userID'
    ];

    public function checkAccess(): bool
    {
        return $this->fk_userID == Auth::user()->getKey();
    }

}
