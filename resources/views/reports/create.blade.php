@extends('employees.master')
@section('title', 'Buat Konfigurasi Laporan')
@section('page-title', 'Buat Konfigurasi Laporan Baru')

@section('content')
<div class="max-w-2xl mx-auto px-4">
    <div class="bg-white shadow-md rounded-lg p-6">
        <form action="{{ route('reports.store') }}" method="POST">
            @csrf
            <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">Detail Konfigurasi</h2>
            <div class="mb-4">
                <label for="report_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Konfigurasi <span class="text-red-500">*</span></label>
                <input type="text" id="report_name" name="report_name" value="{{ old('report_name') }}"
                       class="w-full input-field @error('report_name') border-red-500 @enderror" placeholder="Misal: Laporan Absensi IT Bulanan" required>
                @error('report_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div class="mb-6">
                <label for="report_type" class="block text-sm font-medium text-gray-700 mb-1">Jenis Laporan <span class="text-red-500">*</span></label>
                <select id="report_type" name="report_type" class="w-full input-field @error('report_type') border-red-500 @enderror" required>
                    <option value="">-- Pilih Jenis --</option>
                    <option value="attendance" {{ old('report_type') == 'attendance' ? 'selected' : '' }}>Laporan Absensi</option>
                    <option value="employee_list" {{ old('report_type') == 'employee_list' ? 'selected' : '' }}>Daftar Karyawan</option>
                    {{-- Tambahkan jenis laporan lain di sini --}}
                </select>
                @error('report_type') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">Filter (Opsional)</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                 <div>
                    <label for="filter_department_id" class="block text-sm font-medium text-gray-700 mb-1">Departemen</label>
                    <select id="filter_department_id" name="filter_department_id" class="w-full input-field">
                        <option value="">Semua Departemen</option>
                        @foreach($departments as $dept)
                            <option value="{{ $dept->id }}" {{ old('filter_department_id') == $dept->id ? 'selected' : '' }}>{{ $dept->nama_departemen }}</option>
                        @endforeach
                    </select>
                </div>
                 <div>
                    <label for="filter_start_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai</label>
                    <input type="date" id="filter_start_date" name="filter_start_date" value="{{ old('filter_start_date') }}" class="w-full input-field">
                </div>
                 <div>
                    <label for="filter_end_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Selesai</label>
                    <input type="date" id="filter_end_date" name="filter_end_date" value="{{ old('filter_end_date') }}" class="w-full input-field">
                </div>
            </div>

            <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">Kolom Ditampilkan <span class="text-red-500">*</span></h2>
             <div class="mb-6 space-y-2">
                 <p class="text-sm text-gray-500 mb-2">Pilih kolom yang ingin ditampilkan dalam laporan:</p>
                 {{-- Pilihan kolom akan muncul dinamis tergantung jenis laporan, tapi untuk contoh kita buat statis --}}
                 <div class="grid grid-cols-2 md:grid-cols-4 gap-x-4 gap-y-2">
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="columns[]" value="nama_lengkap" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" checked>
                        <span class="text-sm text-gray-700">Nama Lengkap</span>
                    </label>
                     <label class="flex items-center space-x-2">
                        <input type="checkbox" name="columns[]" value="email" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <span class="text-sm text-gray-700">Email</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="columns[]" value="department" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <span class="text-sm text-gray-700">Departemen</span>
                    </label>
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="columns[]" value="tanggal_absensi" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <span class="text-sm text-gray-700">Tanggal Absensi</span>
                    </label>
                     <label class="flex items-center space-x-2">
                        <input type="checkbox" name="columns[]" value="waktu_masuk" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <span class="text-sm text-gray-700">Waktu Masuk</span>
                    </label>
                     <label class="flex items-center space-x-2">
                        <input type="checkbox" name="columns[]" value="waktu_keluar" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <span class="text-sm text-gray-700">Waktu Keluar</span>
                    </label>
                     <label class="flex items-center space-x-2">
                        <input type="checkbox" name="columns[]" value="status_absensi" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <span class="text-sm text-gray-700">Status Absensi</span>
                    </label>
                     {{-- Tambahkan kolom lain --}}
                 </div>
                 @error('columns') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-between items-center mt-6 pt-4 border-t">
                <a href="{{ route('reports.index') }}" class="text-gray-600 hover:text-gray-800 text-sm">Batal</a>
                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300">
                    Simpan Konfigurasi
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Helper CSS untuk field input --}}
<style>
    .input-field {
        padding: 0.5rem 0.75rem;
        border: 1px solid #D1D5DB; /* border-gray-300 */
        border-radius: 0.375rem; /* rounded-md */
        font-size: 0.875rem; /* text-sm */
    }
    .input-field:focus {
        outline: none;
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5); /* ring-2 focus:ring-blue-500 */
        border-color: #3B82F6; /* focus:border-blue-500 */
    }
</style>
@endsection