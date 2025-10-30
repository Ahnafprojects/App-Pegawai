@extends('employees.master')
@section('title', 'Daftar Absensi')
@section('page-title', 'Manajemen Absensi')

@section('content')
<div class="max-w-7xl mx-auto px-4">
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Absensi Pegawai</h1>
        <a href="{{ route('attendances.create') }}"
           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300">
           + Tambah Absensi Manual
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="w-full table-auto">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pegawai</th>
                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Masuk</th>
                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Keluar</th>
                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($attendances as $attendance)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $attendance->employee->nama_lengkap ?? 'N/A' }}
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500 text-center">
                            {{ $attendance->tanggal->format('d/m/Y') }}
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500 text-center">
                            {{ $attendance->waktu_masuk ? \Carbon\Carbon::parse($attendance->waktu_masuk)->format('H:i') : '-' }}
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-500 text-center">
                            {{ $attendance->waktu_keluar ? \Carbon\Carbon::parse($attendance->waktu_keluar)->format('H:i') : '-' }}
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-center">
                           <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                @switch($attendance->status_absensi)
                                    @case('hadir') bg-green-100 text-green-800 @break
                                    @case('izin') bg-blue-100 text-blue-800 @break
                                    @case('sakit') bg-yellow-100 text-yellow-800 @break
                                    @case('alpha') bg-red-100 text-red-800 @break
                                    @default bg-gray-100 text-gray-800
                                @endswitch">
                                {{ ucfirst($attendance->status_absensi) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap text-sm text-center font-medium">
                            <a href="{{ route('attendances.edit', $attendance->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                            <form action="{{ route('attendances.destroy', $attendance->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus data absensi ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                            Belum ada data absensi.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $attendances->links() }}
    </div>
</div>
@endsection