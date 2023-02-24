<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class LoginController extends Controller
{

    use AuthenticatesUsers;

    public function login (Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|exists:admins',
            'password' => 'required|min:8',
        ]);
        if($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }
        if(Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password])){
           return redirect('/cpanel');
        }

    }


}
