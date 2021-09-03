<?php

namespace App\Http\Controllers\AdminAuth;

use App\Models\State;
use App\Models\City;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CityController extends Controller
{
    public function index($id)
    {
        $cities = City::where('state_id', $id)->get();
        $state=State::where('id',$id)->first();
        return view('admin.city.index', compact('cities','state'));
    }
    public function create($id)
    {
        $state=State::where('id',$id)->first();
        return view('admin.city.create',compact('state'));
    }

    public function store(Request $request)
    {
        $city = new City;
        $city->name = $request->name;
        $city->state_id = $request->id;
        $city->save();
        return response()->Json(['status' => 'success']);
    }

    public function edit($id)
    {
        $city = City::where('id', $id)->first();
        $state=State::where('id',$city->state_id)->first();
        return view('admin.city.edit',compact('state','city'));
    }


    public function update(Request $request)
    {
        $city =  City::where('id',$request->id)->first();
        $city->name = $request->name;
        $city->save();
        return response()->Json(['status' => 'success']);
    }

    public function delete(Request $request)
    {
        $city = City::where('id', $request->id)->first();
        $city->delete();
        return response()->Json(['status' => 'success']);
    }

    public function select(Request $request)
    {
        $cities = City::where('state_id', $request->state_id)->get();
        $html='<option value="">Select City</option>';
        foreach ($cities as $city){
            $html.="<option value='" . $city->id . "'>" . $city->name . "</option>";
        }
        echo $html;

    }
}
