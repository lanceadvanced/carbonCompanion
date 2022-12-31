<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Auth;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


/**
 * Class User
 * @package App\Models\User
 * @property $name
 * @property $email
 * @property $email_verified_at
 * @property $password
 * @property $created_at
 * @property $updated_at
 *
 * @mixin Eloquent
 */
class User extends Authenticatable
{
    public const MANUFACTURER = 'manufacturer';
    public const SUPPLIER = 'supplier';

    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'userID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAccount($type): Manufacturer|Supplier|null
    {
        if($type == self::MANUFACTURER){
            return Manufacturer::where('fk_userID', Auth::user()->getKey())->first();
        }

        if($type == self::SUPPLIER){
            return Supplier::where('fk_userID', Auth::user()->getKey())->first();
        }

        return null;
    }
}
