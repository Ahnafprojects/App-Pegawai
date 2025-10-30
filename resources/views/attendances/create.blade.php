@extends('employees.master')
@section('title', 'Tambah Absensi')
@section('page-title', 'Tambah Absensi Manual')

@section('content')
<div class="max-w-xl mx-auto px-4">
    <div class="bg-white shadow-md rounded-lg p-6">
        <form action="{{ route('attendances.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="karyawan_id" class="block text-sm font-medium text-gray-700 mb-1">Pilih Karyawan <span class="text-red-500">*</span></label>
                <select id="karyawan_id" name="karyawan_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('karyawan_id') border-red-500 @enderror" required>
                    <option value="">-- Pilih Karyawan --</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}" {{ old('karyawan_id') == $employee->id ? 'selected' : '' }}>{{ $employee->nama_lengkap }}</option>
                    @endforeach
                </select>
                @error('karyawan_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-1">Tanggal <span class="text-red-500">*</span></label>
                    <input type="date" id="tanggal" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('tanggal') border-red-500 @enderror" required>
                     @error('tanggal') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                 <div>
                    <label for="status_absensi" class="block text-sm font-medium text-gray-700 mb-1">Status Absensi <span class="text-red-500">*</span></label>
                    <select id="status_absensi" name="status_absensi" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('status_absensi') border-red-500 @enderror" required>
                        <option value="hadir" {{ old('status_absensi') == 'hadir' ? 'selected' : '' }}>Hadir</option>
                        <option value="izin" {{ old('status_absensi') == 'izin' ? 'selected' : '' }}>Izin</option>
                        <option value="sakit" {{ old('status_absensi') == 'sakit' ? 'selected' : '' }}>Sakit</option>
                        <option value="alpha" {{ old('status_absensi') == 'alpha' ? 'selected' : '' }}>Alpha</option>
                    </select>
                    @error('status_absensi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

             <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="waktu_masuk" class="block text-sm font-medium text-gray-700 mb-1">Waktu Masuk</label>
                    <input type="time" id="waktu_masuk" name="waktu_masuk" value="{{ old('waktu_masuk') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('waktu_masuk') border-red-500 @enderror">
                    @error('waktu_masuk') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                 <div>
                    <label for="waktu_keluar" class="block text-sm font-medium text-gray-700 mb-1">Waktu Keluar</label>
                    <input type="time" id="waktu_keluar" name="waktu_keluar" value="{{ old('waktu_keluar') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('waktu_keluar') border-red-500 @enderror">
                    @error('waktu_keluar') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex justify-between items-center mt-6 pt-4 border-t">
                <a href="{{ route('attendances.index') }}" class="text-gray-600 hover:text-gray-800 text-sm">Batal</a>
                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300">
                    Simpan Absensi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection