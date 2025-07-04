<!-- Modal for Create and Edit -->
<div class="modal fade" id="UsersModal" tabindex="-1" aria-labelledby="UsersModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Update Akun Administrator</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for Create and Edit -->
                <form id="userForm">
                    <input type="hidden" id="formUserId" name="id">
                    <div class="mb-3">
                        <label for="formUserName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="formUserName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="formUserEmail" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="formUserEmail" name="email" required>
                    </div>
                    <input type="hidden" value="Admin" name="role">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveUserBtn">Save</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="create" tabindex="-1" aria-labelledby="UsersModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Tambah Akun Administrator</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for Create and Edit -->
                <form id="createUserForm">
                    <div class="mb-3">
                        <label for="formUserName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="formUserName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="formUserEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="formUserEmail" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="formUserEmail" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <input type="hidden" value="Admin" name="role">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="createUserBtn">Save</button>
            </div>
        </div>
    </div>
</div>
