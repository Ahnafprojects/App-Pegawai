@extends('employees.master')
@section('title', 'Pengaturan')
@section('page-title', 'Pengaturan Aplikasi')

@section('content')
<div class="max-w-2xl mx-auto px-4">
    @if (session('success'))
        {{-- Tampilkan notifikasi sukses di sini --}}
        <div class="mb-4 p-3 bg-green-100 text-green-700 border border-green-200 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg p-6">
        <form action="{{ route('settings.update') }}" method="POST">
            @csrf
            {{-- Method bisa PUT atau POST tergantung route --}}
            {{-- @method('PUT') --}} 

            <h2 class="text-xl font-semibold text-gray-800 mb-4">Pengaturan Umum</h2>
            
            {{-- Contoh Field Pengaturan --}}
            <div class="mb-4">
                <label for="nama_perusahaan" class="block text-sm font-medium text-gray-700 mb-1">Nama Perusahaan</label>
                <input type="text" id="nama_perusahaan" name="nama_perusahaan" 
                       value="{{-- old('nama_perusahaan', $settings['nama_perusahaan'] ?? '') --}}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
             <div class="mb-4">
                <label for="jam_masuk" class="block text-sm font-medium text-gray-700 mb-1">Jam Masuk Default</label>
                <input type="time" id="jam_masuk" name="jam_masuk" 
                       value="{{-- old('jam_masuk', $settings['jam_masuk'] ?? '08:00') --}}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            {{-- Tambahkan field pengaturan lain --}}

            <div class="mt-6 pt-4 border-t">
                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300">
                    Simpan Pengaturan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection