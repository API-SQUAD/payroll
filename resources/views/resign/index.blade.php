@extends('layouts.main')

@section('content')
<main id="main-container">
    <div class="content">
        <div class="row">
            <div class="col-md-6">
                <h5><b>Data Resign Karyawan</b></h5>
            </div>
            <div class="col-md-6 text-right">
                <button class="btn btn-danger text-left" type="button" data-toggle="modal" data-target="#modal-popin">
                    <i class="fa fa-user-times mr-5"></i>Resign Karyawan
                </button>
            </div>
        </div>
    </div>

    <div class="block">
        <div class="block-content block-content-full">
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="data-table">
                <thead>
                    <tr>
                        <th class="text-center">No.</th>
                        <th class="text-center">NIK</th>
                        <th class="text-center">Nama Karyawan</th>
                        <th class="text-center">Tgl Resign</th>
                        <th class="text-center">Keterangan</th>
                    </tr>
                </thead>
                <tbody class="text-center"></tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="modal-popin" tabindex="-1" role="dialog" aria-labelledby="modal-popin"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-popin" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Resign Karyawan</h3>
                        <div class="block-options">
                            <button class="btn-block-option" type="button" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <form class="block-content" id="form-add-resign-karyawan">
                        <div class="form-group row">
                            <label for="nik_atau_nama_karyawan" class="col-12">NIK / Nama Karyawan</label>
                            <div class="col-md-12">
                                <select name="nik_atau_nama_karyawan" class="form-control">
                                    <option value="" disabled selected>Please select</option>
                                    {{-- disini --}}
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tgl_resign" class="col-12">Tanggal Resign</label>
                            <div class="col-md-12">
                                <input type="date" name="tgl_resign" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="keterangan" class="col-12">Keterangan</label>
                            <div class="col-md-12">
                                <textarea name="keterangan" rows="5" class="form-control"
                                    placeholder="Keterangan"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Close</button>
                    <button id="btn-form-add-resign-karyawan" type="button" class="btn btn-primary text-left"
                        onclick="addResignKaryawan()">
                        <i class="fa fa-save mr-5"></i>SAVE DATA
                    </button>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        dataTable();

        $('#modal-popin').on('shown.bs.modal', function() {
            getAktifKaryawanList();

        });
    });

    function dataTable() {
        $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('resign.data-table') }}",
                type: 'GET'
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'nik',
                    name: 'nik'
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'tgl_resign',
                    name: 'tgl_resign'
                },
                {
                    data: 'keterangan',
                    name: 'keterangan'
                },
            ]
        })
    }

    function getAktifKaryawanList() {
        $.ajax({
            url: "{{ route('resign.get-aktif-karyawan-list') }}",
            type: 'GET',
            success: function(response) {
                let data = response;
                console.log(data);

                let select = $('select[name="nik_atau_nama_karyawan"]');
                select.empty();
                select.append('<option value="" disabled selected>Please select</option>');
                data.forEach(function(item) {
                    select.append(`<option value="${item.nik}">${item.nik} / ${item.nama}</option>`);
                });
            }
        });
    }

    function addResignKaryawan() {
        let form = $('#form-add-resign-karyawan');
        let data = form.serializeArray();
        console.log(data);

        $.ajax({
            url: "{{ route('resign.store') }}",
            type: 'POST',
            data: data,
            success: function(response) {
                console.log(response);
                getAktifKaryawanList();
                $('#modal-popin').modal('hide');
                $('#data-table').DataTable().ajax.reload();
            }
        });
    }
</script>
@endsection