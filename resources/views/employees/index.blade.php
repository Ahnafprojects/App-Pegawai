@extends('employees.master')
@section('title', 'Daftar Pegawai')
@section('content')
    <div class="max-w-7xl mx-auto px-4">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Daftar Pegawai</h1>

        <!-- Search Form -->
        <div class="mb-6">
            <form action="{{ route('employees.index') }}" method="GET" class="flex gap-4 items-end">
                <div class="flex-1">
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Pencarian</label>
                    <input type="text" id="search" name="search" value="{{ request('search') }}"
                        placeholder="Cari sebagian nama, email, telepon, atau alamat..."
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300">
                        Cari
                    </button>
                      <a href="{{ route('employees.create') }}"
            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition duration-300">
            Tambah Pegawai  
        </a>

                </div>
                @if (request('search'))
                    <div>
                        <a href="{{ route('employees.index') }}"
                            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded transition duration-300 inline-block text-center">
                            Reset
                        </a>
                    </div>
                @endif
            </form>
        </div>

      
    </div>

    <!-- Search Results Info -->
    @if (request('search'))
        <div class="mb-4 p-3 bg-blue-50 border border-blue-200 rounded-lg">
            <p class="text-blue-800">
                <strong>Hasil pencarian untuk:</strong> "{{ request('search') }}"
                <span class="text-blue-600">({{ $employees->total() }} pegawai ditemukan)</span>
            </p>
        </div>
    @endif

    <div class="shadow-lg rounded-lg bg-white overflow-hidden">
        <table class="w-full table-fixed border-collapse">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-gray-700 uppercase border-b"
                        style="width: 18%;">Nama Lengkap</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-gray-700 uppercase border-b"
                        style="width: 16%;">Email</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-gray-700 uppercase border-b"
                        style="width: 12%;">Telepon</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-gray-700 uppercase border-b"
                        style="width: 10%;">Tgl Lahir</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-gray-700 uppercase border-b"
                        style="width: 20%;">Alamat</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-gray-700 uppercase border-b"
                        style="width: 10%;">Tgl Masuk</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-gray-700 uppercase border-b"
                    style="width: 10%;">Department</th> {{-- TAMBAH --}}
                <th class="px-4 py-3 text-center text-xs font-semibold text-gray-700 uppercase border-b"
                    style="width: 10%;">Jabatan</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-gray-700 uppercase border-b"
                        style="width: 8%;">Status</th>
                    <th class="px-4 py-3 text-center text-xs font-semibold text-gray-700 uppercase border-b"
                        style="width: 10%;">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($employees as $employee)
                    <tr class="hover:bg-gray-50 transition duration-200 border-b border-gray-100">
                        <td class="px-4 py-3 text-sm text-gray-900 text-center">
                            <div class="font-medium">{{ $employee->nama_lengkap }}</div>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-900 text-center">
                            <div class="truncate" title="{{ $employee->email }}">{{ $employee->email }}</div>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-900 text-center">
                            {{ $employee->nomor_telepon }}
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-900 text-center">
                            {{ \Carbon\Carbon::parse($employee->tanggal_lahir)->format('d/m/Y') }}
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-900 text-center">
                            <div class="truncate" title="{{ $employee->alamat }}">
                                {{ $employee->alamat }}
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-900 text-center">
                            {{ \Carbon\Carbon::parse($employee->tanggal_masuk)->format('d/m/Y') }}
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-900 text-center">
                        {{-- Gunakan null-safe operator (?->) jika department bisa kosong --}}
                        {{ $employee->department?->nama_departemen ?? '-' }} 
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-900 text-center">
                        {{ $employee->position?->nama_jabatan ?? '-' }}
                    </td>
                        <td class="px-4 py-3 text-center">
                            <span
                                class="px-3 py-1 text-xs font-semibold rounded-full 
                                {{ $employee->status == 'aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ ucfirst($employee->status) }}
                            </span>
                        </td>
                        <td class="px-2 py-3 text-center">
                            <div class="flex justify-center space-x-2">
                                <a href="{{ route('employees.show', $employee->id) }}"
                                    class="p-1.5 rounded-full border border-gray-300 text-gray-600 hover:border-blue-500 hover:text-blue-600 transition duration-200"
                                    title="Detail">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                        </path>
                                    </svg>
                                </a>
                                <a href="{{ route('employees.edit', $employee->id) }}"
                                    class="p-1.5 rounded-full border border-gray-300 text-gray-600 hover:border-amber-500 hover:text-amber-600 transition duration-200"
                                    title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                </a>
                                <form action="{{ route('employees.destroy', $employee->id) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('Yakin ingin menghapus pegawai {{ $employee->nama_lengkap }}?')"
                                        class="p-1.5 rounded-full border border-gray-300 text-gray-600 hover:border-red-500 hover:text-red-600 transition duration-200"
                                        title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v
                                                6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="px-6 py-12 text-center text-gray-500 bg-gray-50">
                            <div class="flex flex-col items-center space-y-3">
                                <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </div>
                                <div class="text-lg font-medium text-gray-700">Belum ada data pegawai</div>
                                <div class="text-sm text-gray-500">Silakan klik tombol "Tambah Pegawai" untuk menambah data
                                    baru</div>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>


    <div class="flex justify-center mt-6">
        <nav class="flex space-x-1">
            @if ($employees->onFirstPage())
                <span
                    class="px-3 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-300 rounded-l-lg cursor-not-allowed">
                    Previous
                </span>
            @else
                <a href="{{ $employees->previousPageUrl() }}"
                    class="px-3 py-2 text-sm font-medium text-blue-600 bg-white border border-gray-300 rounded-l-lg hover:bg-blue-50 transition duration-200">
                    Previous
                </a>
            @endif

            @foreach ($employees->getUrlRange(1, $employees->lastPage()) as $page => $url)
                @if ($page == $employees->currentPage())
                    <span class="px-3 py-2 text-sm font-medium text-white bg-blue-500 border border-blue-500">
                        {{ $page }}
                    </span>
                @else
                    <a href="{{ $url }}"
                        class="px-3 py-2 text-sm font-medium text-blue-600 bg-white border border-gray-300 hover:bg-blue-50 transition duration-200">
                        {{ $page }}
                    </a>
                @endif
            @endforeach

            @if ($employees->hasMorePages())
                <a href="{{ $employees->nextPageUrl() }}"
                    class="px-3 py-2 text-sm font-medium text-blue-600 bg-white border border-gray-300 rounded-r-lg hover:bg-blue-50 transition duration-200">
                    Next
                </a>
            @else
                <span
                    class="px-3 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-300 rounded-r-lg cursor-not-allowed">
                    Next
                </span>
            @endif
        </nav>
    </div>

    <!-- Info pagination -->
    <div class="mt-4 text-center">
        <small class="text-gray-500">
            Menampilkan {{ $employees->firstItem() ?? 0 }} sampai {{ $employees->lastItem() ?? 0 }} dari
            {{ $employees->total() }} pegawai
        </small>
    </div>
    </div>
@endsection
