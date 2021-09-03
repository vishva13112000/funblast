<?php

namespace App\Http\Controllers\AdminAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ride;



class RideController extends Controller
{

    public function index()
    {
     $rides = Ride::get();
     return view('admin.ride.index', compact('rides'));
 }

 public function create()
 {
  $rides = Ride::all();
        // return view('admin.product.create',compact('shops'));
  return view('admin.ride.create',compact('rides'));
}

public function store(Request $request)
{
 $ride = new Ride();
 if ($request->image) {
    $file = $request->image;
    $filename = 'ride-' . rand() . '.' . $file->getClientOriginalExtension();
    $request->image->move(public_path('ride'), $filename);
    $ride->image = 'ride/' . $filename;
}

$ride->name = $request->name;
$ride->description = $request->description;
$ride->ammount = $request->ammount;
$ride->save();
return response()->Json(['status' => 'success']);
}

public function edit($id)
{ 
 $ride = Ride::where('id', $id)->first();

 return view('admin.ride.edit', compact('ride'));
}
public function show($id)
{ 
 $ride = Ride::where('id', $id)->first();

 return view('admin.ride.show', compact('ride'));

}
public function update (Request $request)
{

 $ride = Ride::where('id', $request->id)->first();
 if ($request->image) {
    // $file_path = base_path('ride/' . $ride->image);
    // unlink($file_path);
    $file = $request->image;
    $filename = 'ride-' . rand() . '.' . $file->getClientOriginalExtension();
    $request->image->move(public_path('/ride'), $filename);
    $ride->image = 'ride/' . $filename;
}
$ride->name = $request->name;
$ride->description = $request->description;
$ride->ammount = $request->ammount;
$ride->save();
return response()->Json(['status' => 'success']);
}

public function delete(Request $request)
{
    $ride = Ride::where('id', $request->id)->first();

    $ride->delete();
    return response()->Json(['status' => 'success']);
}

public function assign(Request $request)
{
    //     $product = Product::where('id', $request->product_id)->update(['active' => 1]);
    //     return response()->Json(['status' => 'success']);
    $ride = Ride::where('id', $request->ride_id)->update(['active' => 1]);
    return response()->Json(['status' => 'success']);
}

public function unassigned(Request $request)
{
    $ride = Ride::where('id', $request->ride_id)->update(['active' => 0]);
    return response()->Json(['status' => 'success']);
}    
public function scanqr(Request $request)
{
$qr = Ride::Findorfail($request->id);

if ($qr) 
{
    return response()->json(['status' => 'success','data' => $qr]);
} 
else 
{
    return response()->json(['status' => 'error']);
}
}
}