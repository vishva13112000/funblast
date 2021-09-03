<?php

namespace App\Http\Controllers\AdminAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Amount;
use App\Models\Payment;
use App\Models\Branch;
use App\User;
use Hash;



class CustomerController extends Controller
{

	public function index()
	{
		// $customers = Customer::get();
		$customers = User::get();
		// $customers = User::get();
		  // $date1 = Carbon::createFromFormat('m/d/Y H:i:s', '12/01/2020 10:20:00');
    //     $date2 = Carbon::createFromFormat('m/d/Y H:i:s', '12/01/2020 10:20:00');
  
    //     $result = $date1->eq($date2);
    //     var_dump($result);
		return view('admin.customer.index', compact('customers'));
	}

	public function create()
	{		
         $data["customers"] = User::get();
          $data["branches"] = Branch::get();

        return view('admin.customer.create')->with($data);
		
	}

	public function store(Request $request)
	{

		// $customer = new Customer();
		$customer = new User();

		$customer->name = $request->name;
		$customer->email = $request->email;
		$customer->date = $request->date;
		$customer->mobileno = $request->mobileno;
	
		$customer->password = Hash::make($request->password);
		$customer->viewpassword = $request->password;



		$customer->save();
		return response()->Json(['status' => 'success']);
	}

	public function edit($id)
	{ 
		// $customer = Customer::where('id', $id)->first();
			$customer = User::where('id', $id)->first();
		   $branches = Branch::get();
		return view('admin.customer.edit', compact('customer','branches'));


	}
	public function show($id)
	{ 
		// $customer = Customer::where('id', $id)->first();
		$customer = User::where('id', $id)->first();
		 $branches = Branch::get();
		return view('admin.customer.show', compact('customer','branches'));

	}
	public function update (Request $request)
	{

		// $customer = Customer::where('id', $request->id)->first();
		$customer = User::where('id', $request->id)->first();


		$customer->name = $request->name;
		$customer->email = $request->email;
		$customer->date = $request->date;
		$customer->mobileno = $request->mobileno;
	

		if(!empty($request->password)){

			$customer->password = Hash::make($request->password);
			$customer->viewpassword = $request->password;
		}
		// $customer->amount = $request->amount;

		$customer->save();
		return response()->Json(['status' => 'success']);
	}

	public function delete(Request $request)
	{
		// $customer = Customer::where('id', $request->id)->first();
		$customer = User::where('id', $request->id)->first();

		$customer->delete();
		return response()->Json(['status' => 'success']);
	}

	public function assign(Request $request)
	{

		// $customer = Customer::where('id', $request->customer_id)->update(['active' => 1]);
		$customer = User::where('id', $request->id)->update(['active' => 1]);
		return response()->Json(['status' => 'success']);
	}

	public function unassigned(Request $request)
	{
		// $customer = Customer::where('id', $request->customer_id)->update(['active' => 0]);
		// dd($request->all());
		$customer = User::where('id', $request->id)->update(['active' => 0]);
		return response()->Json(['status' => 'success']);
	}    

	// public function money(Request $request)
	// {
	// 	$customer = Customer::where('id', $request->id)->first();
	// 	$customer->update(['amount' => $customer->amount +$request->amount]);
	// 	return response()->Json(['status' => 'success']);
	// }

	public function money(Request $request)
	{    

		$customer = User::where('id',$request->id)->first();
   // dd($customer);

		$amount = new Amount();
		$amount->customer_id = $request->id;  
		$amount->amount = $request->amount;
		$amount->save();

		$payment = new Payment();
		$payment->customer_id = $request->id; 
		$payment->title="Amount Credited Rs" .$request->amount;
		$payment->credit = $request->amount;
		$payment->total_amount =$customer->amount+$request->amount;
		$payment->save();
			$customer->amount = $customer->amount+$request->amount;
		$customer->save();

		return response()->Json(['status' => 'success']);
	}

	public function paymentHistory (Request $request, $id)
	{


		$payments = Payment::Where('customer_id',$id)->get();
		return view('admin.payment.index', compact('payments'));


	}
}
