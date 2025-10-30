<?php

namespace App\Http\Controllers;

use App\Models\ReportConfiguration;
use App\Models\Department; // Kita butuh ini untuk filter
use App\Models\Employee;   // Untuk menjalankan laporan employee
use App\Models\Attendance; // Untuk menjalankan laporan attendance
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportConfigurationController extends Controller
{
    // Menampilkan daftar konfigurasi laporan
    public function index()
    {
        $reportConfigurations = ReportConfiguration::where('user_id', auth()->id())->latest()->paginate(10);
        return view('reports.index', compact('reportConfigurations'));
    }

    // Menampilkan form buat konfigurasi baru
    public function create()
    {
        $departments = Department::orderBy('nama_departemen')->get();
        return view('reports.create', compact('departments'));
    }

    // Menyimpan konfigurasi baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'report_name' => 'required|string|max:255',
            'report_type' => 'required|in:attendance,employee_list',
            'filter_department_id' => 'nullable|exists:departments,id',
            'filter_start_date' => 'nullable|date',
            'filter_end_date' => 'nullable|date|after_or_equal:filter_start_date',
            'columns' => 'required|array', // Pastikan kolom dipilih
        ]);

        ReportConfiguration::create([
            'report_name' => $validated['report_name'],
            'report_type' => $validated['report_type'],
            'filters' => [
                'department_id' => $validated['filter_department_id'] ?? null,
                'start_date' => $validated['filter_start_date'] ?? null,
                'end_date' => $validated['filter_end_date'] ?? null,
            ],
            'columns' => $validated['columns'],
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('reports.index')->with('success', 'Konfigurasi laporan berhasil disimpan!');
    }

    // MENJALANKAN Laporan berdasarkan Konfigurasi ID
    public function show(ReportConfiguration $reportConfiguration)
    {
        $config = $reportConfiguration; // Alias
        $data = collect(); // Default data kosong
        $viewName = 'reports.show_default'; // View default jika tipe tidak dikenali

        // Logika untuk menjalankan laporan sesuai tipe
        if ($config->report_type == 'attendance') {
            $query = Attendance::with('employee')
                        ->whereBetween('tanggal', [
                            $config->filters['start_date'] ?? Carbon::now()->subYears(10)->toDateString(), // Default tanggal jauh
                            $config->filters['end_date'] ?? Carbon::now()->toDateString() // Default hari ini
                        ]);

            if (!empty($config->filters['department_id'])) {
                $query->whereHas('employee', function($q) use ($config) {
                    $q->where('departemen_id', $config->filters['department_id']);
                });
            }
            
            $data = $query->orderBy('tanggal', 'desc')->orderBy('waktu_masuk', 'asc')->get();
            $viewName = 'reports.show_attendance'; // View khusus laporan absensi
        
        } elseif ($config->report_type == 'employee_list') {
            $query = Employee::with(['department', 'position']);

             if (!empty($config->filters['department_id'])) {
                 $query->where('departemen_id', $config->filters['department_id']);
             }
            
            $data = $query->orderBy('nama_lengkap')->get();
            $viewName = 'reports.show_employee_list'; // View khusus daftar karyawan
        }

        // Tampilkan hasil laporan
        return view($viewName, compact('config', 'data'));
    }


    // Menampilkan form edit konfigurasi
    public function edit(ReportConfiguration $reportConfiguration)
    {
        $departments = Department::orderBy('nama_departemen')->get();
        return view('reports.edit', compact('reportConfiguration', 'departments'));
    }

    // Update konfigurasi
    public function update(Request $request, ReportConfiguration $reportConfiguration)
    {
         $validated = $request->validate([
            'report_name' => 'required|string|max:255',
            'report_type' => 'required|in:attendance,employee_list',
            'filter_department_id' => 'nullable|exists:departments,id',
            'filter_start_date' => 'nullable|date',
            'filter_end_date' => 'nullable|date|after_or_equal:filter_start_date',
            'columns' => 'required|array',
        ]);

        $reportConfiguration->update([
            'report_name' => $validated['report_name'],
            'report_type' => $validated['report_type'],
            'filters' => [
                'department_id' => $validated['filter_department_id'] ?? null,
                'start_date' => $validated['filter_start_date'] ?? null,
                'end_date' => $validated['filter_end_date'] ?? null,
            ],
            'columns' => $validated['columns'],
        ]);
        
        return redirect()->route('reports.index')->with('success', 'Konfigurasi laporan berhasil diperbarui!');
    }

    // Hapus konfigurasi
    public function destroy(ReportConfiguration $reportConfiguration)
    {
        $reportConfiguration->delete();
        return redirect()->route('reports.index')->with('success', 'Konfigurasi laporan berhasil dihapus!');
    }
}