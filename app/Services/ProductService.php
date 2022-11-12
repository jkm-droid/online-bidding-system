<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProductService
{
    public function showCreateProductForm()
    {
        $sellers = Seller::all();

        return view('admin.products.create', compact('sellers'));
    }
    public function createNewproduct($request)
    {
        $request->validate([
            'product_name'=>'required|min:3|string',
            'product_owner'=>'required|integer',
            'price'=>'required|integer',
            'feature_name'=>'array'
        ]);

        $productInfo = $request->all();
        if (!$request->filled('feature_name'))
            return redirect()->back()->with('error', "Product must have at least (1)one feature");

        $features = array();
        foreach ($productInfo['feature_name'] as $feature){
            array_push($features, $feature);
        }

        Product::create([
            'product_name' => $productInfo['product_name'],
            'seller_id' => $productInfo['product_owner'],
            'price' => $productInfo['price'],
            'specs' => $features,
            'is_available' => true
        ]);

        return redirect()->route('admin.product')
            ->with('success', 'Created successfully');
    }

    public function getproducts()
    {
        $products = product::all();

        return view('admin.products.index', compact('products'));
    }

    public function showEditproductForm($product_id)
    {
        $product = product::where('id',$product_id)->first();

        return view('admin.products.edit')
            ->with('product', $product);
    }

    public function editproductDetails($request, $productId)
    {
        $request->validate([
            'full_name'=>'required|min:8|string',
            'email'=>'required|email|unique:products',
            'phone_number'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:20|unique:products',
            'location'=>'required|string|min:3'
        ]);

        Db::table('products')->where('id',$productId)->update([
            'full_name' => $request['full_name'],
            'email' => $request['email'],
            'phone_number' => $request['phone_number'],
            'location' =>  $request['location'],
        ]);

        return redirect()->route('admin.product')
            ->with('success', 'Updated successfully');
    }
}
