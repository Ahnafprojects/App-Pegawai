@extends('employees.master')
@section('title', 'Hasil Laporan Daftar Karyawan')
@section('page-title', $config->report_name)

@section('content')
<div class="max-w-7xl mx-auto px-4">
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">{{ $config->report_name }}</h1>
            <p class="text-sm text-gray-500">
                Jenis Laporan: Daftar Karyawan
                 @if($config->filters['department_id'] ?? null)
                 | Dept: {{ \App\Models\Department::find($config->filters['department_id'])->nama_departemen ?? 'N/A' }}
                @endif
            </p>
        </div>
         <a href="{{ route('reports.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">← Kembali ke Daftar Laporan</a>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        {{-- Header Tabel Dinamis Sesuai Konfigurasi --}}
                        @if(in_array('nama_lengkap', $config->columns)) <th class="th-style">Nama Pegawai</th> @endif
                        @if(in_array('email', $config->columns)) <th class="th-style">Email</th> @endif
                        @if(in_array('department', $config->columns)) <th class="th-style">Departemen</th> @endif
                        {{-- Tambahkan header lain jika ada di $config->columns --}}
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($data as $employee)
                        <tr class="hover:bg-gray-50">
                            @if(in_array('nama_lengkap', $config->columns)) <td class="td-style">{{ $employee->nama_lengkap }}</td> @endif
                            @if(in_array('email', $config->columns)) <td class="td-style">{{ $employee->email }}</td> @endif
                            @if(in_array('department', $config->columns)) <td class="td-style">{{ $employee->department?->nama_departemen ?? '-' }}</td> @endif
                             {{-- Tambahkan data lain jika ada di $config->columns --}}
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ count($config->columns) }}" class="px-6 py-12 text-center text-gray-500">
                                Tidak ada data karyawan sesuai filter.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
{{-- Helper CSS --}}
<style> .th-style { padding: 0.75rem 1rem; text-align: left; font-size: 0.75rem; font-weight: 500; color: #6B7280; text-transform: uppercase; letter-spacing: 0.05em; } .td-style { padding: 0.75rem 1rem; white-space: nowrap; font-size: 0.875rem; color: #374151; } </style>
@endsection