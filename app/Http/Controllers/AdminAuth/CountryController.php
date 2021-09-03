<?php

namespace App\Http\Controllers\AdminAuth;

use App\Models\Country;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::get();
        return view('admin.country.index', compact('countries'));
    }

    public function create()
    {
        return view('admin.country.create');
    }

    public function store(Request $request)
    {
        $country = new Country;
        $country->name = $request->name;
        $country->save();
        return response()->Json(['status' => 'success']);
    }

    public function edit($id)
    {
        $country = Country::where('id', $id)->first();
        return view('admin.country.edit', compact('country'));
    }


    public function update(Request $request)
    {
        $country =  Country::where('id',$request->id)->first();
        $country->name = $request->name;
        $country->save();
        return response()->Json(['status' => 'success']);
    }

    public function delete(Request $request)
    {
        $country = Country::where('id', $request->id)->first();
        $country->delete();
        return response()->Json(['status' => 'success']);
    }


}
