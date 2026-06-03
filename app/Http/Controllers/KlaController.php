<?php

namespace App\Http\Controllers;

use App\Models\KlaAbout;
use App\Models\KlaAchievement;
use App\Models\KlaCluster;
use App\Models\KlaComplaint;
use App\Models\KlaDocument;
use App\Models\KlaFaq;
use App\Models\KlaGallery;
use App\Models\KlaProgram;
use App\Models\KlaRegulation;
use App\Models\KlaStatistic;

use App\Models\KlaPartner;
use App\Models\KlaService;
use Illuminate\Http\Request;

class KlaController extends Controller
{
    public function index()
    {
        // Tentang KLA (ambil yang aktif, item pertama sebagai konten utama)
        $about = KlaAbout::where('is_active', true)->latest()->first();

        // Statistik Anak (aktif, diurutkan berdasarkan order)
        $statistics = KlaStatistic::where('is_active', true)
            ->orderBy('order')
            ->get();

        // Klaster KLA (aktif, diurutkan berdasarkan order)
        $clusters = KlaCluster::where('is_active', true)
            ->orderBy('order')
            ->get();

        // Program & Kegiatan Terbaru (3 terbaru, aktif)
        $programs = KlaProgram::where('is_active', true)
            ->orderBy('event_date', 'desc')
            ->take(3)
            ->get();

        // Regulasi KLA Terbaru (5 terbaru, aktif)
        $regulations = KlaRegulation::where('is_active', true)
            ->orderBy('issue_date', 'desc')
            ->take(5)
            ->get();

        // Prestasi/Penghargaan (aktif, terbaru per tahun)
        $achievements = KlaAchievement::where('is_active', true)
            ->orderBy('year', 'desc')
            ->take(4)
            ->get();

        // Dokumen KLA (aktif, terbaru)
        $documents = KlaDocument::where('is_active', true)
            ->orderBy('issue_date', 'desc')
            ->take(6)
            ->get();

        // Galeri KLA (aktif, foto dulu baru video, 9 item)
        $galleries = KlaGallery::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->take(9)
            ->get();

        // FAQ KLA (aktif, diurutkan berdasarkan sort_order)
        $faqs = KlaFaq::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        // New CMS Data

        $partners = KlaPartner::where('is_active', true)->orderBy('order')->get();
        $services = KlaService::where('is_active', true)->get();

        return view('pages.kla.index', compact(
            'about',
            'statistics',
            'clusters',
            'programs',
            'regulations',
            'achievements',
            'documents',
            'galleries',
            'faqs',
            'partners',
            'services'
        ));
    }

    public function submitComplaint(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:20',
        ], [
            'name.required'    => 'Nama wajib diisi.',
            'email.required'   => 'Email wajib diisi.',
            'email.email'      => 'Format email tidak valid.',
            'subject.required' => 'Subjek pengaduan wajib diisi.',
            'message.required' => 'Isi pengaduan wajib diisi.',
            'message.min'      => 'Pengaduan minimal 20 karakter.',
        ]);

        KlaComplaint::create($validated);

        return redirect()->route('kla')
            ->with('success', 'Pengaduan Anda telah berhasil dikirim. Tim kami akan segera menindaklanjuti.')
            ->withFragment('pengaduan');
    }

    public function showProgram($slug)
    {
        $program = \App\Models\KlaProgram::where('slug', $slug)->where('is_active', true)->firstOrFail();

        $prev = \App\Models\KlaProgram::where('id', '<', $program->id)
            ->where('is_active', true)
            ->orderBy('id', 'desc')->first();
            
        $next = \App\Models\KlaProgram::where('id', '>', $program->id)
            ->where('is_active', true)
            ->orderBy('id', 'asc')->first();

        // Cari berita/program terkait (karena KlaProgram menggunakan category, kita cek category_id jika ada, jika tidak by terbaru)
        $relatedPrograms = \App\Models\KlaProgram::where('is_active', true)
            ->where('id', '!=', $program->id)
            ->latest()
            ->take(3)
            ->get();

        return view('pages.kla.show-program', compact('program', 'prev', 'next', 'relatedPrograms'));
    }
}
