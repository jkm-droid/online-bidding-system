<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Seller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
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
            'feature_name'=>'array',
            'product_image'=>'required'
        ]);

        $productInfo = $request->all();
        if (!$request->filled('feature_name'))
            return redirect()->back()->with('error', "Product must have at least (1)one feature");

        if (!$request->filled('product_owner'))
            return redirect()->back()->with('error', "Product must have a product owner");

        $name = $productInfo['product_name'].'_'.Carbon::now()->format('Y_m_d H_s_i');
        $imageName = str_replace(' ', '_',$name).'.'.$request->product_image->extension();
        $request->product_image->move(public_path('product_gallery'), $imageName);

        Product::create([
            'product_name' => $request['product_name'],
            'seller_id' => (int)$request['product_owner'],
            'price' => $request['price'],
            'specs' => implode(',',$productInfo['feature_name']),
            'is_available' => true,
            'product_image' => $imageName
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
        $product = Product::where('id',$product_id)->first();
        $sellers = Seller::all();
        $product_owner = $sellers->where('id', $product->seller_id)->first();

        return view('admin.products.edit', compact('sellers'))
            ->with('product_owner', $product_owner)
            ->with('product', $product);
    }

    public function editproductDetails($request, $productId)
    {
        $request->validate([
            'product_name'=>'required|min:3|string',
            'product_owner'=>'required|integer',
            'price'=>'required|regex:/^\d+(\.\d{1,2})?$/',
            'feature_name'=>'required',
        ]);

        $productInfo = $request->all();
        $product = Product::findOrFail($productId);
        if ($request->hasFile('product_image')){
            $name = $productInfo['product_name'].'_'.Carbon::now()->format('Y_m_d H_s_i');
            $imageName = str_replace(' ', '_',$name).'.'.$request->product_image->extension();
            $request->product_image->move(public_path('product_gallery'), $imageName);
            $product->product_image = $imageName;
        }

        $product->product_name = trim($productInfo['product_name']);
        $product->seller_id = $productInfo['product_owner'];
        $product->price = trim($productInfo['price']);
        $product->specs = trim($productInfo['feature_name']);
        $product->is_available = true;
        $product->update();

        return redirect()->route('admin.product')
            ->with('success', 'Updated successfully');
    }
}
