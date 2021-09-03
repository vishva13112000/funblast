<?php

namespace App\Http\Controllers\AdminAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Shop;
use App\Models\ShopCategory;
use App\Models\State;


class ProductController extends Controller
{
    
    public function index()
    {
        $products = Product::get();
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        $shops=Shop::all();
        return view('admin.product.create',compact('shops'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $product = new Product();
        if ($request->image) {
            $file = $request->image;
            $filename = 'product-' . rand() . '.' . $file->getClientOriginalExtension();
            $request->image->move(public_path('product'), $filename);
            $product->description = 'product/' . $filename;
        }

        $product->name = $request->name;
        $product->shop_id = $request->shop_id;
        $product->save();
        return response()->Json(['status' => 'success']);
    }

    public function edit($id)
    {
        $product = Product::where('id', $id)->first();
        $shops =Shop::get();
        return view('admin.product.edit', compact('product','shops'));
    }
    public function show($id)
    {
        $product =Product::where('id', $id)->first();
        $shops =Shop::get();
        return view('admin..show', compact('product','shops'));
    }

    public function update(Request $request)
    {
        $product = Product::where('id', $request->id)->first();
        if ($request->image) {
            $file_path = base_path('public/' . $product->image);
            unlink($file_path);
            $file = $request->image;
            $filename = 'product-' . rand() . '.' . $file->getClientOriginalExtension();
            $request->image->move(public_path('product'), $filename);
            $product->image = 'product/' . $filename;
        }
        $product->title = $request->title;
        $product->shop_id = $request->shop_id;
        $product->save();
        return response()->Json(['status' => 'success']);
    }

    public function delete(Request $request)
    {
        $product =Product::where('id', $request->id)->first();
        $file_path = base_path('public/' . $product->image);
        unlink($file_path);
        $product->delete();
        return response()->Json(['status' => 'success']);
    }

    public function assign(Request $request)
    {
        $product = Product::where('id', $request->product_id)->update(['active' => 1]);
        return response()->Json(['status' => 'success']);
    }

    public function unassigned(Request $request)
    {
        $category = Product::where('id', $request->category_id)->update(['active' => 0]);
        return response()->Json(['status' => 'success']);
    }    
}
