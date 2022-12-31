<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TokenController;
use App\Models\FootprintUnit;
use App\Models\Product;
use App\Models\Variant;
use App\Models\VerifyingGrade;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::middleware('auth')->group(function () {
    Route::get('/token/delete/{tokenID}', [TokenController::class, 'delete'])->name('deleteToken');

    Route::post('/token/create', [TokenController::class, 'createToken'])->name('createToken');

    Route::get('/token/manage', function () {
        return view('tokens')->with([
            'createdToken' => Session::get('createdToken'),
            'tokens' => Auth::user()->tokens()->get(),
        ]);
    })->name('manageTokens');

    Route::get('/product/manage', function () {
        return view('products')->with([
            'verifyingGrades' => VerifyingGrade::all(),
            'footprintUnits' => FootprintUnit::all(),
            'createdVariant' => Session::get('createdVariant'),
            'products' => Product::where('fk_userID', Auth::user()->getKey())->get()->mapToGroups(function ($product) {
                return [$product->title => Variant::where('fk_productID', $product->getKey())->get()->map(function ($variant) {
                    return [
                        'variant' => $variant,
                        'product' => $variant->association('product'),
                        'footprintUnit' => $variant->association('footprintUnit'),
                        'verifyingGrade' => $variant->association('verifyingGrade'),
                        'tags' => $variant->association('tags')
                    ];
                })];
            })
        ]);
    })->name('manageProducts');

    Route::post('/product/create', [ProductController::class, 'createProduct'])->name('createProduct');

    Route::get('/product/edit/variant/{variantID}', function ($variantID) {
        $variant = Variant::find($variantID);

        if(!$variant || !$variant->checkAccess()){
            return redirect(route('manageProducts'));
        }

        return view('editVariant')->with([
            'variant' => $variant,
            'footprintUnits' => FootprintUnit::all(),
            'verifyingGrades' => VerifyingGrade::all(),
            'tags' => $variant->association('tags')->toArray(),
        ]);
    })->name('editVariant');

    Route::post('/product/variant/save-changes', [ProductController::class, 'saveVariant'])->name('saveVariant');

    Route::get('/product/add/variant/{productID}', function ($productID) {
        $product = Product::find($productID);

        if(!$product || !$product->checkAccess()){
            return redirect(route('manageProducts'));
        }

        return view('addVariant')->with([
            'product' => $product,
            'footprintUnits' => FootprintUnit::all(),
            'verifyingGrades' => VerifyingGrade::all(),
        ]);
    })->name('addVariant');

    Route::post('/product/variant/create', [ProductController::class, 'createVariantFromRequest'])->name('createVariant');

    Route::get('/product/delete/{productID}', [ProductController::class, 'deleteProduct'])->name('deleteProduct');

    Route::get('/product/delete/variant/{variantID}', [ProductController::class, 'deleteVariant'])->name('deleteVariant');
});

Route::get('/reset', [Controller::class, "reset"]);

require __DIR__ . '/auth.php';
