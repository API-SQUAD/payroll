@extends('layouts.main')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-6">
            <h5><b>Data Karyawan</b></h5>
        </div>
        <div class="col-md-6 text-right">
            <button type="button" class="btn btn-success text-left" id="btnAddKaryawan">
                <i class="fa fa-user-plus mr-5"></i>Tambah Karyawan
            </button>
        </div>
    </div>
    <div class="block">
        <div class="block-content block-content-full">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-vcenter" id="tableKaryawan">
                    <thead>
                        <tr>
                            <th class="text-center" width="1%">NO.</th>
                            <th class="text-center">NIK</th>
                            <th class="text-center">NAMA</th>
                            <th class="text-center">JABATAN</th>
                            <th class="text-center">DIVISI / CABANG</th>
                            <th class="text-center">PERUSAHAAN</th>
                            <th class="text-center"><i class="fa fa-gear"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <td colspan="7" class="text-center">Table is empty</td>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    let tableKaryawan
    $(document).ready(function() {
        $(function() {
            loadData();
            $('#btnAddKaryawan').on('click', function() {
                add()
            })
        });
    })
    loadData = function() {
        if (undefined !== tableKaryawan) {
            tableKaryawan.destroy()
            tableKaryawan.clear().draw();
        }
        tableKaryawan = $('#tableKaryawan').DataTable({
            responsive: true
            , searching: true
            , autoWidth: false
            , processing: true
            , serverSide: true
            , aLengthMenu: [
                [5, 10, 25, 50, 100, 250, 500, -1]
                , [5, 10, 25, 50, 100, 250, 500, "All"]
            ]
            , pageLength: 25
            , ajax: "{{ route('data_karyawan.data') }}"
            , drawCallback: function(settings) {
                $('table#tableKaryawan tr').on('click', '#ubah', function(e) {
                    e.preventDefault();
                    let data = tableKaryawan.row($(this).parents('tr')).data();
                    let url = $(this).data('url')
                    edit(data, url)
                })
                $('table#tableKaryawan tr').on('click', '#hapus', function(e) {
                    e.preventDefault();
                    let data = tableKaryawan.row($(this).parents('tr')).data();
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
                    data: 'nik'
                    , name: 'nik'
                }
                , {
                    data: 'nama'
                    , name: 'nama'
                }
                , {
                    data: 'jabatan'
                    , name: 'jabatan'
                }
                , {
                    data: 'divisi_cabang'
                    , name: 'divisi_cabang'
                }
                , {
                    data: 'perusahaan'
                    , name: 'perusahaan'
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
        tableKaryawan.on('draw', function() {
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
            tableKaryawan.ajax.reload(null, false)
            $('div#modalAdd').modal('hide')
        })
    }
    edit = function(data, url) {
        window.location.href = url;
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
                        tableKaryawan.ajax.reload(null, false)
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