<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        // ambilkan data galery dari database urutkan berdasarkan terbaru dengan pagination 10 data per halaman
        $gallery = Gallery::orderBy('created_at', 'desc')->paginate(3);

        return view("pages.gallery.index", ['gallery' => $gallery]);
    }

}
