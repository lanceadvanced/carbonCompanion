<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Domain
 * @property $supplierName
 * @property $fk_userID
 * @property $active
 *
 * @mixin Eloquent
 */
class Supplier extends Model
{
    use HasFactory;

    protected $table = 'supplier';
    protected $primaryKey = 'supplierID';
    public $timestamps = false;

    protected $fillable = [
        'supplierName',
        'fk_userID',
        'active'
    ];
}
