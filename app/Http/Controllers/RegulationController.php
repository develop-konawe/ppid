<?php

namespace App\Http\Controllers;

use App\Models\Regulation;
use Illuminate\Http\Request;

class RegulationController extends Controller
{
    public function index()
    {
        $data = Regulation::all();

        return view("pages.regulation.index", [
            "data" => $data
        ]);
    }
}
