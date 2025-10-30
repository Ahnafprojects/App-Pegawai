@extends('employees.master') {{-- Sesuaikan layout master --}}
@section('title', 'Tambah Jabatan')
@section('page-title', 'Tambah Jabatan Baru')

@section('content')
<div class="max-w-lg mx-auto px-4">
    <div class="bg-white shadow-md rounded-lg p-6">
        <form action="{{ route('positions.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="nama_jabatan" class="block text-sm font-medium text-gray-700 mb-1">Nama Jabatan <span class="text-red-500">*</span></label>
                <input type="text" id="nama_jabatan" name="nama_jabatan" value="{{ old('nama_jabatan') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nama_jabatan') border-red-500 @enderror"
                       required>
                @error('nama_jabatan') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="mb-4">
                <label for="gaji_pokok" class="block text-sm font-medium text-gray-700 mb-1">Gaji Pokok (Rp) <span class="text-red-500">*</span></label>
                <input type="number" id="gaji_pokok" name="gaji_pokok" value="{{ old('gaji_pokok') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('gaji_pokok') border-red-500 @enderror"
                       required min="0" step="1000">
                @error('gaji_pokok') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-between items-center mt-6 pt-4 border-t">
                <a href="{{ route('positions.index') }}" class="text-gray-600 hover:text-gray-800 text-sm">Batal</a>
                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection