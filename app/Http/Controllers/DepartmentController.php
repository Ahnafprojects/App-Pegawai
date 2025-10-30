<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::latest()->paginate(10);
        return view('departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('departments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_departemen' => 'required|string|max:100|unique:departments,nama_departemen',
        ]);

        Department::create($validated);

        return redirect()->route('departments.index')->with('success', 'Department berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        $validated = $request->validate([
            'nama_departemen' => 'required|string|max:100|unique:departments,nama_departemen,' . $department->id,
        ]);

        $department->update($validated);

        return redirect()->route('departments.index')->with('success', 'Department berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        // Opsional: Tambahkan logika untuk mengecek apakah ada employee
        // yang masih terhubung sebelum menghapus.

        $department->delete();
        return redirect()->route('departments.index')->with('success', 'Department berhasil dihapus!');
    }
}