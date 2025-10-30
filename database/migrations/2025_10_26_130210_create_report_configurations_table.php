<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void
{
    Schema::create('report_configurations', function (Blueprint $table) {
        $table->id();
        $table->string('report_name'); // Nama konfigurasi, misal "Absensi IT Bulanan"
        $table->string('report_type'); // Jenis laporan, misal 'attendance', 'employee_list'
        $table->json('filters')->nullable(); // Simpan filter (tanggal, dept, dll) dlm format JSON
        $table->json('columns')->nullable(); // Kolom yg ingin ditampilkan dlm format JSON
        $table->foreignId('user_id')->constrained(); // Dibuat oleh siapa
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_configurations');
    }
};
