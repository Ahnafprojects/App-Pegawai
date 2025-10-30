@extends('employees.master') {{-- Sesuaikan dengan nama layout master Anda --}}
@section('title', 'Daftar Department')
@section('page-title', 'Manajemen Department')

@section('content')
<div class="max-w-4xl mx-auto px-4">
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Department</h1>
        <a href="{{ route('departments.create') }}"
           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300">
           + Tambah Department Baru
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="w-full table-auto">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Department</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($departments as $department)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $department->nama_departemen }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center font-medium">
                            <a href="{{ route('departments.edit', $department->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                            <form action="{{ route('departments.destroy', $department->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus department ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="px-6 py-12 text-center text-gray-500">
                            Belum ada data department.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $departments->links() }} {{-- Pagination Links --}}
    </div>
</div>
@endsection