<?php

namespace App\Http\Controllers;

class HistoryController extends Controller
{
    public function index()
    {
        // $historys = History::all();

        // return view('history', compact('historys'));

        return view('history');
    }
}
