<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ride;
use App\Models\Ticket;
use JWTAuth;
use App\Models\Payment;

class TicketController extends Controller
{

	public function index(Request $request)
	{
		$param = $request->all();
		$param['total_ammount'] = round(Ride::where('id',$param['ride_id'])->value('ammount') * $param['persons']);

		$user = JWTAuth::user();


		if ($user->amount < $param['total_ammount']) {
			return response()->json(['success' => 0, 'meessage'=> 'Insufficient Balance'],200);
		}else{

			// $ticket = Ticket::create($param);

			$user->amount = $user->amount - $param['total_ammount'];
			$user->save();

			$paymentHistories= Payment::where('customer_id',$user->id)->create([
				'customer_id' => $user->id,
				'title' => 'Amount dedited Rs'.$param['total_ammount'],
				'debit' => $param['total_ammount'],
				'total_amount' => $user->amount,
				'person' => $param['persons'],
				'ride_id' => $param['ride_id'],
				'ride_price' => Ride::where('id',$param['ride_id'])->value('ammount'),
			]);  

			if ($paymentHistories) {
				return response()->json(['success' => 1, 'data'=> $paymentHistories],200);
			}else{
				return response()->json(['success' => 0, 'data'=> ''],200);
			}
		}

		
	}

}