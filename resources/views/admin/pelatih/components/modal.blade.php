<div class="modal fade" id="create" tabindex="-1" aria-labelledby="customersModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Pengajuan Pelatih Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for Create and Edit -->
                <form id="createUserForm" enctype="multipart/form-data">
                    <div class="row mb-3">
                        <input type="hidden" name="id_kabupaten" value="{{ Auth::user()->id_kabupaten }}">
                        <div class="col">
                            <label class="form-label">Cabang Olahraga</label>
                            <select name="id_cabor" class="form-select" id="caborSelect" required>
                                <option value="">Pilih Cabang Olahraga</option>
                                @foreach ($cabor as $item)
                                    <option value="{{ $item->id }}">{{ $item->cabor }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label class="form-label">Kategori Pertandingan</label>
                            <select name="id_nomor_pertandingan_cabor" class="form-select" id="nomorPertandinganSelect"
                                required></select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Sub Kategori Pertandingan</label>
                            <select class="form-select" name="sub_nomor_pertandingan" id="subNomorPertandingan"
                                required>
                                <option value="">-</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nama Lengkap Sesuai KTP/KK</label>
                            <input type="text" class="form-control" name="nama_lengkap" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">NIK KK</label>
                            <input type="text" class="form-control" name="nik_kk" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">NIK KTP</label>
                            <input type="text" class="form-control" name="nik_ktp">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">No. HP</label>
                            <input type="text" class="form-control" name="no_hp">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Jenis Kelamin</label>
                            <div>
                                <label class="me-3"><input type="radio" name="jenis_kelamin" value="L"
                                        required> Laki-laki</label>
                                <label><input type="radio" name="jenis_kelamin" value="P" required>
                                    Perempuan</label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tanggal_lahir" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control" name="tempat_lahir" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Pendidikan Terakhir</label>
                            <input type="text" class="form-control" name="pendidikan_terakhir">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Tinggi Badan (cm)</label>
                            <input type="number" class="form-control" name="tinggi_badan">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Berat Badan (kg)</label>
                            <input type="number" class="form-control" name="berat_badan">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">FC Ijazah</label>
                            <input type="file" class="form-control" name="fc_ijazah">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">FC KTP</label>
                            <input type="file" class="form-control" name="fc_ktp">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">FC KK</label>
                            <input type="file" class="form-control" name="fc_kk">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Akta</label>
                            <input type="file" class="form-control" name="akta">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Pas Foto</label>
                            <input type="file" class="form-control" name="pas_foto">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="createCustomerBtn">
                    Ajukan Sekarang <i class="bx bx-send"></i></button>
            </div>
        </div>
    </div>
</div>
<!-- Tambahkan ini sebelum script custom kamu -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#caborSelect').on('change', function() {
            const caborId = $(this).val();
            const nomorSelect = $('#nomorPertandinganSelect');
            nomorSelect.html('<option>Loading...</option>');

            $.get(`/nomor-pertandingan/edit/${caborId}`, function(data) {
                nomorSelect.empty();
                if (!data || data.length === 0) {
                    nomorSelect.append('<option value="">Data Belum Ada</option>');
                }
                nomorSelect.append(
                    `<option value="">Pilih Kategori</option>`);
                data.forEach(item => {

                    data.forEach(item => {
                        const subList = Array.isArray(item
                                .sub_nomor_pertandingan) ? item
                            .sub_nomor_pertandingan : [];
                        nomorSelect.append(
                            `<option value="${item.id}" data-sub='${JSON.stringify(subList)}'>${item.nomor_pertandingan}</option>`
                        );
                    });
                });
            }).fail(function() {
                nomorSelect.html('<option value="">Gagal mengambil data</option>');
            });
        });
        // Saat nomor pertandingan dipilih, tampilkan sub nomor pertama (atau digabung)
        $('#nomorPertandinganSelect').on('change', function() {
            const selectedOption = $(this).find('option:selected');
            const subList = selectedOption.data('sub') || [];

            const subSelect = $('#subNomorPertandingan');
            subSelect.empty();

            if (Array.isArray(subList) && subList.length > 0) {
                subSelect.append(`<option value="">Pilih Sub Kategori</option>`);
                subList.forEach(sub => {
                    subSelect.append(`<option value="${sub}">${sub}</option>`);
                });
            } else {
                subSelect.append(`<option value="">-</option>`);
            }
        });
    });
</script>
