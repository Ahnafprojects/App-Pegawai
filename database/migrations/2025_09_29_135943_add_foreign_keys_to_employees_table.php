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
        Schema::table('employees', function (Blueprint $table) {
            // Menambahkan kolom foreign key
            $table->unsignedBigInteger('departemen_id')->nullable()->after('tanggal_masuk');
            $table->unsignedBigInteger('jabatan_id')->nullable()->after('departemen_id');

            // Menambahkan foreign key constraints
            $table->foreign('departemen_id')
                ->references('id')
                ->on('departments')
                ->onDelete('set null');

            $table->foreign('jabatan_id')
                ->references('id')
                ->on('positions')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            // Menghapus foreign key constraints terlebih dahulu
            $table->dropForeign(['departemen_id']);
            $table->dropForeign(['jabatan_id']);
            
            // Menghapus kolom
            $table->dropColumn(['departemen_id', 'jabatan_id']);
        });
    }
};
