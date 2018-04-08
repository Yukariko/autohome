<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Signal;

class SignalController extends Controller
{
    public function __construct()
    {
    }

    public function listup()
    {
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
