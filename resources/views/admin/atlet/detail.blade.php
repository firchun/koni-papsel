@extends('layouts.backend.admin')

@section('content')
    @include('layouts.backend.alert')
    <div class="row justify-content-center ">
        <div class="col-12">
            <div class="mb-3">
                <a href="{{ route('atlet') }}" class="btn btn-secondary">
                    <i class="bx bx-arrow-back"></i> Kembali
                </a>
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
                            Pengajuan pada {{ $atlet->created_at->format('d M Y ') }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
