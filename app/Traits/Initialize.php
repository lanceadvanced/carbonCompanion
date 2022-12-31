<?php

namespace App\Traits;

use Eloquent;

/**
 *
 * @mixin Eloquent
 *
 */

trait Initialize
{
    public  function initialize(){
        foreach ($this->defaultValues as $defaultEntry){
            self::create($defaultEntry);
        }
    }
}
