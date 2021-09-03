<?php

namespace App\Http\Controllers\AdminAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Branch;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

class BranchController extends Controller
{
    public function index()
    {
         $branches = Branch::get();
        return view('admin.branch.index', compact('branches'));
     }
      public function create()
    {
        $branches = Branch::all();
     
        return view('admin.branch.create',compact('branches'));
    }

    public function store(Request $request)
    {
        $branch = new Branch();
        $branch->name = $request->name;
        $branch->email = $request->email;
        $branch->viewpassword = $request->password;
        $branch->password = Hash::make($request->password);
      
        $branch->created_by = Auth::user()->id;
 
        $branch->save();
        return response()->Json(['status' => 'success']);
    }

    public function edit($id)
    { 
        $branch = Branch::where('id', $id)->first();

        return view('admin.branch.edit', compact('branch'));
    }
   
    public function update (Request $request)
    {
        
        $branch = Branch::where('id', $request->hidden_id)->first();
        $branch->name = $request->name;
        $branch->email = $request->email;
        if(!empty($request->password)){
            $branch->password = Hash::make($request->password);
            $branch->viewpassword = $request->password;
        }
        $branch->created_by = Auth::user()->id;      
         $branch->save();
        return response()->Json(['status' => 'success']);
    }

    public function assign(Request $request)
    {

        $branch = Branch::where('id', $request->id)->update(['active' => 1]);
        return response()->Json(['status' => 'success']);
    }

    public function unassigned(Request $request)
    {
      
    
        $branch = Branch::where('id', $request->id)->update(['active' => 0]);
        return response()->Json(['status' => 'success']);
    }    


}
