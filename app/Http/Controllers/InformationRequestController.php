<?php

namespace App\Http\Controllers;

use App\Models\InformationRequest;
use Illuminate\Http\Request;

class InformationRequestController extends Controller
{
    public function index()
    {
        $opds = \App\Models\Opd::orderBy('nama_opd')->get();
        return view('pages.permohonan.index', compact('opds'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'opd_id' => 'required|exists:opds,id',
            'kategori_pemohon' => 'required|string',
            'nik_no_identitas' => 'required|string|max:50',
            'nama_lengkap' => 'required|string|max:100',
            'alamat' => 'required|string',
            'email' => 'required|email|max:100',
            'no_telp' => 'required|string|max:20',
            'pekerjaan' => 'required|string|max:100',
            'rincian_informasi' => 'required|string',
            'tujuan_penggunaan' => 'required|string',
            'cara_memperoleh' => 'required|string|in:Melihat/Membaca/Mendengarkan/Mencatat,Mendapatkan Salinan Hardcopy,Mendapatkan Salinan Softcopy',
            'cara_mendapatkan' => 'required|string|in:Mengambil Langsung,Kurir/Pos,Faksimili,Email',
            'foto_ktp' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('foto_ktp')) {
            $validated['foto_ktp'] = $request->file('foto_ktp')->store('permohonan/ktp', 'public');
        }

        $informationRequest = InformationRequest::create($validated);

        try {
            // Mengambil semua email user yang memiliki is_super_admin = true
            $adminEmails = \App\Models\User::where('is_super_admin', true)->pluck('email')->toArray();
            
            // Tambahkan email admin dari OPD tujuan (jika ada)
            if ($informationRequest->opd_id) {
                $opdAdmins = \App\Models\User::where('opd_id', $informationRequest->opd_id)->pluck('email')->toArray();
                $adminEmails = array_unique(array_merge($adminEmails, $opdAdmins));
            }
            
            if (!empty($adminEmails)) {
                \Illuminate\Support\Facades\Mail::to($adminEmails)->send(new \App\Mail\AdminInformationRequestMail($informationRequest));
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Failed to send admin notification email: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Permohonan informasi Anda telah berhasil dikirim. Kami akan memprosesnya dan memberikan balasan ke email Anda.');
    }

    /**
     * Cetak / tampilkan halaman PDF permohonan.
     * Hanya dapat diakses oleh user yang sudah login (admin/petugas PPID).
     */
    public function printPdf(InformationRequest $informationRequest)
    {
        abort_unless(auth()->check(), 403, 'Akses ditolak.');

        $permohonan = $informationRequest->load(['information', 'responder']);

        return view('print.permohonan', compact('permohonan'));
    }

    public function checkStatus()
    {
        return view('pages.permohonan.status');
    }

    public function processCheckStatus(Request $request)
    {
        $validated = $request->validate([
            'nik_no_identitas' => 'required|string',
            'email' => 'required|email'
        ]);

        $requests = InformationRequest::where('nik_no_identitas', $validated['nik_no_identitas'])
            ->where('email', $validated['email'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.permohonan.status', compact('requests', 'validated'));
    }
}
