<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Signal;
use App\Log;


class LogController extends Controller
{
    //
    public function __construct()
    {

    }

    public function listup($id = 0)
    {
        $signals = Signal::all();
        $signalList = [];
        foreach($signals as $signal)
        {
            $signalList = array_add($signalList, $signal->id, $signal->name);
        }
        return view('log', [
            'signals' => $signalList,
            'logs' => Log::getById($id)
        ]);
    }

    public function storeLog(Request $request)
    {
        $validatedData = $request->validate([
            'signal_id' => 'required|exists:signals,id',
            'value' => 'required|max:255'
        ]);
        Log::create([
            'signal_id' => $request->signal_id,
            'value' => $request->value
        ]);
        return $this->listup();
    }
}
