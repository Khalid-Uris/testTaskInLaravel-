<?php

namespace App\Http\Controllers;

use App\Models\UserM;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //

    public function loginView()
    {
        return view('admin.login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
        try {
            $is_email_exists=UserM::where('email',$request->email)->first();

            $is_password_exists=UserM::where('password',$request->password)->first();
            //Hash::check($request->password, $is_email_exists->password)

            if ($is_email_exists) {

                if ($is_password_exists) {
                    session([
                                'admin_id'=>$request->email,
                            ]);
                            return redirect()->route('admin.showUser');
                } else {
                    return back()->withError('Password does not match');
                }

            } else {
                return back()->withError('Email does not exists');
            }

            // if ($request->email=='admin@admin.com' and $request->password=='admin') {
            //     session([
            //         'admin_id'=>$request->email,
            //     ]);
            //     return redirect()->route('admin.showUser');
            // }
            // else
            // {
            //     return back()->withError('Email and Password does not match');
            // }
        } catch (Exception $ex) {
            return back()->withError($ex->getMessage());
        }

    }
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('user.login');
    }
}
