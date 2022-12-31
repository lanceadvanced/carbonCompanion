<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Tag;
use App\Models\TagVariantLink;
use App\Models\Variant;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private static array $validationRules = [
        'variant' => [
            'variant-title' => ['required', 'string', 'max:255'],
            'reference' => ['required', 'string', 'max:255'],
            'footprint' => ['required', 'regex:/^[1-9]{1}[0-9]{0,7}((,|\.)[0-9]{0,2})?$/i', 'max:99999999.99'],
            'fk_footprintUnitID' => ['required', 'exists:footprintUnit,footprintUnitID'],
            'fk_verifyingGradeID' => ['required', 'exists:verifyingGrade,verifyingGradeID'],
            'tags' => ['nullable', 'string', 'regex:/^[a-zA-Z0-9]+: ?[a-zA-Z0-9]+( ?, ?[a-zA-Z0-9]+: ?[a-zA-Z0-9]+)*$/'],
        ],
        'product' => [
            'product-title' => ['required', 'string', 'max:255'],
        ]
    ];

    private static function saveTags($tagsString, $variant)
    {
        $tagsRaw = explode(',', $tagsString);
        foreach ($tagsRaw as $rawTag) {
            $tagArr = explode(':', $rawTag);
            if (count($tagArr) == 2) {
                $tagTitle = trim($tagArr[0]);
                $value = trim($tagArr[1]);

                $tag = Tag::where([['title', '=', $tagTitle], ['fk_userID', '=', Auth::user()->getKey()]])->first();
                if (!$tag) {
                    $tag = Tag::create([
                        'title' => $tagTitle,
                        'fk_userID' => Auth::user()->getKey(),
                    ]);
                }

                TagVariantLink::create([
                    'fk_tagID' => $tag->getKey(),
                    'fk_variantID' => $variant->getKey(),
                    'value' => $value,
                ]);
            }
        }
    }

    private static function createVariant(Request $request, Product $product, $checked = false): Variant
    {
        if (!$checked) {
            $request->validate(self::$validationRules['variant']);
        }

        $variant = Variant::create([
            'title' => $request->get('variant-title'),
            'reference' => $request->get('reference'),
            'fk_productID' => $product->getKey(),
            'footprint' => $request->get('footprint'),
            'fk_footprintUnitID' => $request->get('fk_footprintUnitID'),
            'fk_verifyingGradeID' => $request->get('fk_verifyingGradeID'),
        ]);

        self::saveTags($request->get('tags'), $variant);

        return $variant;
    }

    public static function createProduct(Request $request): RedirectResponse
    {
        $request->validate(array_merge(self::$validationRules['product'], self::$validationRules['variant']));

        $product = Product::create([
            'title' => $request->get('product-title'),
            'fk_userID' => Auth::user()->getKey()
        ]);

        $variant = self::createVariant($request, $product, true);

        return redirect(route('manageProducts'))->with([
            'createdVariant' => $variant,
        ]);
    }

    public static function saveVariant(Request $request): RedirectResponse
    {
        $variant = Variant::find($request->get('variantID'));

        if ($variant && $variant->checkAccess()) {
            $request->validate(self::$validationRules['variant']);

            $variant->title = $request->get('variant-title');
            $variant->reference = $request->get('reference');
            $variant->footprint = $request->get('footprint');
            $variant->fk_footprintUnitID = $request->get('fk_footprintUnitID');
            $variant->fk_verifyingGradeID = $request->get('fk_verifyingGradeID');

            $variant->save();

            TagVariantLink::where('fk_variantID', $variant->getKey())->delete();

            self::saveTags($request->get('tags'), $variant);
        }

        return redirect(route('manageProducts'));
    }

    public static function createVariantFromRequest(Request $request): RedirectResponse
    {
        $product = Product::find($request->get('productID'));
        if ($product && $product->checkAccess()) {
            self::createVariant($request, $product);
        }

        return redirect(route('manageProducts'));
    }

    public static function deleteVariant($variantID, $check = true, $redirect = true): bool|RedirectResponse
    {
        $variant = Variant::find($variantID);
        $checked = ($variant && $variant->checkAccess()) || !$check;

        if ($checked) {
            TagVariantLink::where('fk_variantID', $variant->getKey())->delete();
            $variant->delete();
        }

        if ($redirect) {
            return redirect(route('manageProducts'));
        }

        return true;
    }

    public static function deleteProduct($productID): RedirectResponse
    {
        $product = Product::find($productID);
        $variants = Variant::where('fk_productID', $product->getKey())->get();

        foreach ($variants as $variant){
            self::deleteVariant($variant->getKey(), false, false);
        }

        $product->delete();

        return redirect(route('manageProducts'));
    }
}
