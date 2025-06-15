<!-- Modal for Create and Edit -->
<div class="modal fade" id="customersModal" tabindex="-1" aria-labelledby="customersModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Edit Kabupaten</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for Create and Edit -->
                <form id="userForm">
                    <input type="hidden" id="formCustomerId" name="id">
                    <div class="mb-3">
                        <label for="formCustomerName" class="form-label">Kabupaten</label>
                        <input type="text" class="form-control" id="formCustomerName" name="kabupaten" required>
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
                <h5 class="modal-title" id="userModalLabel">Tambah Kabupaten</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for Create and Edit -->
                <form id="createUserForm">
                    <div class="mb-3">
                        <label for="formCustomerName" class="form-label">Kabupaten</label>
                        <input type="text" class="form-control" id="formCustomerName" name="kabupaten" required>
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
<div class="modal fade" id="akunOperatorModal" tabindex="-1" role="dialog" aria-labelledby="akunOperatorLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="akunOperatorLabel">Daftar Operator Kabupaten</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <button class="btn btn-primary mb-3" id="createOperatorBtn">
                    Tambah Operator
                </button>
                <table id="datatable-operator" class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="createOperatorModal" tabindex="-1" aria-labelledby="createOperatorModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <form id="createOperatorForm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createOperatorModalLabel">Tambah Operator</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 p-2 bg-secondary text-dark text-white rounded">
                        <p>Operator akan memiliki akses untuk mengelola data pada kabupaten ini.<br>
                            Password Default :
                            <b>operatorkoni</b>
                        </p>
                    </div>
                    <div class="mb-3">
                        <label for="operatorName" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="operatorName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="operatorEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="operatorEmail" name="email" required>
                    </div>
                    <input type="hidden" name="id_kabupaten" id="operatorKabupatenId">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>
