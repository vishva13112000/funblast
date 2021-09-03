<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ride;



class RideController extends Controller
{
    
    public function index()
    {
        $rides = Ride::get();

        if ($rides) {
            foreach ($rides as $key => $value) {
                $value->image = url('/').'/'.$value->image;
            }
        }
        return response()->json(['success' => 1, 'data'=> $rides],200);

    }

    public function getride($id){

    	$ride = Ride::where('id',$id)->first();
        $ride->image = url('/').'/'.$ride->image;
        // $ride->save();
        
    	if ($ride) {
    		return response()->json(['success' => 1, 'data'=> $ride],200);
    	}else{
    		return response()->json(['success' => 0, 'data'=> ''],200);
    	}
        
    }

   
}
