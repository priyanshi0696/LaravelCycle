<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index()
    {
 return view ('admin.dashboard');
    }

    public function getuser()
    {

        //$user = \Illuminate\Support\Facades\Auth::user();

        $data=User::get()->toArray();

        return view('admin.user')->with(compact('data'));
    }



    public function addstore(Request $request)
    {

           /* $validator = Validator::make($request->all(), [
            'name' =>'required',
            'email'=>'required|email|unique:user',
            'password' => 'required|min:8',
           'passwordconfirm' =>'required|same:password|min:8'

        ]);
        if ($validator->fails()) {
            return response()->json([
                        'error' => $validator->errors()->all()
                    ]);
        }*/

        $userID = $request->user_id;
        $user   =   User::updateOrCreate(['id' => $userID],
                    ['name' => $request->name, 'email' => $request->email , 'password' =>$request->password]);

                    return response()->json(['success' => 'User created successfully.']);
    }

    public function edit($id)
    {

        $where = array('id' => $id);
        $user  = User::where($where)->first();

        return Response::json($user);
    }
    public function destroy($id)
    {
        $user = User::where('id',$id)->delete();

        return Response::json(['success' => 'Delete successfully.']);
    }
}