<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department; // <-- TAMBAHKAN
use App\Models\Position;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    // Tampilkan daftar semua pegawai dengan fitur pencarian dan pagination
    public function index(Request $request)
    {
        $search = $request->get('search');

        $employees = Employee::query()
            ->with(['department', 'position'])
            ->when($search, function ($query, $search) {
                // pencarian mtching
                $searchTerms = explode(' ', trim($search));

                return $query->where(function ($q) use ($searchTerms) {
                    foreach ($searchTerms as $term) {
                        $q->where(function ($subQuery) use ($term) {
                            $subQuery->where('nama_lengkap', 'ilike', "%{$term}%")
                                ->orWhere('email', 'ilike', "%{$term}%")
                                ->orWhere('nomor_telepon', 'ilike', "%{$term}%")
                                ->orWhere('alamat', 'ilike', "%{$term}%");
                        });
                    }
                });
            })
            ->latest()
            ->paginate(10)
            ->appends(request()->query());

        return view('employees.index', compact('employees'));
    }

    // Tampilkan form untuk membuat pegawai baru
    public function create()
    {
        $departments = Department::orderBy('nama_departemen')->get();
        $positions = Position::orderBy('nama_jabatan')->get();
        return view('employees.create', compact('departments', 'positions')); // <-- Kirim ke view
    }

    // Tampilkan detail pegawai berdasarkan ID
    public function show(string $id)
    {
        $employee = Employee::find($id);
        return view('employees.show', compact('employee'));
    }

    // Tampilkan form untuk edit pegawai berdasarkan ID
    public function edit(string $id)
    {
        $employee = Employee::find($id);
        $departments = Department::orderBy('nama_departemen')->get();
        $positions = Position::orderBy('nama_jabatan')->get();
        return view('employees.edit', compact('employee', 'departments', 'positions')); // <-- Kirim ke view
    }
    // Proses update data pegawai yang sudah di-edit
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'nomor_telepon' => 'required|string|max:20',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|max:255',
            'tanggal_masuk' => 'required|date',
            'status' => 'required|string|max:50',
            'departemen_id' => 'nullable|exists:departments,id', // <-- Tambah validasi
            'jabatan_id' => 'nullable|exists:positions,id',    // <-- Tambah validasi
        ]);

        $employee = Employee::findOrFail($id);

        // ↓↓↓ TAMBAHKAN departemen_id & jabatan_id di sini ↓↓↓
        $employee->update($request->only([
            'nama_lengkap',
            'email',
            'nomor_telepon',
            'tanggal_lahir',
            'alamat',
            'tanggal_masuk',
            'status',
            'departemen_id',
            'jabatan_id'
        ]));

        return redirect()->route('employees.index')->with('success', 'Data pegawai berhasil diperbarui!'); // <-- Tambah notif
    }
    // Hapus pegawai berdasarkan ID
    public function destroy(string $id)
    {
        $employee = Employee::find($id);
        $employee->delete();
        return redirect()->route('employees.index');
    }

    // Simpan pegawai baru ke database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'nomor_telepon' => 'required|string|max:20',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|max:255',
            'tanggal_masuk' => 'required|date',
            'status' => 'required|string|max:50',
            'departemen_id' => 'nullable|exists:departments,id', // <-- Tambah validasi
            'jabatan_id' => 'nullable|exists:positions,id',    // <-- Tambah validasi
        ]);

        // ↓↓↓ Ganti create(request->all()) menjadi ini agar lebih aman ↓↓↓
        Employee::create($validated); 

        return redirect()->route('employees.index')->with('success', 'Data pegawai berhasil disimpan!');
    }
}
