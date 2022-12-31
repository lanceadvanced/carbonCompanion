<?php

namespace App\Http\Controllers;

use App\Models\FootprintUnit;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Tag;
use App\Models\TagVariantLink;
use App\Models\User;
use App\Models\Variant;
use App\Models\VerifyingGrade;
use App\Traits\Initialize;
use DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Collection;
use JetBrains\PhpStorm\NoReturn;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private static function isInitialize($class): bool
    {
        return in_array(Initialize::class, class_uses($class));
    }

    #[NoReturn] public static function reset(){
        $models = [
            new TagVariantLink(),
            new Tag(),
            new Variant(),
            new FootprintUnit(),
            new VerifyingGrade(),
            new Product(),
            new Manufacturer(),
            new Supplier(),
            new User(),
        ];

        $messages = new Collection();

        foreach ($models as $model){
            $table = $model->getTable();
            if($table == "users"){
                User::all()->map(function ($user){
                    $user->tokens()->delete();
                });
            }
            DB::STATEMENT("DELETE FROM $table");
            DB::STATEMENT("ALTER TABLE $table AUTO_INCREMENT = 1");

            if(self::isInitialize($model::class)){
                $model->initialize();
                $messages->push("Initialized $table");
            }

            $messages->push("Deleted $table");
        }

        dd($messages->toArray());
    }
}
