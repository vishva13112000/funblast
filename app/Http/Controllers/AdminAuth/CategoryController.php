<?php

namespace App\Http\Controllers\AdminAuth;

use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Shop;
use App\Models\ShopCategory;
use App\Models\State;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        // $categories = Category::where('branch_id', Auth::user()->id)->get();

        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        $shops=Shop::all();
        return view('admin.category.create',compact('shops'));
    }

    public function store(Request $request)
    {
        $category = new Category();
        if ($request->image) {
            $file = $request->image;
            $filename = 'category-' . rand() . '.' . $file->getClientOriginalExtension();
            $request->image->move(public_path('category'), $filename);
            $category->image = 'category/' . $filename;
        }

        $category->title = $request->title;
        $category->shop_id = $request->shop_id;
        $category->save();
        return response()->Json(['status' => 'success']);
    }

    public function edit($id)
    {
        $category = Category::where('id', $id)->first();
        $shops =Shop::get();
        return view('admin.category.edit', compact('category','shops'));
    }
    public function show($id)
    {
        $category = Category::where('id', $id)->first();
        $shops =Shop::get();
        return view('admin.category.show', compact('category','shops'));
    }

    public function update(Request $request)
    {
        $category = Category::where('id', $request->id)->first();
        if ($request->image) {
            $file_path = base_path('public/' . $category->image);
            unlink($file_path);
            $file = $request->image;
            $filename = 'category-' . rand() . '.' . $file->getClientOriginalExtension();
            $request->image->move(public_path('category'), $filename);
            $category->image = 'category/' . $filename;
        }
        $category->title = $request->title;
        $category->shop_id = $request->shop_id;
        $category->save();
        return response()->Json(['status' => 'success']);
    }

    public function delete(Request $request)
    {
        $category = Category::where('id', $request->id)->first();
        $file_path = base_path('public/' . $category->image);
        unlink($file_path);
        $category->delete();
        return response()->Json(['status' => 'success']);
    }

    public function assign(Request $request)
    {
        $category = Category::where('id', $request->category_id)->update(['active' => 1]);
        return response()->Json(['status' => 'success']);
    }

    public function unassigned(Request $request)
    {
        $category = Category::where('id', $request->category_id)->update(['active' => 0]);
        return response()->Json(['status' => 'success']);
    }

}
