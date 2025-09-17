<?php

namespace App\Http\Controllers;

use App\Models\Regulation;
use Illuminate\Http\Request;

class RegulationController extends Controller
{
    public function index()
    {
        // $listRegulasi = Regulation::paginate(10);
        // buatkan query untuk mengambil data dari tabel regulations dengan kondisi issue_date sudah terbit (issue_date <= hari ini) dan diurutkan berdasarkan issue_date dari yang terbaru ke yang terlama dan diambil 10 data saja
        $listRegulasi = Regulation::where('issue_date', '<=', date('Y-m-d'))
            ->orderBy('issue_date', 'desc')
            ->paginate(10);

        return view("pages.regulation.index", [
            "listRegulasi" => $listRegulasi
        ]);
    }
}
