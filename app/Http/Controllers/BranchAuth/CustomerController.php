<?php

namespace App\Http\Controllers\BranchAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Amount;
use App\Models\Payment;
use App\Branch;
use App\User;
use Illuminate\Support\Facades\Auth;

use Hash;



class CustomerController extends Controller
{

	public function index()
	{
		// $customers = Customer::get();
		// $customers = User::get();
		$customers = User::where('branch_id',Auth::user()->id)->orderBy('id','desc')->get();
		// $branches = Branch::where('branch_id', Auth::user()->id)->get();
		// $customers = User::get();
		return view('branch.customer.index', compact('customers'));
	}

	public function create()
	{		
         $data["customers"] = User::get();
          $data["branches"] = Branch::get();

        return view('branch.customer.create')->with($data);
		


	}

	public function store(Request $request)
	{

		// $customer = new Customer();
		

		$customer = new User();
		// $customer = new User::where('branch_id',Auth::user()->id)->orderBy('id','desc')->get();


		// $customer = new User::Where('branch_id',$id)->Where('branch_id',Auth::user()->id)->get();
		$customer->name = $request->name;
		$customer->email = $request->email;
		$customer->mobileno = $request->mobileno;
		$customer->branch_id = Auth::user()->id;
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
		return view('branch.customer.edit', compact('customer','branches'));


	}
	public function show($id)
	{ 
		// $customer = Customer::where('id', $id)->first();
		

		$customer = User::where('id', $id)->first();
		 $branches = Branch::get();
		return view('branch.customer.show', compact('customer','branches'));

	}
	public function update (Request $request)
	{

		// $customer = Customer::where('id', $request->id)->first();

		$customer = User::where('id', $request->id)->first();


		$customer->name = $request->name;
		$customer->email = $request->email;
		$customer->mobileno = $request->mobileno;
		// $customer->branch_id = $request->branch_id;

		if(!empty($request->password)){

			$customer->password = Hash::make($request->password);
			$customer->viewpassword = $request->password;
		}
	

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


		// $payments = Payment::Where('customer_id',$id)->get();
		// $payments = Payment::where ('branch_id', Auth::user()->id)->get();
		// $payments = Payment::Where('customer_id',$id || 'branch_id', Auth::user()->id)->get();


			$payments = Payment::Where('customer_id',$id)->Where('branch_id',Auth::user()->id)->get();
		// $branches = Branch::where('branch_id', Auth::user()->id)->get();
		return view('branch.payment.index', compact('payments'));


	}
}
