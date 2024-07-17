<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function getSignup(){
        return view('user.signup');
    }

    public function postSignup(Request $request){
        $this->validate($request,[
            'email'=>'email|required|unique:users',
            'password'=>'required|min:4'
        ]);

        $user = new User([
            'email'=>$request->input('email'),
            'password'=>bcrypt($request->input('password'))
        ]);
        $user->save();

        Auth::login($user);

        return redirect()->route('user.profile');
    }

    public function getSignin(){
        return view('user.signin');
    }

    public function postSignin(Request $request){
        $this->validate($request,[
            'email'=>'email|required',
            'password'=>'required|min:4'
        ]);

        if(Auth::attempt(['email'=>$request->input('email'),  'password'=>$request->input('password')])){
            return redirect()->route('user.profile');
        }
        return redirect()->back();
    }

    public function getProfile() {
        $orders = Auth::user()->orders;
        $orders->transform(function($order, $key) {
            $order->cart = unserialize($order->cart);
            return $order;
        });
        return view('user.profile', ['orders' => $orders]);
    }

    public function getLogout(Request $request){
        Auth::logout();
        $sessionId = Session::getId();
        $sessionPath = storage_path('framework\sessions\\' . $sessionId);
        if (file_exists($sessionPath)) {
            unlink($sessionPath);
        }
        return redirect()->route('user.signin');
    }
}
