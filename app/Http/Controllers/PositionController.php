<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index()
    {
        $positions = Position::latest()->paginate(10);
        return view('positions.index', compact('positions'));
    }

    public function create()
    {
        return view('positions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_jabatan' => 'required|string|max:100|unique:positions,nama_jabatan',
            'gaji_pokok' => 'required|numeric|min:0',
        ]);

        Position::create($validated);

        return redirect()->route('positions.index')->with('success', 'Jabatan berhasil ditambahkan!');
    }

    public function edit(Position $position)
    {
        return view('positions.edit', compact('position'));
    }

    public function update(Request $request, Position $position)
    {
        $validated = $request->validate([
            'nama_jabatan' => 'required|string|max:100|unique:positions,nama_jabatan,' . $position->id,
            'gaji_pokok' => 'required|numeric|min:0',
        ]);

        $position->update($validated);

        return redirect()->route('positions.index')->with('success', 'Jabatan berhasil diperbarui!');
    }

    public function destroy(Position $position)
    {
        // Opsional: Tambahkan cek jika ada employee yang masih memakai jabatan ini
        $position->delete();
        return redirect()->route('positions.index')->with('success', 'Jabatan berhasil dihapus!');
    }
}