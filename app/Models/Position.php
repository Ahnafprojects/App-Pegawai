<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Position extends Model
{
    use HasFactory; // <-- Pastikan ini ada

    // ↓↓↓ TAMBAHKAN BARIS INI ↓↓↓
    protected $guarded = ['id'];
    public function employees()
{
    return $this->hasMany(Employee::class, 'jabatan_id');
}
}
