<div class="modal fade" id="create" tabindex="-1" aria-labelledby="createPelatihLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form id="createUserForm" enctype="multipart/form-data">
                <input type="hidden" name="id_kabupaten" value="{{ Auth::user()->id_kabupaten }}">
                <input type="hidden" name="is_verified" value="0">
                <input type="hidden" name="status" value="Pengajuan">
                <div class="modal-header">
                    <h5 class="modal-title" id="createPelatihLabel">Formulir Pengajuan Pelatih</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Cabang Olahraga</label>
                            <select class="form-select" name="cabang_olahraga">
                                @foreach (App\Models\Cabor::all() as $item)
                                    <option value="{{ $item->cabor }}">{{ $item->cabor }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">NIK KK</label>
                            <input type="text" name="nik_kk" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">NIK KTP</label>
                            <input type="text" name="nik_ktp" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">No. HP</label>
                            <input type="text" name="no_hp" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-select" required>
                                <option value="">Pilih</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="form-label">Pendidikan Terakhir</label>
                            <input type="text" name="pendidikan_terakhir" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">FC Ijazah</label>
                            <input type="file" name="ijazah" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">FC Kartu Keluarga</label>
                            <input type="file" name="kartu_keluarga" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">FC KTP</label>
                            <input type="file" name="ktp" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Akte Kelahiran</label>
                            <input type="file" name="akte_kelahiran" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Pas Foto</label>
                            <input type="file" name="pas_photo" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Lisensi Pelatih</label>
                            <input type="file" name="lisensi_pelatih" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="createCustomerBtn">Ajukan Sekarang <i
                            class="bx bx-send"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Tambahkan ini sebelum script custom kamu -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
