<?php

namespace App\Http\Controllers;

use App\Charts\Linechart;
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

        $logs = Log::getById($id)->take(180)->get(); //take(10);
        $huDataset = [];
        $tempDataset = [];
        $labels = [];
        foreach($logs as $log)
        {
            $data = explode(":", $log->value);
            //array_push($huDataset, $log->id - 1000);
            array_push($huDataset, $data[0]);
            array_push($tempDataset, $data[1]);
            array_push($labels, "");
        }

        $chart = new Linechart;
        $chart->dataset('Humidity', 'line', $huDataset)->color('#00ff00');
        $chart->dataset('Temperature', 'line', $tempDataset)->color('#ff0000');
        $chart->labels($labels);
        return view('log', [
            'signals' => $signalList,
            'logs' => $logs,
            'chart' => $chart
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
