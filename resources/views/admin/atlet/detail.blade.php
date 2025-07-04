@extends('layouts.backend.admin')

@section('content')
    @include('layouts.backend.alert')
    <div class="row justify-content-center ">
        <div class="col-12">
            <div class="mb-3">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('atlet') }}" class="btn btn-secondary">
                        <i class="bx bx-arrow-back"></i> Kembali
                    </a>
                    <span
                        class=" py-3 badge bg-{{ $atlet->status == 'Distujui' ? 'success' : ($atlet->status == 'Ditolak' ? 'danger' : 'warning') }}">
                        <small>Status Pengajuan :</small> <strong>{{ $atlet->status }}</strong>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-8 mb-3">
            <div class="card">
                <div class="card-body">
                    <strong class="text-primary">Cabang Olahraga</strong>
                    <hr>
                    <table class="table table-borderless table-hover table-sm">
                        <tr>
                            <td>Cabang Olehraga</td>
                            <td>:</td>
                            <td><b>{{ $atlet->cabor->cabor }}</b></td>
                        </tr>
                        <tr>
                            <td>Kategory</td>
                            <td>:</td>
                            <td><b>{{ $atlet->nomor_pertandingan->nomor_pertandingan }}</b></td>
                        </tr>
                        <tr>
                            <td>Sub-Kategory</td>
                            <td>:</td>
                            <td><b>{{ $atlet->sub_nomor_pertandingan }}</b></td>
                        </tr>
                    </table>
                    <hr>
                    <strong class="text-primary mt-3">Data Diri</strong>
                    <hr>
                    <table class="table table-borderless table-hover table-sm">
                        <tr>
                            <td>Nama Lengkap</td>
                            <td>:</td>
                            <td><b>{{ $atlet->nama_lengkap }}</b></td>
                        </tr>
                        <tr>
                            <td>NIK KK</td>
                            <td>:</td>
                            <td><b>{{ $atlet->nik_kk }}</b></td>
                        </tr>
                        <tr>
                            <td>NIK KTP</td>
                            <td>:</td>
                            <td><b>{{ $atlet->nik_ktp }}</b></td>
                        </tr>
                        <tr>
                            <td>No HP</td>
                            <td>:</td>
                            <td><b>{{ $atlet->no_hp }}</b></td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>:</td>
                            <td><b>{{ $atlet->jenis_kelamin == 'L' ? 'Laki-laki (L)' : 'Perempuan (P)' }}</b></td>
                        </tr>
                        <tr>
                            <td>Tempat, Tanggal Lahir</td>
                            <td>:</td>
                            <td><b>{{ $atlet->tempat_lahir }}, {{ $atlet->tanggal_lahir }}</b></td>
                        </tr>
                        <tr>
                            <td>Pendidikan</td>
                            <td>:</td>
                            <td><b>{{ $atlet->pendidikan_terakhir }}</b></td>
                        </tr>
                        <tr>
                            <td>Tinggi & Berat Badan</td>
                            <td>:</td>
                            <td><b>{{ $atlet->tinggi_badan }} Cm / {{ $atlet->berat_badan }} Kg</b></td>
                        </tr>
                    </table>
                    <hr>
                    <strong class="text-primary mt-3">Berkas Pengajuan</strong>
                    <hr>
                    <table class="table table-borderless table-hover table-sm">
                        <tr>
                            <td>File Ijazah</td>
                            <td>:</td>
                            <td><a href="{{ asset('storage/' . $atlet->fc_ijazah) }}" class="btn btn-sm btn-warning"
                                    target="__blank">Lihat
                                    File</a></td>
                        </tr>
                        <tr>
                            <td>File KTP</td>
                            <td>:</td>
                            <td><a href="{{ asset('storage/' . $atlet->fc_ktp) }}" class="btn btn-sm btn-warning"
                                    target="__blank">Lihat
                                    File</a></td>
                        </tr>
                        <tr>
                            <td>File Kartu Keluarga</td>
                            <td>:</td>
                            <td><a href="{{ asset('storage/' . $atlet->fc_kk) }}" class="btn btn-sm btn-warning"
                                    target="__blank">Lihat
                                    File</a></td>
                        </tr>
                        <tr>
                            <td>File Akta</td>
                            <td>:</td>
                            <td><a href="{{ asset('storage/' . $atlet->akta) }}" class="btn btn-sm btn-warning"
                                    target="__blank">Lihat
                                    File</a></td>
                        </tr>
                        <tr>
                            <td>File Pas Foto</td>
                            <td>:</td>
                            <td><a href="{{ asset('storage/' . $atlet->pas_foto) }}" class="btn btn-sm btn-warning"
                                    target="__blank">Lihat
                                    File</a></td>
                        </tr>
                        <tr>
                            <td>BPJS Aktif</td>
                            <td>:</td>
                            <td><a href="{{ asset('storage/' . $atlet->bpjs) }}" class="btn btn-sm btn-warning"
                                    target="__blank">Lihat
                                    File</a></td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <strong>Riwayat Peninjauan</strong>
                    <hr>
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-action list-group-item-light">
                            <strong>Pengajuan</strong> <br><small>{{ $atlet->created_at->format('d M Y ') }}</small>
                        </li>
                        @foreach (App\Models\Tinjauan::where('id_atlet', $atlet->id)->get() as $item)
                            <li
                                class="list-group-item list-group-item-action list-group-item-{{ $item->status == 'Diterima' ? 'success' : ($item->status == 'Ditolak' ? 'danger' : 'warning') }}">
                                <strong>{{ $item->isi }}
                                </strong><br><small>{{ $item->created_at->format('d M Y ') }}</small>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @if ($atlet->status != 'Distujui' && Auth::user()->role == 'Admin')
                <div class="mt-3">
                    <button type="button" class="btn btn-lg btn-primary" style="width: 100%;" data-bs-toggle="modal"
                        data-bs-target="#modalPeninjauan">
                        <i class="bx bx-file"></i> Update Hasil Peninjauan
                    </button>
                </div>
            @elseif(Auth::user()->role == 'Operator')
                @if ($atlet->status != 'Distujui')
                    <div class="mt-3">
                        <button type="button" class="btn btn-lg btn-warning" style="width: 100%;">
                            <i class="bx bx-file"></i> Kirim Ulang Pengajuan
                        </button>
                    </div>
                @endif
            @endif

        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modalPeninjauan" tabindex="-1" aria-labelledby="modalPeninjauanLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('atlet.store-tinjauan') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalPeninjauanLabel">Update Hasil Peninjauan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id_atlet" value="{{ $atlet->id }}">
                        <div class="mb-3">
                            <label for="isi" class="form-label">Hasil Peninjauan</label>
                            <textarea class="form-control" id="isi" name="isi" rows="4" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="Distujui">Disetujui</option>
                                <option value="Ditolak">Ditolak</option>
                                <option value="Revisi">Revisi</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
