<?php

namespace App\Http\Controllers\AdminAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Payment;




class PaymentController extends Controller
{
    
    public function index()
    {
         $payments = Payment::get();
        return view('admin.payment.index', compact('payments'));
    }

    public function create()
    {
          $payments = Payment::all();
        // return view('admin.product.create',compact('shops'));
         return view('admin.payment.create',compact('payments'));
    }

    public function store(Request $request)
    {
        $payment = new Payment();
        
        $payment->title = $request->title;
        // $payment->customer_id = $request->customer_id;
        $payment->credit = $request->credit;
        $payment->debit = $request->debit;
        $payment->total_amount = $request->total_amount;
       

        $payment->save();
        return response()->Json(['status' => 'success']);
    }

    public function edit($id)
    { 
     $payment = Payment::where('id', $id)->first();
    
        return view('admin.payment.edit', compact('payment'));
    }
    public function show($id)
    { 
     $payment = Payment::where('id', $id)->first();
     
        return view('admin.payment.show', compact('payment'));

   }
    public function update (Request $request)
    {

        
        $payment = Payment::where('id', $request->id)->first();
        
 
         $payment->title = $request->title;
        $payment->credit = $request->credit;
        $payment->debit = $request->debit;
        $payment->total_amount = $request->total_amount;

        $payment->save();
        return response()->Json(['status' => 'success']);
    }

    public function delete(Request $request)
    {
        // $ride = Ride::where('id', $request->id)->first();
       
        // $ride->delete();
        // return response()->Json(['status' => 'success']);
    }

    public function assign(Request $request)
    {
    //     $product = Product::where('id', $request->product_id)->update(['active' => 1]);
    //     return response()->Json(['status' => 'success']);
        $payment = Payment::where('id', $request->payment_id)->update(['active' => 1]);
        return response()->Json(['status' => 'success']);
    }

    public function unassigned(Request $request)
    {
        $payment = Payment::where('id', $request->payment_id)->update(['active' => 0]);
        return response()->Json(['status' => 'success']);
    }    
    public function money(Request $request)
    {
        $payment = Payment::where('id', $request->id)->first();
        $payment->update(['total_amount' => $payment->total_amount +$request->total_amount]);
        return response()->Json(['status' => 'success']);
    }
}
