@extends('employees.master')
@section('title', 'Laporan Tersimpan')
@section('page-title', 'Manajemen Laporan')

@section('content')
<div class="max-w-7xl mx-auto px-4">
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Konfigurasi Laporan</h1>
        <a href="{{ route('reports.create') }}"
           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300">
           + Buat Konfigurasi Baru
        </a>
    </div>

    @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 border border-green-200 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="w-full table-auto">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Laporan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Laporan</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($reportConfigurations as $config)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $config->report_name }}
                        </td>
                         <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ ucfirst(str_replace('_', ' ', $config->report_type)) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center font-medium space-x-2">
                            <a href="{{ route('reports.show', $config->id) }}" class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800 hover:bg-green-200" title="Jalankan Laporan">
                                <i class="bi bi-play-fill"></i> Jalankan
                            </a>
                            <a href="{{ route('reports.edit', $config->id) }}" class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800 hover:bg-yellow-200" title="Edit Konfigurasi">
                                <i class="bi bi-pencil-fill"></i> Edit
                            </a>
                            <form action="{{ route('reports.destroy', $config->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus konfigurasi laporan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800 hover:bg-red-200" title="Hapus Konfigurasi">
                                    <i class="bi bi-trash-fill"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-12 text-center text-gray-500">
                            Belum ada konfigurasi laporan yang disimpan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $reportConfigurations->links() }} {{-- Pagination Links --}}
    </div>
</div>
@endsection