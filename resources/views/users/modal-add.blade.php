<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="modal-popin" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-popin" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Tambah Data User</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <form action="{{ route('users.store') }}" method="POST" id="formAddUser" class="needs-validation xform">
                    <div class="block-content">
                        <div class="form-group row">
                            <label class="col-12">NIK</label>
                            <div class="col-md-12">
                                <input type="text" name="nik" id="nik" class="form-control" placeholder="NIK" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12">Nama Lengkap</label>
                            <div class="col-md-12">
                                <input type="text" name="fullname" id="fullname" class="form-control" placeholder="Nama Lengkap" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12">Email</label>
                            <div class="col-md-12">
                                <input type="email" name="email" id="email" class="form-control" placeholder="example@gmail.com" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12">Username</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="username" placeholder="User Name" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12">Password</label>
                            <div class="col-md-12">
                                <input type="password" class="form-control" name="password" placeholder="Password" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12">Role</label>
                            <div class="col-md-12">
                                <select class="form-control select2" name="role_id" id="role_id" required>
                                    @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary text-left">
                    <i class="fa fa-save mr-5"></i>SAVE DATA
                </button>
            </div>
            </form>
        </div>
    </div>
</div>
