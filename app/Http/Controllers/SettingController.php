<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Jika Anda menyimpan setting di DB, tambahkan model Setting
// use App\Models\Setting; 

class SettingController extends Controller
{
    public function index()
    {
        // Nanti ambil data setting yang sudah ada, misal:
        // $settings = Setting::pluck('value', 'key');
        return view('settings.index'); // compact('settings')
    }

    public function update(Request $request)
    {
        // Validasi input
        // Simpan setting baru ke database atau file config
        // Contoh:
        // foreach($request->except('_token') as $key => $value) {
        //     Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        // }

        return redirect()->route('settings.index')->with('success', 'Pengaturan berhasil disimpan!');
    }
}