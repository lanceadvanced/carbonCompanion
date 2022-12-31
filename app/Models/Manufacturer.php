<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * Class Domain
 * @property $manufacturerName
 * @property $fk_userID
 * @property $active
 *
 * @mixin Eloquent
 */
class Manufacturer extends Model
{
    use HasFactory;

    protected $table = 'manufacturer';
    protected $primaryKey = 'manufacturerID';
    public $timestamps = false;

    protected $fillable = [
        'manufacturerName',
        'fk_userID',
        'active'
    ];
}
