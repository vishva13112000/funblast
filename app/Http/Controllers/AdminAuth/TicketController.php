<?php

namespace App\Http\Controllers\AdminAuth;
use App\Models\Ticket;
use app\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Ride;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Hash;



    class TicketController extends Controller
    {



        public function __construct()
        {
            $this->middleware('auth');
        }

        public function viewLogin()


        {
            return view('login');
        }
        public function login(Request $request)
        {
            $request->validate([
                'email'=>'required|email',
                'password'=>'required|string',
            ]);

            $email = $request->email;
            $password = $request->password;

            if(Auth::attemp(['email' => $email, 'password' => $password]))
            {
                return redirect()->intended('form/page_test/new');
            }
            return redirect('form/login/view/new')->with('error','wrong password or username');
        }
        public function logout()
        {
            Auth::logout();
        }

        public function index(Request $request)
        {
        // $userss = users::all();

        // return view('users.index', compact('userss'));

                $rides = Ticket::get();

            return view('admin.ticket.index',compact('rides'));

        }
        public function create()
        {
            // $data['customers'] = Customer::where('active',1)->get();

            // $data['rides'] = Ride::where('active',1)->get();

            // return view('admin.ticket.create')->with($data);
        }

        public function store(Request $request)
        {
            request()->validate([

                'name' => 'required',
               

            ]);

            $param = $request->all();

            if ($request->file('image')) {
                $image=$request->file('image');
                $destinationPath = 'image/';
                $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move(public_path($destinationPath), $profileImage);

                $param['image'] = $profileImage;          
            }

            $param['password'] = Hash::make($request->password);

            Ticket::create($param);

            return redirect()->route('ticket.index');




        }
        public function edit($id)
        {
      //
        }
        public function update(Request $request, $id)
        {
//
        
        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\users  $users
     * @return \Illuminate\Http\Response
     */
    

    public function show($id)
    {

      //
    }
    public function destroy(Request $request)
    {
        // dd($users);
   //
    }
    public function selectamount(Request $request)
    {
 //            $ride=Ride::where('id',$request->ride_id)->first();

 // return response()->Json(['status' => 'success','ride'=>$ride]);
 //   //
    }
}