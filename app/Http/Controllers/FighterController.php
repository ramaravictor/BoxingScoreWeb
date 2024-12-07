<?php

namespace App\Http\Controllers;

use App\Models\Fighter;

class FighterController extends Controller
{
    public function index()
    {
        $fighters = Fighter::all();

        return view('fighter', compact('fighters'));
    }
}
