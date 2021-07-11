<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class LoginController extends Controller{

    public function redirectToHome(Request $request){
        if(Gate::allows('isAdmin')){
            return redirect()->route('manage');
        }
        elseif(Gate::allows('isSeller')){
            if(auth()->user()->seller){
                return redirect()->route('manage');
            }
            else{
                return redirect()->route('profile');
            }
        }
        elseif(Gate::allows('isBuyer')){
            return redirect()->route('home');
        }
        else{
            auth()->logout();

            return redirect()->route('login');
        }
    }

}
