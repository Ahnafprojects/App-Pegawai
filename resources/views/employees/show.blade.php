@extends('employees.master')
@section('title', 'Detail Pegawai')
@section('page-title', 'Detail Data Pegawai') {{-- Menambahkan Page Title --}}

@section('content')
    <div class="max-w-4xl mx-auto px-4 py-6">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-2">Detail Pegawai</h1>
            <p class="text-gray-600">Informasi lengkap data pegawai.</p>
        </div>

        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            {{-- Header Card --}}
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white bg-opacity-20 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-white">{{ $employee->nama_lengkap }}</h2>
                        <p class="text-blue-100 text-sm">{{ $employee->email }}</p>
                    </div>
                </div>
            </div>

            {{-- Body Card --}}
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4"> {{-- Sesuaikan gap --}}

                    {{-- Nama Lengkap --}}
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mt-1 flex-shrink-0">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Nama Lengkap</label>
                            <p class="text-gray-900 font-medium">{{ $employee->nama_lengkap }}</p>
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="flex items-start space-x-3">
                         <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mt-1 flex-shrink-0">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Email</label>
                            <p class="text-gray-900 font-medium break-words">{{ $employee->email }}</p> {{-- Tambah break-words --}}
                        </div>
                    </div>

                    {{-- Nomor Telepon --}}
                    <div class="flex items-start space-x-3">
                         <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center mt-1 flex-shrink-0">
                             <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                         </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Nomor Telepon</label>
                            <p class="text-gray-900 font-medium">{{ $employee->nomor_telepon }}</p>
                        </div>
                    </div>

                    {{-- Tanggal Lahir --}}
                    <div class="flex items-start space-x-3">
                         <div class="w-8 h-8 bg-pink-100 rounded-full flex items-center justify-center mt-1 flex-shrink-0">
                            <svg class="w-4 h-4 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Tanggal Lahir</label>
                            <p class="text-gray-900 font-medium">{{ \Carbon\Carbon::parse($employee->tanggal_lahir)->isoFormat('D MMMM Y') }}</p> {{-- Format Indonesia --}}
                        </div>
                    </div>

                     {{-- Tanggal Masuk --}}
                    <div class="flex items-start space-x-3">
                         <div class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center mt-1 flex-shrink-0">
                            <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Tanggal Masuk</label>
                            <p class="text-gray-900 font-medium">{{ \Carbon\Carbon::parse($employee->tanggal_masuk)->isoFormat('D MMMM Y') }}</p> {{-- Format Indonesia --}}
                        </div>
                    </div>

                     {{-- Status --}}
                    <div class="flex items-start space-x-3">
                         <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center mt-1 flex-shrink-0">
                            <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Status</label>
                            <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full {{ $employee->status == 'aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ ucfirst($employee->status) }}
                            </span>
                        </div>
                    </div>

                    {{-- Department --}}
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-teal-100 rounded-full flex items-center justify-center mt-1 flex-shrink-0">
                            <svg class="w-4 h-4 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Department</label>
                            <p class="text-gray-900 font-medium">{{ $employee->department?->nama_departemen ?? 'Belum Ditentukan' }}</p>
                        </div>
                    </div>

                    {{-- Jabatan --}}
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-cyan-100 rounded-full flex items-center justify-center mt-1 flex-shrink-0">
                             <svg class="w-4 h-4 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-1.232 3.938m-3.376-3.938A8.961 8.961 0 0112 21a8.961 8.961 0 01-4.768-1.206M12 9V3m0 0l-2 2m2-2l2 2"></path></svg>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Jabatan</label>
                            <p class="text-gray-900 font-medium">{{ $employee->position?->nama_jabatan ?? 'Belum Ditentukan' }}</p>
                        </div>
                    </div>

                    {{-- Gaji Pokok --}}
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-lime-100 rounded-full flex items-center justify-center mt-1 flex-shrink-0">
                           <svg class="w-4 h-4 text-lime-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Gaji Pokok</label>
                            <p class="text-gray-900 font-medium">Rp {{ number_format($employee->position?->gaji_pokok ?? 0, 0, ',', '.') }}</p>
                        </div>
                    </div>

                    {{-- Alamat --}}
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center mt-1 flex-shrink-0">
                            <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Alamat Lengkap</label>
                            <p class="text-gray-900 font-medium">{{ $employee->alamat }}</p>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Footer Card --}}
            <div class="bg-gray-50 px-6 py-4 border-t"> {{-- Tambah border-t --}}
                <div class="flex justify-between items-center">
                    <a href="{{ route('employees.index') }}"
                       class="inline-flex items-center px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white text-sm font-medium rounded-md
                              transition duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Kembali ke Daftar
                    </a>
                    <div class="text-sm text-gray-500">
                        <span class="font-medium">ID Pegawai:</span> {{ $employee->id }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection