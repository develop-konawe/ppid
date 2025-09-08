<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.contact.index');
    }


    public function submit(Request $request)
    {

        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'nullable|string|max:100',
            'email'      => 'required|email',
            'subject'    => 'required|string|max:150',
            'message'    => 'required|string|min:10',
            'agree'      => 'accepted',
        ]);


        Contact::create($validated);

        // Bisa juga kirim email notifikasi di sini

        return redirect()->back()->with('success', 'Pesan Anda berhasil dikirim!');
    }
}
