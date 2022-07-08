<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class settingController extends Controller
{
    public function getSetting()
    {
        $result = User::findOrFail(auth()->id());
        return view('admin.setting', compact('result'));
    }

    public function updateSetting(Request $request)
    {
        $user = User::findOrFail(auth()->id());
        if($request->password == null)
        {
            $request->validate([
                'email'=> ['required','string','min:5', Rule::unique('users') ->ignore($user->id)],
                //'password'=>['required','string','min:6', Rule::unique('students')/*->ignore($user->id)*/],
            ]);

            //dd($request);
            $user->update([
                'email'=>$request->email
            ]);
        }
        else
        {
            $request->validate([
                'email'=> ['required','string','min:5', Rule::unique('users') ->ignore($user->id)],
                'password'=>['required','string','min:6', Rule::unique('users')],
            ]);

            $user->update([
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
            ]);

        }

        $request->session()->flash('update');
        return redirect()->route('admin.setting');
    }

}
