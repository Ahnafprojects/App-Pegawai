@extends('employees.master')
@section('title', 'Hasil Laporan Absensi')
@section('page-title', $config->report_name)

@section('content')
<div class="max-w-7xl mx-auto px-4">
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">{{ $config->report_name }}</h1>
            <p class="text-sm text-gray-500">
                Jenis Laporan: Absensi Karyawan 
                @if($config->filters['start_date'] ?? null)
                | Periode: {{ \Carbon\Carbon::parse($config->filters['start_date'])->format('d M Y') }} - {{ \Carbon\Carbon::parse($config->filters['end_date'])->format('d M Y') }}
                @endif
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
                        @if(in_array('department', $config->columns)) <th class="th-style">Departemen</th> @endif
                        @if(in_array('tanggal_absensi', $config->columns)) <th class="th-style text-center">Tanggal</th> @endif
                        @if(in_array('waktu_masuk', $config->columns)) <th class="th-style text-center">Masuk</th> @endif
                        @if(in_array('waktu_keluar', $config->columns)) <th class="th-style text-center">Keluar</th> @endif
                        @if(in_array('status_absensi', $config->columns)) <th class="th-style text-center">Status</th> @endif
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($data as $attendance)
                        <tr class="hover:bg-gray-50">
                            @if(in_array('nama_lengkap', $config->columns)) <td class="td-style">{{ $attendance->employee->nama_lengkap ?? 'N/A' }}</td> @endif
                            @if(in_array('department', $config->columns)) <td class="td-style">{{ $attendance->employee->department->nama_departemen ?? '-' }}</td> @endif
                            @if(in_array('tanggal_absensi', $config->columns)) <td class="td-style text-center">{{ $attendance->tanggal->format('d/m/Y') }}</td> @endif
                            @if(in_array('waktu_masuk', $config->columns)) <td class="td-style text-center">{{ $attendance->waktu_masuk ? \Carbon\Carbon::parse($attendance->waktu_masuk)->format('H:i') : '-' }}</td> @endif
                            @if(in_array('waktu_keluar', $config->columns)) <td class="td-style text-center">{{ $attendance->waktu_keluar ? \Carbon\Carbon::parse($attendance->waktu_keluar)->format('H:i') : '-' }}</td> @endif
                            @if(in_array('status_absensi', $config->columns)) 
                                <td class="td-style text-center">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        @switch($attendance->status_absensi)
                                            @case('hadir') bg-green-100 text-green-800 @break @case('izin') bg-blue-100 text-blue-800 @break
                                            @case('sakit') bg-yellow-100 text-yellow-800 @break @case('alpha') bg-red-100 text-red-800 @break
                                            @default bg-gray-100 text-gray-800
                                        @endswitch">
                                        {{ ucfirst($attendance->status_absensi) }}
                                    </span>
                                </td> 
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ count($config->columns) }}" class="px-6 py-12 text-center text-gray-500">
                                Tidak ada data absensi sesuai filter.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Helper CSS --}}
<style>
.th-style { padding: 0.75rem 1rem; text-align: left; font-size: 0.75rem; font-weight: 500; color: #6B7280; text-transform: uppercase; letter-spacing: 0.05em; }
.td-style { padding: 0.75rem 1rem; white-space: nowrap; font-size: 0.875rem; color: #374151; }
.th-style.text-center, .td-style.text-center { text-align: center; }
</style>
@endsection