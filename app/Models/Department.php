<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // Tambahkan jika belum ada

class Department extends Model
{
    use HasFactory; // Tambahkan jika belum ada

    // ↓↓↓ TAMBAHKAN BARIS INI ↓↓↓
    protected $guarded = ['id']; 

    // Relasi (opsional tapi bagus ditambahkan)
    public function employees()
    {
        return $this->hasMany(Employee::class, 'departemen_id');
    }
}