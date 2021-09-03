<?php

namespace App\Http\Controllers\AdminAuth;

use Illuminate\Http\Request;
use App\Models\Discount;
use App\Http\Controllers\Controller;

class DiscountController extends Controller
{
    public function index()
    {
        // $customers = Customer::get();
        $discounts = Discount::get();
      
        return view('admin.discount.index', compact('discounts'));
    }

      public function create()
    {
        $discounts = Discount::all();
     
        return view('admin.discount.create',compact('discounts'));
    }

    public function store(Request $request)
    {
        $discount = new Discount();
        $discount->days = $request->days;
        $discount->discount = $request->discount;
     
        $discount->save();
        return response()->Json(['status' => 'success']);
    }



    public function edit($id)
    { 
        $discount = Discount::where('id', $id)->first();

        return view('admin.discount.edit', compact('discount'));
    }
   
    public function update (Request $request)
    {
        
        $discount = Discount::where('id', $request->hidden_id)->first();
        $discount->days = $request->name;
        $discount->discount = $request->discount;
           
         $discount->save();
        return response()->Json(['status' => 'success']);
    }
    public function assign(Request $request)
    {

        // $customer = Customer::where('id', $request->customer_id)->update(['active' => 1]);
        $discount = Discount::where('id', $request->id)->update(['active' => 1]);
        return response()->Json(['status' => 'success']);
    }

    public function unassigned(Request $request)
    {
        // $customer = Customer::where('id', $request->customer_id)->update(['active' => 0]);
        // dd($request->all());
        $customer = User::where('id', $request->id)->update(['active' => 0]);
        return response()->Json(['status' => 'success']);
    }    


}
