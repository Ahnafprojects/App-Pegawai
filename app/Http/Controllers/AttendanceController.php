<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::with('employee') // Eager load employee data
                                 ->latest('tanggal') // Urutkan terbaru dulu
                                 ->paginate(15);
        return view('attendances.index', compact('attendances'));
    }

    public function create()
    {
        $employees = Employee::where('status', 'aktif')->orderBy('nama_lengkap')->get(); // Ambil pegawai aktif
        return view('attendances.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'tanggal' => 'required|date',
            'waktu_masuk' => 'nullable|date_format:H:i',
            'waktu_keluar' => 'nullable|date_format:H:i|after_or_equal:waktu_masuk',
            'status_absensi' => 'required|in:hadir,izin,sakit,alpha',
        ]);

        Attendance::create($validated);

        return redirect()->route('attendances.index')->with('success', 'Data absensi berhasil disimpan!');
    }

    public function edit(Attendance $attendance)
    {
        $employees = Employee::where('status', 'aktif')->orderBy('nama_lengkap')->get();
        return view('attendances.edit', compact('attendance', 'employees'));
    }

    public function update(Request $request, Attendance $attendance)
    {
        $validated = $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'tanggal' => 'required|date',
            'waktu_masuk' => 'nullable|date_format:H:i',
            'waktu_keluar' => 'nullable|date_format:H:i|after_or_equal:waktu_masuk',
            'status_absensi' => 'required|in:hadir,izin,sakit,alpha',
        ]);

        $attendance->update($validated);

        return redirect()->route('attendances.index')->with('success', 'Data absensi berhasil diperbarui!');
    }

    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return redirect()->route('attendances.index')->with('success', 'Data absensi berhasil dihapus!');
    }
}