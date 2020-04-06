<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
class UserProfileController extends Controller
{
    public function index(){
        
        return view('admin.user_profile.index');
    }
    
    public function changeProfile(Request $request){
        
        $formData=$request->validate([
            'name'=>['required','string','min:3'],
            'phone_number'=>['required','string','min:6'],
            'image'=>['nullable','file','image','max:51200'],
        ]);
        
        
        \Auth::user()->fill($formData);
        \Auth::user()->save();
        
        return redirect()->route('admin.index.index');
        
    }
}
