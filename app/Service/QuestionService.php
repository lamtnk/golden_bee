<?php

namespace App\Service;

use App\Models\Food;
use App\Models\Product_variation;
use App\Models\Products;
use App\Models\Promotions;

class QuestionService
{
    public function getAll()
    {
        $product = Products::withTrashed()->orderBy('created_at', 'desc')->orderBy('deleted_at', 'asc')->get();
        return $product;
    }

    public function getById($id)
    {
        return Products::where('id', $id)->first();
    }

    public function getDetailById($id)
    {
        return Product_variation::where('id', $id)->first();
    }

    public function add($categoryId, $productName, $productNameEn, $productPrice, $productDescription, $productDescriptionEn, $imageName)
    {
        $id = Products::create([
            'category_id' => $categoryId,
            'name' => $productName,
            'name_en' => $productNameEn,
            'description' => $productDescription,
            'description_en' => $productDescriptionEn,
            'image' => $imageName
        ])->id;

        foreach ($productPrice as $sizePriceJson) {
            $sizePrice = json_decode($sizePriceJson, true);
            Product_variation::create([
                'variation_id' => $sizePrice['id'],
                'product_id' => $id,
                'price' => ($sizePrice['price'] == null) ? 0 : $sizePrice['price'],
            ]);
        }
        return $id;
    }

    public function edit($id, $categoryId, $productName, $productNameEn, $productPrice, $productDescription, $productDescriptionEn, $imageName)
    {
        $product = Products::where('id', $id)->first();
        $product->category_id = $categoryId;
        $product->description = $productDescription;
        $product->description_en = $productDescriptionEn;
        $product->name = $productName;
        $product->name_en = $productNameEn;
        if ($imageName != null) {
            $product->image = $imageName;
        }
        $product->save();
        if ($productPrice != null) {
            $productVariations = Product_variation::where('product_id', $id)->get();
            foreach ($productVariations as $productVariation) {
                $productVariation->delete();
            }
            foreach ($productPrice as $sizePriceJson) {
                $sizePrice = json_decode($sizePriceJson, true);
                Product_variation::create([
                    'variation_id' => $sizePrice['id'],
                    'product_id' => $id,
                    'price' => ($sizePrice['price'] == null) ? 0 : $sizePrice['price'],
                ]);
            }
        }
        return $id;
    }

    public function editDetail($id, $productPrice)
    {
        $productVariation = Product_variation::where('id', $id)->first();
        $productVariation->price = $productPrice;
        $productVariation->save();
    }

    public function checkHasChildren($idFood)
    {
        return Products::find($idFood)->dish()->get()->count() > 0;
    }

    public function delete($productId)
    {
        $product = Products::find($productId);
        $product->delete();
    }

    public function checkHasPromotion($productId) {
        if(Promotions::where('product_id', $productId)->first() == null) {
            return false;
        }
        return true;
    }

    public function restore($productId)
    {
        try {
            Products::withTrashed()->where('id', $productId)->restore();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function deleteDetail($detailId, $productId)
    {
        $product = Products::find($productId);
        if ($product->product_variations()->get()->count() > 1) {
            $productVariation = Product_variation::find($detailId);
            $productVariation->delete();
            return true;
        }
        return false;
    }
}
