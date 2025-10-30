@extends('employees.master') {{-- Sesuaikan dengan nama layout master Anda --}}
@section('title', 'Edit Department')
@section('page-title', 'Edit Department')

@section('content')
<div class="max-w-lg mx-auto px-4">
    <div class="bg-white shadow-md rounded-lg p-6">
        <form action="{{ route('departments.update', $department->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="nama_departemen" class="block text-sm font-medium text-gray-700 mb-1">Nama Department</label>
                <input type="text" id="nama_departemen" name="nama_departemen" value="{{ old('nama_departemen', $department->nama_departemen) }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('nama_departemen') border-red-500 @enderror"
                       required>
                @error('nama_departemen')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('departments.index') }}" class="text-gray-600 hover:text-gray-800 text-sm">Batal</a>
                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection