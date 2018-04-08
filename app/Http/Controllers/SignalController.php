<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Signal;
use Auth;

class SignalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listup()
    {
        if( Auth::user()->name != "yukariko")
            return abort(404);
        return view('signal', ['signals' => Signal::all()]);
    }

    public function storeSignal(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:signals|max:255',
            'description' => 'required|max:255'
        ]);
        Signal::create([
            'name' => $request->name,
            'description' => $request->description
        ]);
        return $this->listup();
    }
}
