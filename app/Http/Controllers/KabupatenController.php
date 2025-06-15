<?php

namespace App\Http\Controllers;

use App\Models\Atlet;
use App\Models\Kabupaten;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KabupatenController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Kabupaten',
        ];
        return view('admin.kabupaten.index', $data);
    }
    public function getKabupatenDataTable()
    {
        $Kabupatens = Kabupaten::orderByDesc('id');

        return Datatables::of($Kabupatens)
            ->addColumn('action', function ($Kabupaten) {
                return view('admin.kabupaten.components.actions', compact('Kabupaten'));
            })
            ->addColumn('operator', function ($Kabupaten) {
                return User::where('id_kabupaten', $Kabupaten->id)
                    ->where('role', 'Operator')
                    ->count();
            })
            ->addColumn('atlet', function ($Kabupaten) {
                $ditolak = Atlet::where('id_kabupaten', $Kabupaten->id)
                    ->where('status', 'Ditolak')
                    ->count();
                $menunggu = Atlet::where('id_kabupaten', $Kabupaten->id)
                    ->where('status', ['Menunggu', 'Revisi'])
                    ->count();
                $disetujui = Atlet::where('id_kabupaten', $Kabupaten->id)
                    ->where('status', 'Distujui')
                    ->count();
                return '<span class="badge bg-label-warning mx-1">' . $menunggu . '</span><span class="badge bg-label-success mx-1">' . $disetujui . '</span><span class="badge bg-label-danger">' . $ditolak . '</span>';
            })
            ->addColumn('pelatih', function ($Kabupaten) {
                return '0';
            })
            ->rawColumns(['action', 'pelatih', 'atlet', 'operator'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kabupaten' => 'required|string|max:255',
        ]);

        $KabupatenData = [
            'kabupaten' => $request->input('kabupaten'),
        ];

        if ($request->filled('id')) {
            $Kabupaten = Kabupaten::find($request->input('id'));
            if (!$Kabupaten) {
                return response()->json(['message' => 'Kabupaten not found'], 404);
            }

            $Kabupaten->update($KabupatenData);
            $message = 'Kabupaten updated successfully';
        } else {
            Kabupaten::create($KabupatenData);
            $message = 'Kabupaten created successfully';
        }

        return response()->json(['message' => $message]);
    }
    public function destroy($id)
    {
        $Kabupatens = Kabupaten::find($id);

        if (!$Kabupatens) {
            return response()->json(['message' => 'Kabupaten not found'], 404);
        }

        $Kabupatens->delete();

        return response()->json(['message' => 'Kabupaten deleted successfully']);
    }
    public function edit($id)
    {
        $Kabupaten = Kabupaten::find($id);

        if (!$Kabupaten) {
            return response()->json(['message' => 'Kabupaten not found'], 404);
        }

        return response()->json($Kabupaten);
    }
}