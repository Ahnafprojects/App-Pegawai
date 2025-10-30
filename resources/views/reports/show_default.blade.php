@extends('employees.master')
@section('title', 'Hasil Laporan')
@section('page-title', $config->report_name)

@section('content')
<div class="max-w-7xl mx-auto px-4">
     <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">{{ $config->report_name }}</h1>
            <p class="text-sm text-gray-500">Jenis Laporan tidak dikenali: {{ $config->report_type }}</p>
        </div>
        <a href="{{ route('reports.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">← Kembali ke Daftar Laporan</a>
    </div>
    <div class="bg-white shadow-md rounded-lg p-6 text-center text-red-500">
        Tampilan untuk jenis laporan ini belum tersedia.
    </div>
</div>
@endsection