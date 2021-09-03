<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Models\ShopCategory;
use Illuminate\Http\Request;

class ShopCategoryController extends Controller
{

    public function index()
    {
        $shopcategories = ShopCategory::get();
        return view('admin.shopcategory.index', compact('shopcategories'));
    }

    public function create()
    {
        return view('admin.shopcategory.create');
    }

    public function store(Request $request)
    {
        $file = $request->image;
        $filename = 'shopcategory-' . rand() . '.' . $file->getClientOriginalExtension();
        $request->image->move(public_path('shopcategory'), $filename);
        $shopcategory = new ShopCategory;
        $shopcategory->image = 'shopcategory/' . $filename;
        $shopcategory->title = $request->title;
        $shopcategory->save();
        return response()->Json(['status' => 'success']);
    }

    public function edit($id)
    {
        $shopcategory = ShopCategory::where('id', $id)->first();
        return view('admin.shopcategory.edit', compact('shopcategory'));
    }

    public function update(Request $request)
    {
        $shopcategory =  ShopCategory::where('id',$request->id)->first();
        if ($request->image) {
            $file = $request->image;
            $filename = 'shopcategory-' . rand() . '.' . $file->getClientOriginalExtension();
            $request->image->move(public_path('shopcategory'), $filename);
            $shopcategory->image = 'shopcategory/' . $filename;
        }
        $shopcategory->title = $request->title;
        $shopcategory->save();
        return response()->Json(['status' => 'success']);
    }

    public function delete(Request $request)
    {
        $shopcategory = ShopCategory::where('id', $request->id)->first();
        $file_path = base_path('public/' . $shopcategory->image);
        unlink($file_path);
        $shopcategory->delete();
        return response()->Json(['status' => 'success']);
    }

    public function assign(Request $request)
    {
        $shopcategory = ShopCategory::where('id', $request->shopcategory_id)->update(['active' => 1]);
        return response()->Json(['status' => 'success']);
    }

    public function unassigned(Request $request)
    {
        $shopcategory = ShopCategory::where('id', $request->shopcategory_id)->update(['active' => 0]);
        return response()->Json(['status' => 'success']);
    }
}
