@extends('employees.master') {{-- Sesuaikan layout master --}}
@section('title', 'Daftar Jabatan')
@section('page-title', 'Manajemen Jabatan')

@section('content')
<div class="max-w-6xl mx-auto px-4">
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Jabatan</h1>
        <a href="{{ route('positions.create') }}"
           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300">
           + Tambah Jabatan Baru
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
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Jabatan</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Gaji Pokok (Rp)</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($positions as $position)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $position->nama_jabatan }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 text-right">
                            {{ number_format($position->gaji_pokok, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center font-medium">
                            <a href="{{ route('positions.edit', $position->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                            <form action="{{ route('positions.destroy', $position->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus jabatan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-12 text-center text-gray-500">
                            Belum ada data jabatan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $positions->links() }}
    </div>
</div>
@endsection