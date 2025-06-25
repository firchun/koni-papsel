<?php

namespace App\Http\Controllers;

use App\Models\Pelatih;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PelatihController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Pengajuan Pelatih',
            'cabor' => Pelatih::distinct()->pluck('cabang_olahraga'),
        ];
        return view('admin.pelatih.index', $data);
    }
    public function store(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'id' => 'nullable|exists:pelatih,id',
            'nama_lengkap' => 'required|string',
            'nik_kk' => 'required|string',
            'nik_ktp' => 'required|string',
            'no_hp' => 'required|string',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string',
            'pendidikan_terakhir' => 'required|string',
            'cabang_olahraga' => 'required|string',

            // dokumen file opsional
            'ijazah' => 'nullable|file',
            'kartu_keluarga' => 'nullable|file',
            'ktp' => 'nullable|file',
            'akte_kelahiran' => 'nullable|file',
            'pas_photo' => 'nullable|file',
            'lisensi_pelatih' => 'nullable|file',
        ]);

        // Jika ada id, update
        if (!empty($validatedData['id'])) {
            $pelatih = Pelatih::find($validatedData['id']);
        } else {
            // Jika tidak ada, buat baru
            $pelatih = new Pelatih();
            $pelatih->is_verified = 0; // default
            $pelatih->status = 'pengajuan'; // default
        }

        // Assign data
        $pelatih->nama_lengkap = $validatedData['nama_lengkap'];
        $pelatih->nik_kk = $validatedData['nik_kk'];
        $pelatih->nik_ktp = $validatedData['nik_ktp'];
        $pelatih->no_hp = $validatedData['no_hp'];
        $pelatih->jenis_kelamin = $validatedData['jenis_kelamin'];
        $pelatih->tanggal_lahir = $validatedData['tanggal_lahir'];
        $pelatih->tempat_lahir = $validatedData['tempat_lahir'];
        $pelatih->pendidikan_terakhir = $validatedData['pendidikan_terakhir'];
        $pelatih->cabang_olahraga = $validatedData['cabang_olahraga'];

        // Simpan file jika ada
        $dokumenFields = ['ijazah', 'kartu_keluarga', 'ktp', 'akte_kelahiran', 'pas_photo', 'lisensi_pelatih'];

        foreach ($dokumenFields as $field) {
            if ($request->hasFile($field)) {
                $filePath = $request->file($field)->store("pelatih/$field", 'public');
                $pelatih->$field = $filePath;
            }
        }

        $pelatih->save();

        return response()->json([
            'success' => true,
            'message' => !empty($validatedData['id']) ? 'Data berhasil diperbarui.' : 'Data berhasil disimpan.',
            'data' => $pelatih
        ]);
    }
    public function getPelatihDataTable()
    {
        $Atlets = Pelatih::with(['cabor', 'nomor_pertandingan', 'kabupaten'])->orderByDesc('id');
        if (Auth::user()->role == 'Operator') {
            $Atlets->where('id_kabupaten', Auth::user()->id_kabupaten);
        }
        return DataTables::of($Atlets)
            ->addColumn('action', function ($Atlet) {
                return view('admin.pelatih.components.actions', compact('Atlet'));
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function destroy($id)
    {
        $Pelatih = Pelatih::find($id);

        if (!$Pelatih) {
            return response()->json(['message' => 'Pelatih not found'], 404);
        }

        $Pelatih->delete();

        return response()->json(['message' => 'Pelatih deleted successfully']);
    }
}
