<?php

namespace App\Http\Controllers\AdminAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Amount;
use App\Models\Customer;
use App\Models\Payment;


class AmountController extends Controller
{
    
    public function index()
    {
    //     $products = Product::get();
    //     return view('admin.product.index', compact('products'));
           $amounts = Amount::with('customer')->get();
           // dd($amounts);
        return view('admin.amount.index', compact('amounts'));

    }

    public function create()
    {
        // $shops=Shop::all();
           
              $customers= Customer::all();
               return view('admin.amount.create',compact('customers'));
    }

    public function store(Request $request)
    {
        // // dd($request->all());
        
    $customer = Customer::where('id',$request->customer_id)->first();
    // dd($customer);

        $customer->amount = $customer->amount+$request->amount;
        $customer->save();
        
         $amount = new Amount();
        
        $amount->customer_id = $request->customer_id;
  
        $amount->amount = $request->amount;

        $amount->amount = $customer->amount; 

        $amount->save();

        return response()->Json(['status' => 'success']);

    }

    public function edit($id)
    { 
     // $data['amount'] = Amount::where('id', $id)->first();
    
       
     //    $data['customers'] =Customer::get();
     //    return view('admin.amount.edit')->with($data);


        $amount = Amount::where('id', $id)->first();
        $customers =Customer::get();
        return view('admin.amount.edit', compact('amount','customers'));
    }
    public function show($id)
    { 
 
        //  $amount = Amount::where('id', $id)->first();
        // $customers =Customer::get();
        // return view('admin.amount.show', compact('amount','customers'));

         $amount = Amount::where('id', $id)->first();
        $customers =Customer::get();
        return view('admin.amount.show', compact('amount','customers'));

   }
    public function update (Request $request)
    {

        $amount= Amount::where('id', $request->id)->first();
        
        $amount->customer_id = $request->customer_id;
      
    
        $amount->amount = $request->amount;

        $amount->save();
        return response()->Json(['status' => 'success']);
    }

    public function delete(Request $request)
    {
        $amount = Amount::where('id', $request->id)->first();
       
        $amount->delete();
        return response()->Json(['status' => 'success']);
    }

    public function assign(Request $request)
    {
    //     $product = Product::where('id', $request->product_id)->update(['active' => 1]);
    // //     return response()->Json(['status' => 'success']);
    //     $customer = Customer::where('id', $request->customer_id)->update(['active' => 1]);
    //     return response()->Json(['status' => 'success']);
    }

    public function unassigned(Request $request)
    {
        // $customer = Customer::where('id', $request->customer_id)->update(['active' => 0]);
        // return response()->Json(['status' => 'success']);
    }    

    public function money(Request $request)
    {
        
        $customer = Customer::where('id',$request->id)->first();
        $customer->amount = $customer->amount+$request->amount;
        $customer->save();
        
        $amount = new Amount();        
        $amount->customer_id = $request->id;  
        $amount->amount = $request->amount;

        // $amount->amount = $customer->amount; 

        $amount->save();
         $payment = new Payment();
        

        $payment->customer_id = $request->id;
        $payment->credit = $request->amount;
        $payment->total_amount=$customer->amount;       

        $payment->save();

   
        // $amount = Amount::where('id', $request->id)->first();
        // $amount->update(['amount' => $amount->amount +$request->amount]);
        return response()->Json(['status' => 'success']);
    }
}
