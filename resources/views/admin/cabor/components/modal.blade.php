<!-- Modal for Create and Edit -->
<div class="modal fade" id="customersModal" tabindex="-1" aria-labelledby="customersModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Edit Cabang Olahraga</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for Create and Edit -->
                <form id="userForm">
                    <input type="hidden" id="formCustomerId" name="id">
                    <div class="mb-3">
                        <label for="formCustomerName" class="form-label">Cabang Olahraga</label>
                        <input type="text" class="form-control" id="formCustomerName" name="cabor" required>
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveCustomerBtn">Save</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="create" tabindex="-1" aria-labelledby="customersModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Tambah Cabang Olahraga</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for Create and Edit -->
                <form id="createUserForm">
                    <div class="mb-3">
                        <label for="formCustomerName" class="form-label">Cabang Olahraga</label>
                        <input type="text" class="form-control" id="formCustomerName" name="cabor" required>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="createCustomerBtn">Save</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="nomorPertandinganModal" tabindex="-1" aria-labelledby="customersModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Update Nomor Pertandingan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formNomorPertandingan">
                    <input type="hidden" name="id_cabor" id="idCabor">
                    <div id="nomorContainer">
                        <!-- Baris pertama akan ditambahkan via JS -->
                    </div>

                    <button type="button" class="btn  btn-primary mt-3" id="addNomorBtn">+ Tambah Nomor
                        Pertandingan</button>
                </form>˜
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="createNomorBtn">Save</button>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
    $(document).ready(function() {
        let nomorIndex = 0;

        function createNomorField(index) {
            return `
                <div class="card p-3 mb-3 nomor-box" data-index="${index}">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <input type="text" name="nomor[${index}][utama]" class="form-control me-2" placeholder="Nomor Pertandingan">
                        <button type="button" class="btn btn-sm btn-danger removeNomorBtn">✕</button>
                    </div>
                    <div class="sub-nomor-container"></div>
                    <button type="button" class="btn btn-sm btn-secondary mt-2 addSubNomorBtn">+ Tambah Sub Nomor</button>
                </div>`;
        }

        function createSubNomorField(index, subIndex) {
            return `
                <div class="input-group mb-2 sub-nomor ml-3" data-sub-index="${subIndex}">
                    <input type="text" name="nomor[${index}][sub][${subIndex}]" class="form-control" placeholder="Sub Nomor">
                    <button type="button" class="btn btn-outline-danger removeSubBtn">✕</button>
                </div>`;
        }

        function loadExistingData(data) {
            $('#nomorContainer').empty();
            nomorIndex = 0;

            data.forEach((item) => {
                const html = createNomorField(nomorIndex);
                $('#nomorContainer').append(html);

                const box = $(`.nomor-box[data-index="${nomorIndex}"]`);
                box.find(`input[name="nomor[${nomorIndex}][utama]"]`).val(item.nomor_pertandingan);

                if (item.sub_nomor_pertandingan) {
                    let subIndex = 0;
                    Object.entries(item.sub_nomor_pertandingan).forEach(([key, val]) => {
                        const subHTML = createSubNomorField(nomorIndex, subIndex);
                        box.find('.sub-nomor-container').append(subHTML);
                        box.find(`input[name="nomor[${nomorIndex}][sub][${subIndex}]"]`).val(
                            val);
                        subIndex++;
                    });
                }

                nomorIndex++;
            });
        }

        $('#addNomorBtn').on('click', function() {
            $('#nomorContainer').append(createNomorField(nomorIndex));
            nomorIndex++;
        });

        $('#nomorContainer').on('click', '.removeNomorBtn', function() {
            $(this).closest('.nomor-box').remove();
        });

        $('#nomorContainer').on('click', '.addSubNomorBtn', function() {
            const parent = $(this).closest('.nomor-box');
            const index = parent.data('index');
            const subContainer = parent.find('.sub-nomor-container');
            const subIndex = subContainer.find('.sub-nomor').length;
            subContainer.append(createSubNomorField(index, subIndex));
        });

        $('#nomorContainer').on('click', '.removeSubBtn', function() {
            $(this).closest('.sub-nomor').remove();
        });

        $('#createNomorBtn').on('click', function(e) {
            e.preventDefault();

            $.ajax({
                url: '/nomor-pertandingan/store',
                method: 'POST',
                data: $('#formNomorPertandingan').serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    alert('Data berhasil disimpan!');
                    $('#nomorPertandinganModal').modal('hide');
                    $('#formNomorPertandingan')[0].reset();
                    $('#nomorContainer').html('');
                    if ($('#datatable-nomor').length) {
                        $('#datatable-nomor').DataTable().ajax.reload();
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    alert('Terjadi kesalahan. Periksa kembali inputan Anda.');
                }
            });
        });

        // 🔁 Load data saat modal dibuka
        $('#nomorPertandinganModal').on('show.bs.modal', function(e) {
            const idCabor = e.relatedTarget?.dataset?.idCabor || $('#idCabor').val();
            if (!idCabor) return;

            $('#idCabor').val(idCabor); // set hidden input

            $.ajax({
                url: `/nomor-pertandingan/edit/${idCabor}`,
                method: 'GET',
                success: function(response) {
                    loadExistingData(response);
                },
                error: function() {
                    console.error('Gagal memuat data.');
                }
            });
        });
    });
</script>
