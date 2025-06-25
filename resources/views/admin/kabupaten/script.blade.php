@push('js')
    <script>
        $(function() {
            $('#datatable-customers').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '{{ url('kabupaten-datatable') }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },

                    {
                        data: 'kabupaten',
                        name: 'kabupaten'
                    },
                    {
                        data: 'operator',
                        name: 'operator'
                    },
                    {
                        data: 'atlet',
                        name: 'atlet'
                    },
                    {
                        data: 'pelatih',
                        name: 'pelatih'
                    },

                    {
                        data: 'action',
                        name: 'action'
                    }
                ]
            });
            $('.create-new').click(function() {
                $('#create').modal('show');
            });
            $('.refresh').click(function() {
                $('#datatable-customers').DataTable().ajax.reload();
            });
            window.editCustomer = function(id) {
                $.ajax({
                    type: 'GET',
                    url: '/kabupaten/edit/' + id,
                    success: function(response) {
                        $('#customersModalLabel').text('Edit Customer');
                        $('#formCustomerId').val(response.id);
                        $('#formCustomerName').val(response.kabupaten);
                        $('#customersModal').modal('show');
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            };
            window.akunOperator = function(id_kabupaten) {
                // Hapus DataTable sebelumnya jika sudah ada
                if ($.fn.DataTable.isDataTable('#datatable-operator')) {
                    $('#datatable-operator').DataTable().destroy();
                }

                // Inisialisasi DataTable dengan server-side processing
                $('#datatable-operator').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    ajax: '/operator-by-kabupaten/' + id_kabupaten,
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'sk',
                            name: 'sk'
                        },
                        {
                            data: 'ktp',
                            name: 'ktp'
                        },
                        {
                            data: 'foto',
                            name: 'foto'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        }
                    ]
                });

                $('#operatorKabupatenId').val(id_kabupaten);
                // Tampilkan modal
                $('#akunOperatorModal').modal('show');
                $('#createOperatorBtn').on('click', function() {
                    $('#createOperatorModal').modal({
                        backdrop: false, // <-- Ini kunci agar modal sebelumnya tidak tertutup
                        keyboard: false
                    });
                    $('#createOperatorModal').modal('show');
                });
            };
            $('#saveCustomerBtn').click(function() {
                var formData = $('#userForm').serialize();

                $.ajax({
                    type: 'POST',
                    url: '/kabupaten/store',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert(response.message);
                        // Refresh DataTable setelah menyimpan perubahan
                        $('#datatable-customers').DataTable().ajax.reload();
                        $('#customersModal').modal('hide');
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            });
            $('#createCustomerBtn').click(function() {
                var formData = $('#createUserForm').serialize();

                $.ajax({
                    type: 'POST',
                    url: '/kabupaten/store',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert(response.message);
                        $('#customersModalLabel').text('Edit Customer');
                        $('#formCustomerName').val('');
                        $('#datatable-customers').DataTable().ajax.reload();
                        $('#create').modal('hide');
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan: ' + xhr.responseText);
                    }
                });
            });
            window.resetPassword = function(id) {
                if (confirm('Apakah anda yakin reset password akun ini?')) {
                    $.ajax({
                        type: 'GET',
                        url: '/users/reset-password/' + id,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            // alert(response.message);
                            $('#datatable-operator').DataTable().ajax.reload();
                            alert('password berhasil di reset, password baru adalah: operatorkoni');
                        },
                        error: function(xhr) {
                            alert('Terjadi kesalahan: ' + xhr.responseText);
                        }
                    });
                }
            };
            window.verification = function(id) {
                if (confirm('Apakah anda yakin bahwa operator telah valid?')) {
                    $.ajax({
                        type: 'GET',
                        url: '/users/verification/' + id,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            // alert(response.message);
                            $('#datatable-operator').DataTable().ajax.reload();
                        },
                        error: function(xhr) {
                            alert('Terjadi kesalahan: ' + xhr.responseText);
                        }
                    });
                }
            };
            window.deleteCustomers = function(id) {
                if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                    $.ajax({
                        type: 'DELETE',
                        url: '/kabupaten/delete/' + id,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            // alert(response.message);
                            $('#datatable-customers').DataTable().ajax.reload();
                        },
                        error: function(xhr) {
                            alert('Terjadi kesalahan: ' + xhr.responseText);
                        }
                    });
                }
            };
            window.deleteOperator = function(id) {
                if (confirm('Apakah Anda yakin ingin menghapus operator ini?')) {
                    $.ajax({
                        type: 'DELETE',
                        url: '/users/delete/' + id,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            // alert(response.message);
                            $('#datatable-customers').DataTable().ajax.reload();
                            $('#datatable-operator').DataTable().ajax.reload();
                        },
                        error: function(xhr) {
                            alert('Terjadi kesalahan: ' + xhr.responseText);
                        }
                    });
                }
            };
            $('#createOperatorForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: '/users/store',
                    method: 'POST',
                    data: $(this).serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        $('#createOperatorModal').modal('hide');
                        $('#createOperatorForm')[0].reset();
                        $('#datatable-customers').DataTable().ajax.reload();
                        $('#datatable-operator').DataTable().ajax.reload();
                        alert('Operator berhasil ditambahkan.');
                    },
                    error: function(xhr) {
                        alert('Gagal menambahkan operator. Periksa input.');
                    }
                });
            });
        });
    </script>
@endpush
