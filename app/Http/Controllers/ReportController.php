<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        // Nanti bisa ditambahkan logika untuk mengambil jenis laporan
        return view('report.index');
    }
}
