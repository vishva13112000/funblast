<?php

namespace App\Http\Controllers\AdminAuth;

use App\Models\Country;
use App\Models\State;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StateController extends Controller
{
    public function index($id)
    {
        $states = State::where('country_id', $id)->get();
        $country=Country::where('id',$id)->first();
        return view('admin.state.index', compact('states','country'));
    }
    public function create($id)
    {
        $country=Country::where('id',$id)->first();
        return view('admin.state.create',compact('country'));
    }

    public function store(Request $request)
    {
        $state = new State;
        $state->name = $request->name;
        $state->country_id = $request->id;
        $state->save();
        return response()->Json(['status' => 'success']);
    }

    public function edit($id)
    {
        $state = State::where('id', $id)->first();
        $country=Country::where('id',$state->country_id)->first();
        return view('admin.state.edit',compact('country','state'));
    }


    public function update(Request $request)
    {
        $state =  State::where('id',$request->id)->first();
        $state->name = $request->name;
        $state->save();
        return response()->Json(['status' => 'success']);
    }

    public function delete(Request $request)
    {
        $state = State::where('id', $request->id)->first();
        $state->delete();
        return response()->Json(['status' => 'success']);
    }
    public function select(Request $request)
    {
        $states = State::where('country_id', $request->country_id)->get();
        $html='<option value="">Select State</option>';
        foreach ($states as $state){
            $html.="<option value='" . $state->id . "'>" . $state->name . "</option>";
        }
        echo $html;

    }
}
