<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    // Nama tabel eksplisit jika berbeda dari 'attendances'
    protected $table = 'attendance'; 

    protected $fillable = [
        'karyawan_id',
        'tanggal',
        'waktu_masuk',
        'waktu_keluar',
        'status_absensi',
    ];

    protected $casts = [
        'tanggal' => 'date',
        // Jika Anda ingin waktu_masuk/keluar sebagai objek Carbon:
        // 'waktu_masuk' => 'datetime:H:i', 
        // 'waktu_keluar' => 'datetime:H:i',
    ];

    /**
     * Relasi ke Employee (Karyawan)
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'karyawan_id');
    }
}