<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Customer;
use App\User;
use App\Models\Payment;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use JWTAuth;
use Illuminate\Support\Facades\Validator;
use DB;
use JWTAuthException;
use Illuminate\Support\Facades\Storage;
use Mail;
use App\Helpers\ImageHelper;
use Illuminate\Support\Facades\URL;

class LoginController extends Controller 
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
// dd($user->findOrfail(1));
    }

    public function register(Request $request)
    {

        try{
            $user = $this->user->create([
                'fname' => $request->get('name'),
                'email' => $request->get('email'),
                'number' => $request->get('number'),
                'spassword' => $request->get('password'),
                'password' => bcrypt($request->get('password')),
                'status' => 1
            ]);                
        } catch (\Illuminate\Database\QueryException $e) 
        {
            $errorCode = $e->errorInfo[1];
            if($errorCode == '1062'){
                return response()->json(['success' => 0, 'message' => 'Duplicate Entry Exception!. User Already Registered'], 200);
            }
        }

        $data=['email'=>$request->get('email')];
// Mail::send('mail.mail', $data, function($message) use($data) {
//     $message->to($data['email']);
//     $message->subject('Welcome to AB Mart');
// });
        if($user){
            \Config::set('jwt.user', "App\User");
            \Config::set('login.providers.users.model', \App\User::class);

            $credentials = $request->only('email', 'password');

            if ($user->role == 1) {
                $role = 'vendor';
            }else{
                $role = 'user';
            }

            try 
            {
                if (!$token = JWTAuth::attempt($credentials)) 
                {
                    return response()->json(['success' => 0, 'message' => 'These credentials do not match our records.'], 200);
                }                 
            } catch (JWTAuthException $e) 
            {
                return response()->json(['success' => 0, 'message' => 'failed_to_create_token'], 200);
            } 
            return response()->json(['success' => 1, 'token' => $token, 'user_role' => $role]);
        }else{
            return response()->json(['success' => 0, 'message' => 'email already exists'], 200);
        }
// return response()->json(['success' => true, 'message' => 'User created successfully']);
    }

    public function login(Request $request)
    {
// dd( \Config::set('jwt.user', "App\User"));
// echo \Config::get('jwt.user');
// exit;
// \Config::set('jwt.user', "App\Customer");
        \Config::set('jwt.user', "App\User");
        \Config::set('login.providers.users.model', \App\User::class);

        if (is_numeric($request->mobileno)) {
            $credentials = [
                'mobileno' => $request->mobileno,
                'password' => 'admin@123'
            ];
        }

// else{
//     $credentials = [
//         'email' => $request->username,
//         'password' => $request->password
//     ]; 
// }


        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['success' => 0, 'message' => 'These credentials do not match our records.'], 200);
            } 


        } catch (JWTAuthException $e) {
            return response()->json(['success' => 0, 'message' => 'failed_to_create_token'], 200);
        } 

        $user = JWTAuth::user();
        $user->otp = rand(99,9999);
        $user->otp_verify = 0;
        $user->save();


        return response()->json(['success' => 1, 'token' => $token, 'id' => $user->id, 'otp' => $user->otp,'user'=>$user]);
    }

    public function changepassword(Request $request){

        $this->validate($request, [
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required|min:6|same:password',
        ]);

        $user = JWTAuth::user();

        if (Hash::check($request->oldpassword, $user->password)) { 
            $user->password = Hash::make($request->password);
            $user->spassword = $request->password;
            $user->save();
            return response()->json(['success' => 1,'message'=>'password changed successfully']);
        }else{
            return response()->json(['success' => 0,'message'=>'old password not match']);
        }
    }

    public function update_user(Request $request)
    {
        $param = $request->all();

        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'number' => 'required|numeric',
        ]);

        if($validation->fails()){
            $errors = $validation->errors();
            return response()->json(['status' => false, 'message' => $errors], 200);
        }

        if ($request->hasFile('image')) {
            $name = ImageHelper::saveUploadedImage(request()->image, 'users', storage_path("app/public/uploads/users/"));
            $param['image']= $name;
        }

        $update= User::findOrfail(JWTAuth::user()->id);
        $update->fname = $param['name'];
        $update->number = $param['number'];
        $update->image = !empty($param['image']) ? $param['image'] : $update->image;
        $update->save();
        $update->image = !empty($update->image) ? url('/storage/uploads/users/Medium').'/'.$update->image : '';

        return response()->json(['status' => true, 'message' => 'User was successfully updated.', 'data' => $update ], 200);
    }

    public function getUser(Request $request){

        $user = User::findOrfail(JWTAuth::user()->id);
        $user->image = !empty($user->image) ? url('/storage/uploads/users/Medium').'/'.$user->image : '';

        if ($user) {
            return response()->json(['status' => 1, 'message' => 'User details fetched successfully updated.', 'data' => $user ], 200); 
        }else{
            return response()->json(['status' => 0, 'message' => 'No data found!', 'data' => '' ], 200);  
        }
    }

    public function otpVerify(Request $request){
        $user = JWTAuth::user();

        if ($user->otp == $request->otp) {

            $user->otp_verify = 1;
            $user->save();

            return response()->json(['success' => 1, 'message' => 'otp verify successfully', 'data' => $user ]);
        }else{
            return response()->json(['success' => 0, 'message' => 'otp is wrong! please try again!']);
        }
    }

    public function paymentHistory(Request $request){
        $user = JWTAuth::user();     
        $paymentHistories= Payment::where('customer_id',$user->id)->orderBy('id','desc')->get();  
        $paymenthistories=[];

        foreach ($paymentHistories as $key ) {
            if ($key->credit > 0) {
               $is_credit = 1;
            }else{
                $is_credit = 0;
            }
        $paymenthistories[]=[
                'id'=>$key->id,
                'user_id'=>$user->id,
                'user_name'=>$user->name,
                'note'=>$key->title,
                'is_credit'=> $is_credit,
                'credit'=>$key->credit,
                'debit'=>$key->debit,
                'total_amount'=>$key->total_amount,
                'created_at'=>\Carbon\Carbon::parse($key->created_at)->format('d-m-Y'),
        ];
        }

        return response()->json(['success' => 1, 'message' => 'Payment History Listing Successfully', 'data' => $paymenthistories,'user'=>$user ]);                    
    }
}
