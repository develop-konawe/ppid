<?php

namespace App\Http\Controllers;

use App\Models\PublicInformation;
use Illuminate\Http\Request;

class InformasiPublicController extends Controller
{
    public function berkala(Request $request)
    {
        $data = PublicInformation::query()
            ->where('information_type', 'berkala')
            ->where('status', 'published')
            ->with(['opd', 'category'])
            ->latest()
            ->paginate(10);

        return view('ppid.berkala', compact('data'));
    }

    /**
     * Informasi Setiap Saat
     */
    public function setiapSaat(Request $request)
    {
        $data = PublicInformation::query()
            ->where('information_type', 'setiap_saat')
            ->where('status', 'published')
            ->with(['opd', 'category'])
            ->latest()
            ->paginate(10);

        return view('ppid.setiap-saat', compact('data'));
    }

    /**
     * Informasi Serta Merta
     */
    public function sertaMerta(Request $request)
    {
        $data = PublicInformation::query()
            ->where('information_type', 'serta_merta')
            ->where('status', 'published')
            ->with(['opd', 'category'])
            ->latest()
            ->paginate(10);

        return view('ppid.serta-merta', compact('data'));
    }

    /**
     * Informasi Dikecualikan
     */
    public function dikecualikan(Request $request)
    {
        $data = PublicInformation::query()
            ->where('information_type', 'dikecualikan')
            ->where('status', 'published')
            ->with(['opd', 'category', 'exception'])
            ->latest()
            ->paginate(10);

        return view('ppid.dikecualikan', compact('data'));
    }
}
