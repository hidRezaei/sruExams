<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Models\Elanat;
use Illuminate\Http\Request;

class elanatController extends Controller
{
    public function index()
    {
        $elanats = Elanat::paginate(10);
        return view('admin.elanat.index', compact('elanats'));
    }

    public function create($aid)
    {
        return view('admin.elanat.create',compact('aid'));
    }

    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            //'name'=>'required|string|max:255',
            'Text'=> ['required','string','max:3000' ],
            //'Subject2'=> ['integer'],
            //'role'=>'required|max:255'
        ]);

        Elanat::create([
            //'SenderID'=>auth('student')->id() ,
            'ReceiverID'=>-10001,
            'Title'=>$request->Title ,
            'Text'=>$request->Text ,
        ]);

        $request->session()->flash('create');
        return redirect()->route('admin.elanat.index',-10001);
    }

    public function show($id)
    {
        //
    }

    public function edit($aid,$eid)
    {
        $elanat = Elanat::findOrFail($eid);
        return view('admin.elanat.edit', compact('elanat'));
    }

    public function update(Request $request,$aid,$eid)
    {
        $elanat = Elanat::findOrFail($eid);
        //dd($request);
        $request->validate([
            //'name'=>'required|string|max:255',
            'Text'=> ['required','string','max:3000' /*->ignore($user->id)*/],
            //'Subject2'=> ['integer'],
            //'role'=>'required|max:255'
        ]);

        $elanat->update([
            //'SenderID'=>auth('student')->id() /*$request->SenderID*/ ,
            //'ReceiverID'=>-10001,
            'Title'=>$request->Title ,
            'Text'=>$request->Text,
        ]);

        $request->session()->flash('update');
        return redirect()->route('admin.elanat.index',$aid);
    }

    public function destroy($aid,$eid)
    {
        $elanat = Elanat::findOrFail($eid);
        $elanat->destroy($eid);
        return redirect()->route('admin.elanat.index',$aid);
    }
}
