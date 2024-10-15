@extends('layouts.main')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-6">
            <h5><b>Data Users</b></h5>
        </div>
        <div class="col-md-6 text-right">
            <button type="button" class="btn btn-success text-left" id="btnAddUser">
                <i class="fa fa-user-plus mr-5"></i>Tambah User
            </button>
        </div>
    </div>

    <div class="block">
        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter" id="tableUsers">
                <thead>
                    <tr>
                        <th class="text-center">No.</th>
                        <th class="text-center">NIK / Nama</th>
                        <th class="text-center">Username</th>
                        <th class="text-center">Role</th>
                        <th class="text-center"><i class="fa fa-gear"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <td colspan="5" class="text-center">Table is empty</td>
                    {{-- <tr>
                        <td class="text-center">1.</td>
                        <td>0001 / Rifan Hardiyan</td>
                        <td class="text-center">rifan</td>
                        <td class="text-center">*****</td>
                        <td class="text-center">SUPERADMIN</td>
                        <td class="text-center">
                            <buttona type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal-edit">
                                <i class="fa fa-file"></i>
                            </buttona> |
                            <button type="button" class="btn btn-sm btn-danger">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr> --}}
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
        <div class="modal-dialog modal-dialog-popin" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Edit Data User</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="form-group row">
                            <label class="col-12">NIK / Nama Lengkap</label>
                            <div class="col-md-12">
                                <select class="form-control" name="">
                                    <option value="1">0001 / Rifan Hardiyan</option>
                                    <option value="2">0002 / Pak David</option>
                                    <option value="3">0003 / Pak Rio</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12">User Name</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="" value="rifan">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12">Password</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="" value="****">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12">Role</label>
                            <div class="col-md-12">
                                <select class="form-control" name="">
                                    <option value="0">Superadmin</option>
                                    <option value="1">Superadmin</option>
                                    <option value="2">Manager</option>
                                    <option value="3">User</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary text-left" data-dismiss="modal">
                        <i class="fa fa-save mr-5"></i>EDIT DATA
                    </button>
                </div>
            </div>
        </div>
    </div>

    @include('users.modal-add')
    @include('users.modal-edit')
</div>
@endsection
@section('js')
    <script>
    let tableUsers
    $(document).ready(function() {
        $(function() {
            loadData();

            $('#btnAddUser').on('click', function() {
                add()
            })
        });
    })

    loadData = function() {
        if (undefined !== tableUsers) {
            tableUsers.destroy()
            tableUsers.clear().draw();
        }

        tableUsers = $('#tableUsers').DataTable({
            responsive: true
            , searching: true
            , autoWidth: false
            , processing: true
            , serverSide: true
            , aLengthMenu: [
                [5, 10, 25, 50, 100, 250, 500, -1]
                , [5, 10, 25, 50, 100, 250, 500, "All"]
            ]
            , pageLength: -1
            , ajax: "{{ route('users.data') }}"
            , drawCallback: function(settings) {
                $('table#tableUsers tr').on('click', '#ubah', function(e) {
                    e.preventDefault();

                    let data = tableUsers.row($(this).parents('tr')).data();
                    let url = $(this).data('url')
                    edit(data, url)
                })

                $('table#tableUsers tr').on('click', '#hapus', function(e) {
                    e.preventDefault();

                    let data = tableUsers.row($(this).parents('tr')).data();
                    let url = $(this).data('url')
                    destroy(data, url)
                })
            }
            , columns: [{
                    data: 'DT_RowIndex'
                    , name: 'DT_RowIndex'
                    , width: '1%'
                    , class: 'fixed-side text-center'
                }
                , {
                    data: 'nik_nama'
                    , name: 'nik_nama'
                }
                , {
                    data: 'username'
                    , name: 'username'
                }
                , {
                    data: 'role'
                    , name: 'role'
                }
                , {
                    data: 'action'
                    , name: 'action'
                    , class: 'fixed-side text-center'
                    , orderable: false
                    , searchable: false
                }
            , ]
        , })
        tableUsers.on('draw', function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
    }

    add = function() {
        let form = $('#formAddUser')
        TriggerReset(form)

        $('div#modalAdd').on('show.bs.modal', function() {
            $('div#modalAdd').off('hidden.bs.modal')
            if ($('body').hasClass('modal-open')) {
                $('div#modalAdd').on('hidden.bs.modal', function() {
                    $('body').addClass('modal-open')
                })
            }
        }).modal('show')

        form.off('xform-success').on('xform-success', function() {
            tableUsers.ajax.reload(null, false)
            $('div#modalAdd').modal('hide')
        })
    }

    edit = function(data, url) {
        let form = $('#formEditUser')
        TriggerReset(form)
        form.attr('action', url)

        form.find('input[id=nikEdit]').val(data.nik)
        form.find('#fullnameEdit').val(data.fullname)
        form.find('#emailEdit').val(data.email)
        form.find('#usernameEdit').val(data.username)
        let role_id = data.roles.length ? data.roles[0].id : null; // Assuming roles is an array and you want the first role
        form.find('#role_idEdit').val(role_id).trigger('change') // Use trigger to update Select2

        $('div#modalEdit').on('show.bs.modal', function() {
            $('div#modalEdit').off('hidden.bs.modal')
            if ($('body').hasClass('modal-open')) {
                $('div#modalEdit').on('hidden.bs.modal', function() {
                    $('body').addClass('modal-open')
                })
            }
        }).modal('show')

        form.off('xform-success').on('xform-success', function() {
            tableUsers.ajax.reload(null, false)
            $('div#modalEdit').modal('hide')
        })
    }

    destroy = function(data, url) {
        Swal.fire({
            title: 'Are you sure?'
            , text: "Want to delete this data?"
            , icon: 'warning'
            , showCancelButton: true
            , confirmButtonColor: '#6777EF'
            , cancelButtonColor: '#FC544B'
            , confirmButtonText: 'Yes!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url
                    , data: {
                        _token: "{{ csrf_token() }}"
                        , _method: "delete"
                    }
                    , type: 'POST'
                    , success: function(res) {
                        if (res.status == 'success') {
                            toastr.success(res.toast)
                        } else if (res.status == 'error') {
                            toastr.error(res.toast)
                        }

                        tableUsers.ajax.reload(null, false)
                    }
                    , error: function(err) {
                        if (err.responseJSON) {
                            toastr.error(err.statusText + ' | ' + err.responseJSON.message)
                        } else {
                            toastr.error(err.statusText)
                        }
                    }
                })
            }
        })
    }
    </script>
@endsection
