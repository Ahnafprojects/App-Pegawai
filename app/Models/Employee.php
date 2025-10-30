<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_lengkap',
        'email',
        'nomor_telepon',
        'tanggal_lahir',
        'alamat',
        'tanggal_masuk',
        'status',
        'departemen_id',
        'jabatan_id',
    ];
    public function department()
    {
        // Nama foreign key di tabel 'employees' adalah 'departemen_id'
        return $this->belongsTo(Department::class, 'departemen_id');
    }

    /**
     * Mendefinisikan relasi ke Position (Jabatan).
     */
    public function position()
    {
        // Nama foreign key di tabel 'employees' adalah 'jabatan_id'
        return $this->belongsTo(Position::class, 'jabatan_id');
    }
}