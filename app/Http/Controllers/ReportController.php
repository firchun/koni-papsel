<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function atlet()
    {
        $data = [
            'title' => 'Laporan Atlet',
        ];
        return view('admin.report.atlet', $data);
    }
    public function pelatih()
    {
        $data = [
            'title' => 'Laporan Pelatih',
        ];
        return view('admin.report.pelatih', $data);
    }
}