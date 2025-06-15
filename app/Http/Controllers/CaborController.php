<?php

namespace App\Http\Controllers;

use App\Models\Atlet;
use App\Models\Cabor;
use App\Models\NomorPertandinganCabor;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CaborController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Cabang Olahraga',
        ];
        return view('admin.cabor.index', $data);
    }
    public function getCaborDataTable()
    {
        $Cabors = Cabor::orderByDesc('id');

        return DataTables::of($Cabors)
            ->addColumn('action', function ($Cabor) {
                return view('admin.cabor.components.actions', compact('Cabor'));
            })
            ->addColumn('atlet', function ($cabor) {
                $ditolak = Atlet::where('id_cabor', $cabor->id)
                    ->where('status', 'Ditolak')
                    ->count();
                $menunggu = Atlet::where('id_cabor', $cabor->id)
                    ->where('status', ['Menunggu', 'Revisi'])
                    ->count();
                $disetujui = Atlet::where('id_cabor', $cabor->id)
                    ->where('status', 'Distujui')
                    ->count();
                return '<span class="badge bg-label-warning mx-1">' . $menunggu . '</span><span class="badge bg-label-success mx-1">' . $disetujui . '</span><span class="badge bg-label-danger">' . $ditolak . '</span>';
            })
            ->addColumn('pelatih', function ($Cabor) {
                return '0';
            })
            ->rawColumns(['action', 'pelatih', 'atlet'])
            ->make(true);
    }
    public function storeNomor(Request $request)
    {
        $data = $request->validate([
            'id_cabor' => 'required|exists:cabor,id',
            'nomor' => 'required|array',
            'nomor.*.utama' => 'required|string|max:255',
            'nomor.*.sub' => 'nullable|array',
            'nomor.*.sub.*' => 'nullable|string|max:255',
        ]);

        NomorPertandinganCabor::where('id_cabor', $data['id_cabor'])->delete();

        // Simpan ulang data yang baru
        foreach ($data['nomor'] as $item) {
            NomorPertandinganCabor::create([
                'id_cabor' => $data['id_cabor'],
                'nomor_pertandingan' => $item['utama'],
                'sub_nomor_pertandingan' => collect($item['sub'] ?? [])
                    ->filter(fn($val) => $val !== null && $val !== '')
                    ->values()
                    ->toArray(),
            ]);
        }

        return back()->with('success', 'Nomor pertandingan berhasil disimpan.');
    }
    public function editNomor($idCabor)
    {
        $nomorList = NomorPertandinganCabor::where('id_cabor', $idCabor)->get();

        return response()->json($nomorList); // untuk dipakai JS
    }
    public function store(Request $request)
    {
        $request->validate([
            'cabor' => 'required|string|max:255',
        ]);

        $CaborData = [
            'cabor' => $request->input('cabor'),
        ];

        if ($request->filled('id')) {
            $Cabor = Cabor::find($request->input('id'));
            if (!$Cabor) {
                return response()->json(['message' => 'Cabor not found'], 404);
            }

            $Cabor->update($CaborData);
            $message = 'Cabor updated successfully';
        } else {
            Cabor::create($CaborData);
            $message = 'Cabor created successfully';
        }

        return response()->json(['message' => $message]);
    }
    public function destroy($id)
    {
        $Cabors = Cabor::find($id);

        if (!$Cabors) {
            return response()->json(['message' => 'Cabor not found'], 404);
        }

        $Cabors->delete();

        return response()->json(['message' => 'Cabor deleted successfully']);
    }
    public function edit($id)
    {
        $Cabor = Cabor::find($id);

        if (!$Cabor) {
            return response()->json(['message' => 'Cabor not found'], 404);
        }

        return response()->json($Cabor);
    }
}