<?php

namespace App\Http\Controllers;

use App\Models\BookProduct;
use App\Models\CdProduct;
use App\Models\GameProduct;
use App\Models\ShopProduct;
use Illuminate\Http\Request;

class ShopProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view(
            'products.index',
            ['pageTitle' => 'Shop Products | Home', 'products' => ShopProduct::simplePaginate(12)]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create', ['pageTitle' => 'Shop Products | Add Product']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "productType" => "required",
            "firstName" => "required",
            "mainName" => "required",
            "title" => "required",
            "uniqueField" => "required",
            "price" => "required",
        ]);


        $shopProduct = ShopProduct::create([
            "user_id" => auth()->user()->getAuthIdentifier(),
            "product_type" => $request->productType,
            "first_name" => $request->firstName,
            "main_name" => $request->mainName,
            "title" => $request->title,
            "price" => $request->price
        ]);

        if ($request->productType === 'cd') {
            CdProduct::create(["shop_product_id" => $shopProduct->id, "play_length" => $request->uniqueField]);
        } else if ($request->productType === 'book') {
            BookProduct::create(["shop_product_id" => $shopProduct->id, "num_pages" => $request->uniqueField]);
        } else if ($request->productType === 'game') {
            GameProduct::create(["shop_product_id" => $shopProduct->id, "pegi" => $request->uniqueField]);
        }

        return redirect(route('shopProduct.index'))->with('success', 'Product Store Sucessfully');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\ShopProduct $shopProduct
     * @return \Illuminate\Http\Response
     */
    public function show(ShopProduct $shopProduct)
    {
        $uniqueFieldValue = "";
        switch ($shopProduct->product_type) {
            case 'cd':

                $uniqueFieldValue = CdProduct::where('shop_product_id', $shopProduct->id)->first()->play_length;
                break;
            case 'book':

                $uniqueFieldValue = BookProduct::where('shop_product_id', $shopProduct->id)->first()->num_pages;
                break;
            case 'game':

                $uniqueFieldValue = GameProduct::where('shop_product_id', $shopProduct->id)->first()->pegi;
                break;
        }

        return view('products.show', ['pageTitle' => 'Shop Products | Show Product', 'product' => $shopProduct, 'uniqueFieldValue' => $uniqueFieldValue]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\ShopProduct $shopProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(ShopProduct $shopProduct)
    {
        $cardHeader = "";
        $uniqueFieldValue = "";
        switch ($shopProduct->product_type) {
            case 'cd':
                $cardHeader = "Edit CD details";
                $uniqueFieldValue = CdProduct::where('shop_product_id', $shopProduct->id)->first()->play_length;
                break;
            case 'book':
                $cardHeader = "Edit Book details";
                $uniqueFieldValue = BookProduct::where('shop_product_id', $shopProduct->id)->first()->num_pages;
                break;
            case 'game':
                $cardHeader = "Edit Game details";
                $uniqueFieldValue = GameProduct::where('shop_product_id', $shopProduct->id)->first()->pegi;
                break;
        }
        return view('products.edit', ["pageTitle" => "Shop Products | Edit Product", "cardHeader" => $cardHeader, "product" => $shopProduct, "uniqueFieldValue" => $uniqueFieldValue]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ShopProduct $shopProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShopProduct $shopProduct)
    {
        $this->validate($request, [
            "title" => "required",
            "firstName" => "required",
            "mainName" => "required",
            "uniqueField" => "required",
            "price" => "required",
        ]);

        $shopProduct->update([
            "title" => $request->title,
            "first_name" => $request->firstName,
            "main_name" => $request->mainName,
            "price" => $request->price
        ]);

        switch ($shopProduct->product_type) {
            case 'cd':
                CdProduct::where('shop_product_id', $shopProduct->id)->first()
                    ->update(["play_length" => $request->uniqueField]);
                break;
            case 'book':
                BookProduct::where('shop_product_id', $shopProduct->id)->first()
                    ->update(["num_pages" => $request->uniqueField]);
                break;
            case 'game':
                GameProduct::where('shop_product_id', $shopProduct->id)->first()
                    ->update(["pegi" => $request->uniqueField]);
                break;
        }

        return redirect()->back()->with('success', 'Product Updated Sucessfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\ShopProduct $shopProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShopProduct $shopProduct)
    {
        $shopProduct->delete();

        return redirect()->back()->with('success', 'Product Deleted Sucessfully');
    }
}
