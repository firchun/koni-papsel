@extends('layouts.backend.admin')

@section('content')
    @include('layouts.backend.alert')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header flex-column flex-md-row">
                    <div class="head-label ">
                        <h5 class="card-title mb-0">{{ $title ?? 'Title' }}</h5>
                    </div>
                    <div class="dt-action-buttons text-end pt-3 pt-md-0">
                        <div class=" btn-group " role="group">
                            <button class="btn btn-secondary refresh btn-default" type="button">
                                <span>
                                    <i class="bx bx-sync me-sm-1"> </i>
                                    <span class="d-none d-sm-inline-block">Refresh Data</span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                <hr>
                <div style="margin-left:24px; margin-right: 24px;">
                    <strong>Filter Data</strong>
                    <div class="d-flex justify-content-center align-items-center row gap-3 gap-md-0">

                        <div class="col-lg-4 col-md-6 col-12 mb-3">
                            <div class="input-group">
                                <span class="input-group-text">Tgl</span>
                                <input type="date" class="form-control" id="fromDate"
                                    value="{{ date('Y-m-d', strtotime('-1 month')) }}">
                                <span class="input-group-text"> - </span>
                                <input type="date" class="form-control" id="toDate" value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                        @if (Auth::user()->role == 'Admin')
                            <div class="col-md-3 col-12 mb-3">
                                <select id="selectKabupaten" class="form-select text-capitalize">
                                    <option value="-">Semua Kabupaten</option>
                                    @foreach (App\Models\Kabupaten::all() as $item)
                                        <option value="{{ $item->id }}">{{ $item->kabupaten }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        <div class="col-md-2 col-12 mb-3">
                            <select id="selectStatus" class="form-select text-capitalize">
                                <option value="-">Semua Status</option>
                                <option value="Menunggu">Menunggu</option>
                                <option value="Distujui">Distujui</option>
                                <option value="Revisi">Revisi</option>
                                <option value="Ditolak">Ditolak</option>
                            </select>
                        </div>
                        <div class="col-md-2 col-12 mb-3">
                            <select id="selectCabor" class="form-select text-capitalize">
                                <option value="-">Semua Cabor</option>
                                @foreach (App\Models\Cabor::all() as $item)
                                    <option value="{{ $item->id }}">{{ $item->cabor }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </div>
                <hr>
                <div class="card-datatable table-responsive table-sm">
                    <table id="datatable-customers" class="table table-hover table-bordered display">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tgl</th>
                                @if (Auth::user()->role == 'Admin')
                                    <th>Kabupaten</th>
                                @endif
                                <th>Nama</th>
                                <th>Cabor</th>
                                <th>Kategori</th>
                                <th>Sub-Kategori</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Tgl</th>
                                @if (Auth::user()->role == 'Admin')
                                    <th>Kabupaten</th>
                                @endif
                                <th>Nama</th>
                                <th>Cabor</th>
                                <th>Kategori</th>
                                <th>Sub-Kategori</th>
                                <th>Status</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(function() {
            $('#datatable-customers').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '{{ url('atlet-datatable') }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        render: function(data, type, row) {
                            const date = new Date(data);
                            const day = String(date.getDate()).padStart(2, '0');
                            const month = String(date.getMonth() + 1).padStart(2, '0');
                            const year = date.getFullYear();
                            return `${day}/${month}/${year}`;
                        }
                    },
                    @if (Auth::user()->role == 'Admin')
                        {
                            data: 'kabupaten.kabupaten',
                            name: 'kabupaten.kabupaten',
                        },
                    @endif {
                        data: 'nama_lengkap',
                        name: 'nama_lengkap'
                    },
                    {
                        data: 'cabor.cabor',
                        name: 'cabor.cabor',
                    },
                    {
                        data: 'nomor_pertandingan.nomor_pertandingan',
                        name: 'nomor_pertandingan.nomor_pertandingan',
                    },
                    {
                        data: 'sub_nomor_pertandingan',
                        name: 'sub_nomor_pertandingan',
                    },
                    {
                        data: 'status',
                        name: 'status',
                        render: function(data, type, row) {
                            let badgeClass = 'bg-label-secondary';

                            if (data === 'Menunggu') {
                                badgeClass = 'bg-label-warning';
                            } else if (data === 'Disetujui') {
                                badgeClass = 'bg-label-primary';
                            } else if (data === 'Ditolak') {
                                badgeClass = 'bg-label-danger';
                            }

                            return `<span class="badge ${badgeClass}">${data}</span>`;
                        }
                    },

                ],
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'pdf',
                        text: '<i class="bx bxs-file-pdf"></i> PDF',
                        className: 'btn-danger mx-3',
                        orientation: 'portrait',
                        title: '{{ $title . date('d-m-y H:i:s') }}',
                        pageSize: 'A4',
                        exportOptions: {
                            columns: ':visible'
                        },
                        customize: function(doc) {
                            doc.defaultStyle.fontSize = 8;
                            doc.styles.tableHeader.fontSize = 8;
                            doc.styles.tableHeader.fillColor = '#2a6908';
                        },
                        header: true,

                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="bx bxs-file-export"></i> Excel',
                        title: '{{ $title . date('d-m-y H:i:s') }}',
                        className: 'btn-success',
                        exportOptions: {
                            columns: ':visible'
                        }
                    }
                ]
            });
            $('.refresh').click(function() {
                $('#datatable-customers').DataTable().ajax.reload();
            });

        });
    </script>
    <!-- JS DataTables Buttons -->
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
@endpush
