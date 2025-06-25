@extends('layouts.backend.admin')

@section('content')
    @include('layouts.backend.alert')
    @if (Auth::user()->role == 'Admin' || (Auth::user()->role == 'Operator' && Auth::user()->operator_verified == true))
        <div class="row">
            @if (Auth::user()->role == 'Admin')
                @include('admin.dashboard_component.card1', [
                    'count' => $admin,
                    'title' => 'Akun Admin',
                    'subtitle' => 'Total Admin',
                    'color' => 'primary',
                    'icon' => 'user',
                ])
            @endif
            @include('admin.dashboard_component.card1', [
                'count' => $operator,
                'title' => 'Akun Operator',
                'subtitle' => 'Total Operator',
                'color' => 'warning',
                'icon' => 'user',
            ])
            @include('admin.dashboard_component.card1', [
                'count' => $atlet,
                'title' => 'Atlet',
                'subtitle' => 'Total Atlet',
                'color' => 'success',
                'icon' => 'user',
            ])
            @include('admin.dashboard_component.card1', [
                'count' => $pelatih,
                'title' => 'pelatih',
                'subtitle' => 'Total pelatih',
                'color' => 'success',
                'icon' => 'user',
            ])
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5>
                                Statistika Pengajuan Atlet & Pelatih
                            </h5>
                            <select id="id_kabupaten" class="border p-2 rounded mb-4">
                                @foreach ($kabupaten as $item)
                                    <option value="{{ $item->id }}">{{ $item->kabupaten }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="chartAtlet" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="mb-3">
                    @if (!Auth::user()->operator_verified && empty(Auth::user()->sk_kabupaten))
                        <div class="alert alert-info fade show" role="alert">
                            <strong>Perhatian!</strong> Berkas anda berhasil diunggah, namun masih menunggu verifikasi dari
                            admin.
                        </div>
                    @elseif (!Auth::user()->operator_verified)
                        <div class="alert alert-warning fade show" role="alert">
                            <strong>Perhatian!</strong> Silakan mengunggah berkas operator terlebih dahulu untuk dapat
                            mengakses fitur lainnya.
                        </div>
                    @endif
                </div>
                <div class="card">
                    <div class="card-header">
                        <h6>Berkas Operator</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ Auth::id() }}">
                            <div class="mb-3">
                                <label for="file" class="form-label">SK Operator Kabupaten</label>
                                <input type="file" class="form-control" name="sk_operator" required>
                                @if (Auth::user()->sk_operator)
                                    <a href="{{ url(Auth::user()->sk_operator) }}"
                                        target="__blank"class="btn btn-warning my-2 btn-sm"><i class="bx bx-file"></i> Lihat
                                        Berkas SK Operator</a>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="file" class="form-label">Scan KTP Operator Kabupaten</label>
                                <input type="file" class="form-control" name="ktp_operator" required>
                                @if (Auth::user()->ktp_operator)
                                    <a href="{{ url(Auth::user()->ktp_operator) }}" target="__blank"
                                        class="btn btn-warning my-2 btn-sm"><i class="bx bx-file"></i> Lihat
                                        Scan KTP Operator</a>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="file" class="form-label">Pas Foto</label>
                                <input type="file" class="form-control" name="foto_operator" required>
                                @if (Auth::user()->foto_operator)
                                    <a href="{{ asset(Auth::user()->foto_operator) }}" target="__blank"
                                        class="btn btn-warning my-2 btn-sm"><i class="bx bx-file"></i> Lihat
                                        Pas Foto Operator</a>
                                @endif
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg"><i class="bx bx-save"></i> Unggah
                                    Berkas</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('chartAtlet').getContext('2d');
        let chart;

        function fetchData(kabupatenId) {
            fetch(`/chart-atlet?id_kabupaten=${kabupatenId}`)
                .then(response => response.json())
                .then(data => {
                    if (chart) chart.destroy();
                    chart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: data.labels,
                            datasets: [{
                                    label: 'Atlet',
                                    data: data.atlet,
                                    backgroundColor: 'rgba(75, 192, 192, 0.6)'
                                },
                                {
                                    label: 'Pelatih',
                                    data: data.pelatih,
                                    backgroundColor: 'rgba(255, 159, 64, 0.6)'
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                });
        }

        document.getElementById('id_kabupaten').addEventListener('change', function() {
            fetchData(this.value);
        });

        window.onload = function() {
            const defaultId = document.getElementById('id_kabupaten').value;
            fetchData(defaultId);
        }
    </script>
@endpush
