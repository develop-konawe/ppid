<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrivacyController extends Controller
{
    public function kebijakanPrivasi()
    {
        return view('pages.privacy.kebijakan-privasi');
    }

    public function syaratKetentuan()
    {
        return view('pages.privacy.syarat-ketentuan');
    }

    public function aksesibilitas()
    {
        return view('pages.privacy.aksesibilitas');
    }
}
