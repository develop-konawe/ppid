@extends('layouts.app')

@section('title', $announcement->title)

@push('meta-head')
    <meta property="og:title" content="{{ $announcement->title }}">
    <meta property="og:description" content="{{ Str::limit(strip_tags($announcement->description), 150) }}">
    <meta property="og:image" content="{{ asset('storage/'.$announcement->image) }}">
    <meta property="og:url" content="{{ route('announcement.detail', $announcement->slug) }}">
    <meta property="og:type" content="article">
@endpush

@push('scripts-head')
@endpush

@push('styles')
@endpush

@section('content')

@endsection

@push('scripts')
@endpush
