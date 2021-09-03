<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Shop;
use App\Models\ShopCategory;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ShopController extends Controller
{
    public function index()
    {
        $shops = Shop::get();
        return view('admin.shops.index', compact('shops'));
    }

    public function create()
    {
        $shopcategories =ShopCategory::get();
        $countries =Country::get();

        return view('admin.shops.create',compact('shopcategories','countries'));
    }

    public function store(Request $request)
    {
        $shop = new Shop;
        if ($request->profile) {
            $file = $request->profile;
            $filename = 'shop-' . rand() . '.' . $file->getClientOriginalExtension();
            $request->profile->move(public_path('shop'), $filename);
            $shop->profile = 'shop/' . $filename;
        }

        $shop->name = $request->name;
        $shop->ownername = $request->ownername;
        $shop->password = Hash::make($request->ownername);
        $shop->email = $request->email;
        $shop->phoneno = $request->phoneno;
        $shop->address = $request->address;
        $shop->country_id = $request->country_id;
        $shop->shopcategory_id  = $request->shopcategory_id ;
        $shop->state_id = $request->state_id;
        $shop->city_id = $request->city_id;
        $shop->save();
        return response()->Json(['status' => 'success']);
    }

    public function edit($id)
    {
        $shop = Shop::where('id', $id)->first();
        $shopcategories =ShopCategory::get();
        $countries =Country::get();
        $states =State::get();
        $cities =City::get();
        return view('admin.shops.edit', compact('shop','shopcategories','countries','states','cities'));
    }
    public function show($id)
    {
        $shop = Shop::where('id', $id)->first();
        $shopcategories =ShopCategory::get();
        $countries =Country::get();
        $states =State::get();
        $cities =City::get();
        return view('admin.shops.show', compact('shop','shopcategories','countries','states','cities'));
    }

    public function update(Request $request)
    {
        $shop = Shop::where('id', $request->id)->first();
        if ($request->profile) {
            $file_path = base_path('public/' . $shop->profile);
            unlink($file_path);
            $file = $request->profile;
            $filename = 'shop-' . rand() . '.' . $file->getClientOriginalExtension();
            $request->profile->move(public_path('shop'), $filename);
            $shop->profile = 'shop/' . $filename;
        }

        $shop->name = $request->name;
        $shop->ownername = $request->ownername;
        $shop->shopcategory_id  = $request->shopcategory_id;
//        $shop->password = Hash::make($request->ownername);
        $shop->email = $request->email;
        $shop->phoneno = $request->phoneno;
        $shop->address = $request->address;
        $shop->country_id = $request->country_id;
        $shop->state_id = $request->state_id;
        $shop->city_id = $request->city_id;
        $shop->save();
        return response()->Json(['status' => 'success']);
    }

    public function delete(Request $request)
    {
        $shop = Shop::where('id', $request->id)->first();
        $file_path = base_path('public/' . $shop->image);
        unlink($file_path);
        $shop->delete();
        return response()->Json(['status' => 'success']);
    }

    public function assign(Request $request)
    {
        $shop = Shop::where('id', $request->shop_id)->update(['active' => 1]);
        return response()->Json(['status' => 'success']);
    }

    public function unassigned(Request $request)
    {
        $shop = Shop::where('id', $request->shop_id)->update(['active' => 0]);
        return response()->Json(['status' => 'success']);
    }
    public function verify(Request $request)
    {
        $shop = Shop::where('id', $request->shop_id)->update(['verify' => 1]);
        return response()->Json(['status' => 'success']);
    }

    public function unverify(Request $request)
    {
        $shop = Shop::where('id', $request->shop_id)->update(['verify' => 0]);
        return response()->Json(['status' => 'success']);
    }
}
