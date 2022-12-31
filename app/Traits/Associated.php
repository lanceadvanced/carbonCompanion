<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

trait Associated
{
    public function association($key): Collection|Model|null
    {
        if(isset($this->associations[$key])){
            $association = $this->associations[$key];
            if(isset($association['complex'])){
                $results = new Collection();
                $linkingEntries = ($association['linking'][1])::where($association['linking'][0], $this->getKey())->get();
                foreach($linkingEntries as $linkingEntry){
                    $target = ($association['target'][1])::find($linkingEntry->{$association['target'][0]});
                    $result = [];
                    foreach($association['keep']['linking']['attributes'] as $attribute){
                        $result[$association['keep']['linking']['prefix'].'.'.$attribute] = $linkingEntry->{$attribute};
                    }
                    foreach($association['keep']['target']['attributes'] as $attribute){
                        $result[$association['keep']['target']['prefix'].'.'.$attribute] = $target->{$attribute};
                    }
                    $results->push($result);
                }
                return $results;
            } else {
                return $association[1]::find($this->{$association[0]});
            }

        }

        return null;
    }
}
