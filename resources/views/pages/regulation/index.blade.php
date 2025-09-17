@extends('layouts.app')

@section('title', 'Regulasi')

@push('style')
@endpush

@section('content')
    <section id="contact" class="bg-light">
        <div class="container-fluid p-0">
            <div class="row mx-0">
                <div class="col-md-2 p-0">
                    <div class="footer_bottom_left contact_left text-xl-end p-3 position-relative">
                        <span class="text-white fs-6 fw-bold ms-5">Regulasi</span>
                    </div>
                </div>
                <div class="col-md-10 p-0">
                    <div class="contact_righto  p-3 bg-white">
                        <span class="mb-0 font_11 light_gray"><a class="fw-bold" href="{{ route("home") }}">Beranda</a> <span class="mx-2">/</span> Regulasi</span>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="news" class="pt-5 pb-5 bg-light">
        <div class="container-xl">
            <div class="row">
            <div class="col">
                <table class="table table-bordered table-info border-primary">
                    <thead class="table-dark">
                        <tr>
                            <td>No</td>
                            <td>Judul</td>
                            <td>File</td>
                            <td>Tanggal Upload</td>
                            <td>Keterangan</td>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($listRegulasi as $regulasi)
                        <tr>
                            {{-- Nomor berurutan antar halaman --}}
                            <td>
                                {{ ($listRegulasi->currentPage() - 1) * $listRegulasi->perPage() + $loop->iteration }}
                            </td>
                            <td>{{ $regulasi->title }}</td>
                            <td>
                                @if($regulasi->doc_url)
                                    <a href="{{ asset('storage/' . $regulasi->doc_url) }}" target="_blank" class="btn btn-sm btn-primary">Download</a>
                                @else
                                    No File
                                @endif
                            </td>
                            <td>{{ $regulasi->issue_date->translatedFormat('d F Y') }}</td>
                            <td>{{ $regulasi->summary }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data</td>
                        </tr>
                    @endforelse
                    </tbody>

                </table>
            </div>
        </div>

            <div class="mt-4 text-center">
                {{ $listRegulasi->links('layouts.pagination.index') }}
            </div>
        </div>
    </section>
@endsection

@push('script')
@endpush

