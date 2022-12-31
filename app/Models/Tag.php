<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Variant
 * @package App\Models\Variant
 *
 * @property $title
 * @property $fk_userID
 *
 * @mixin Eloquent
 */
class Tag extends Model
{
    use HasFactory;

    protected $table = 'tag';
    protected $primaryKey = 'tagID';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'fk_userID',
    ];

    public static function renderString(array $tags): string
    {
        $tagString = '';
        foreach($tags as $key => $tag){
            $tagString .= ($key != 0 ? ', ' : '').$tag['tag.title'].': '.$tag['tag.value'];
        }
        return $tagString;
    }
}
