<?php

namespace App\Http\Controllers;

use App\Models\Opd;
use Illuminate\Http\Request;

class PpidPelaksanaController extends Controller
{
    public function index()
    {
        $opds = Opd::orderBy('nama_opd', 'asc')->get();
        return view('pages.ppid-pelaksana.index', compact('opds'));
    }
}
