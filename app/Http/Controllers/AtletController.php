<?php

namespace App\Http\Controllers;

use App\Models\Atlet;
use App\Models\Cabor;
use App\Models\Kabupaten;
use App\Models\Notifikasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class AtletController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Pengajuan Atlet',
            'cabor' => Cabor::all(),
        ];
        return view('admin.atlet.index', $data);
    }
    public function detail($id)
    {
        $data = [
            'title' => 'Detail Pengajuan',
            'atlet' => Atlet::find($id),
        ];
        return view('admin.atlet.detail', $data);
    }
    public function getAtletDataTable()
    {
        $Atlets = Atlet::with(['cabor', 'nomor_pertandingan', 'kabupaten'])->orderByDesc('id');
        if (Auth::user()->role == 'Operator') {
            $Atlets->where('id_kabupaten', Auth::user()->id_kabupaten);
        }
        return DataTables::of($Atlets)
            ->addColumn('action', function ($Atlet) {
                return view('admin.atlet.components.actions', compact('Atlet'));
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kabupaten' => 'required|exists:kabupaten,id',
            'id_cabor' => 'required|exists:cabor,id',
            'id_nomor_pertandingan_cabor' => 'required|exists:nomor_pertandingan_cabor,id',
            'sub_nomor_pertandingan' => 'required|string|max:255',
            'nama_lengkap' => 'required|string|max:255',
            'nik_kk' => 'required|string|max:255',
            'nik_ktp' => 'nullable|string|max:255',
            'no_hp' => 'nullable|string|max:20',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string|max:255',
            'pendidikan_terakhir' => 'nullable|string|max:255',
            'tinggi_badan' => 'nullable|integer',
            'berat_badan' => 'nullable|integer',

            // Validasi file upload
            'fc_ijazah' => 'nullable|file|mimes:jpg,jpeg,png|max:3072',
            'fc_ktp' => 'nullable|file|mimes:jpg,jpeg,png|max:3072',
            'fc_kk' => 'nullable|file|mimes:jpg,jpeg,png|max:3072',
            'akta' => 'nullable|file|mimes:jpg,jpeg,png|max:3072',
            'pas_foto' => 'nullable|file|mimes:jpg,jpeg,png|max:3072',
        ]);

        $data = $request->only([
            'id_kabupaten',
            'id_cabor',
            'id_nomor_pertandingan_cabor',
            'sub_nomor_pertandingan',
            'nama_lengkap',
            'nik_kk',
            'nik_ktp',
            'no_hp',
            'jenis_kelamin',
            'tanggal_lahir',
            'tempat_lahir',
            'pendidikan_terakhir',
            'tinggi_badan',
            'berat_badan',
        ]);

        // Upload file jika ada
        foreach (['fc_ijazah', 'fc_ktp', 'fc_kk', 'akta', 'pas_foto'] as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = $field . '_' . time() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('uploads/atlet', $filename, 'public');
                $data[$field] = $path;
            }
        }

        if ($request->filled('id')) {
            $atlet = Atlet::find($request->input('id'));
            if (!$atlet) {
                return response()->json(['message' => 'Atlet not found'], 404);
            }

            $atlet->update($data);
            $message = 'Atlet updated successfully';
        } else {
            Atlet::create($data);
            $kabupaten = Kabupaten::find($request->input('id_kabupaten'));
            $cabor = Cabor::find($request->input('id_cabor'));
            foreach (User::where('role', 'Admin')->get() as $admin) {
                Notifikasi::create([
                    'id_user' => $admin->id,
                    'isi' => 'Atlet baru dari kabupaten ' . $kabupaten->kabupaten . ', cabor ' . $cabor->cabor . '  telah diajukan untuk verifikasi.',
                ]);
            }
            $message = 'Atlet Berhasil diajukan';
        }

        return response()->json(['message' => $message]);
    }
    public function destroy($id)
    {
        $Atlets = Atlet::find($id);

        if (!$Atlets) {
            return response()->json(['message' => 'Atlet not found'], 404);
        }

        $Atlets->delete();

        return response()->json(['message' => 'Atlet deleted successfully']);
    }
}