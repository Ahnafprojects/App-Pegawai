@extends('employees.master')
@section('title', 'Tambah Pegawai')
@section('content')
<div class="max-w-3xl mx-auto px-4 py-2">
    <div class="mb-3">
        <h1 class="text-xl font-bold text-gray-800">Tambah Pegawai Baru</h1>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="bg-blue-500 px-4 py-2">
            <h2 class="text-base font-semibold text-white">Form Data Pegawai</h2>
        </div>
        
        <div class="p-3">
            <form action="{{ route('employees.store') }}" method="POST" class="space-y-3">
                @csrf
                
                <div class="grid grid-cols-3 gap-3">
                    <div>
                        <label for="nama_lengkap" class="block text-xs font-medium text-gray-700 mb-1">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="nama_lengkap" 
                               name="nama_lengkap"
                               class="w-full px-2 py-1.5 border border-gray-300 rounded text-xs focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Nama lengkap"
                               required>
                    </div>

                    <div>
                        <label for="email" class="block text-xs font-medium text-gray-700 mb-1">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email" 
                               id="email" 
                               name="email"
                               class="w-full px-2 py-1.5 border border-gray-300 rounded text-xs focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="email@domain.com"
                               required>
                    </div>

                    <div>
                        <label for="nomor_telepon" class="block text-xs font-medium text-gray-700 mb-1">
                            Telepon <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="nomor_telepon" 
                               name="nomor_telepon"
                               class="w-full px-2 py-1.5 border border-gray-300 rounded text-xs focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="08xxxxxxxxxx"
                               required>
                    </div>

                    <div>
                        <label for="tanggal_lahir" class="block text-xs font-medium text-gray-700 mb-1">
                            Tanggal Lahir <span class="text-red-500">*</span>
                        </label>
                        <input type="date" 
                               id="tanggal_lahir" 
                               name="tanggal_lahir"
                               class="w-full px-2 py-1.5 border border-gray-300 rounded text-xs focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                               required>
                    </div>

                    <div>
                        <label for="tanggal_masuk" class="block text-xs font-medium text-gray-700 mb-1">
                            Tanggal Masuk <span class="text-red-500">*</span>
                        </label>
                        <input type="date" 
                               id="tanggal_masuk" 
                               name="tanggal_masuk"
                               class="w-full px-2 py-1.5 border border-gray-300 rounded text-xs focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                               required>
                    </div>

                    <div>
                        <label for="status" class="block text-xs font-medium text-gray-700 mb-1">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <select id="status" 
                                name="status"
                                class="w-full px-2 py-1.5 border border-gray-300 rounded text-xs focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                                required>
                            <option value="">Pilih Status</option>
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Non-Aktif</option>
                        </select>
                    </div>
                    <div class="grid grid-cols-2 gap-3"> {{-- Buka grid baru --}}
    <div>
        <label for="departemen_id" class="block text-xs font-medium text-gray-700 mb-1">
            Department
        </label>
        <select id="departemen_id" name="departemen_id"
                class="w-full px-2 py-1.5 border border-gray-300 rounded text-xs focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
            <option value="">Pilih Department</option>
            @foreach($departments as $dept)
                <option value="{{ $dept->id }}" {{ old('departemen_id') == $dept->id ? 'selected' : '' }}>{{ $dept->nama_departemen }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="jabatan_id" class="block text-xs font-medium text-gray-700 mb-1">
            Jabatan
        </label>
        <select id="jabatan_id" name="jabatan_id"
                class="w-full px-2 py-1.5 border border-gray-300 rounded text-xs focus:ring-1 focus:ring-blue-500 focus:border-blue-500">
            <option value="">Pilih Jabatan</option>
            @foreach($positions as $pos)
                <option value="{{ $pos->id }}" {{ old('jabatan_id') == $pos->id ? 'selected' : '' }}>{{ $pos->nama_jabatan }}</option>
            @endforeach
        </select>
    </div>
</div>
                </div>

                <div>
                    <label for="alamat" class="block text-xs font-medium text-gray-700 mb-1">
                        Alamat Lengkap <span class="text-red-500">*</span>
                    </label>
                    <textarea id="alamat" 
                              name="alamat"
                              rows="2"
                              class="w-full px-2 py-1.5 border border-gray-300 rounded text-xs focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
                              placeholder="Alamat lengkap"
                              required></textarea>
                </div>

                <div class="flex justify-between items-center pt-2 border-t border-gray-200">
                    <a href="{{ route('employees.index') }}" 
                       class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-1.5 px-3 rounded text-xs transition duration-200 flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali
                    </a>
                    
                    <button type="submit" 
                            class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-1.5 px-4 rounded text-xs transition duration-200 flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


