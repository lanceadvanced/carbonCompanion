<?php

use App\Models\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->post('/get/product', function (Request $request) {
    $request->validate([
        'reference' => ['required'],
    ]);

    $variants = new Collection();
    $messages = [];

    try {
        $variants = Variant::where('reference', $request->get('reference'))->get()->map(function (Variant $variant) {
            return [
                'title' => $variant->title,
                'reference' => $variant->reference,
                'product' => $variant->association('product')->getAttribute('title'),
                'footprint' => $variant->footprint,
                'footprintUnit' => $variant->association('footprintUnit')->getAttribute('unit'),
                'verifyingGrade' => [
                    'title' => $variant->association('verifyingGrade')->getAttribute('title'),
                    'grade' => $variant->association('verifyingGrade')->getAttribute('grade'),
                ],
                'tags' => $variant->association('tags')
            ];
        });
    } catch (Error){
        $messages[] .= 'Oops, something went wrong';
    }

    if($variants->isEmpty()){
        $messages[] .= 'No matching products found';
    }

    $results = [
        'products' => $variants->toArray(),
        'messages' => $messages,
    ];

    return response()->json($results);
});
