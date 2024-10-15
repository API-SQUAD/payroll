@extends('layouts.main')

@section('content')

<main id="main">
    <div class="content">
        <div class="row">
            <div class="col-md-6">
                <h5><b>Data Arsip Gaji Karyawan</b></h5>
            </div>
        </div>
    </div>

    <div class="block">
        <div class="block-content block-content-all">
            <style>
                .containers {
                    overflow: scroll;
                    height: auto;
                    width: auto;
                }

                table {
                    border-collapse: collapse;
                }

                table th,
                table td {
                    max-width: 300px;
                    padding: 8px 16px;
                    border: 1px solid #5c5b5b;
                    overflow: hidden;
                    text-overflow: ellipsis;
                    white-space: nowrap;
                }

                table thead {
                    position: sticky;
                    inset-block-start: 0;
                    background-color: white;
                }
            </style>
            <div class="containers">
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full" id="data-table"
                    style="font-size: 10px">
                    <thead>
                        <tr>
                            <td rowspan="2" class="text-center"><b>No.</b></td>
                            <td rowspan="2" class="text-center" style="background-color: #fafa7d;"><b>NIK</b></td>
                            <td rowspan="2" class="text-center" style="background-color: #fafa7d;"><b>Nama</b></td>
                            <td rowspan="2" class="text-center" style="background-color: #fafa7d;"><b>Jabatan</b></td>
                            <td rowspan="2" class="text-center" style="background-color: #fafa7d;"><b>Divisi / Cabang</b></td>
                            <td rowspan="2" class="text-center" style="background-color: #fafa7d;"><b>Tgl Lahir</b></td>
                            <td rowspan="2" class="text-center" style="background-color: #fafa7d;"><b>Status Kel.</b></td>
                            <td rowspan="2" class="text-center" style="background-color: #fafa7d;"><b>Tanggal Masuk</b></td>
                            <td rowspan="2" class="text-center" style="background-color: #fafa7d;"><b>Tanggal Akhir PKWT</b></td>
                            <td rowspan="2" class="text-center" style="background-color: #fafa7d;"><b>Rekening</b></td>
                            <td rowspan="2" class="text-center" style="background-color: #fafa7d;"><b>Bruto</b></td>
                            <td rowspan="2" class="text-center" style="background-color: #fafa7d;"><b>Gapok</b></td>
                            <td rowspan="2" class="text-center" style="background-color: #fafa7d;"><b>Tunj. Tetap</b></td>
                            <td rowspan="2" class="text-center" style="background-color: #fafa7d;"><b>Total Hari</b></td>
                            <td rowspan="2" class="text-center"><b>GAJI POKOK</b></td>
                            <td rowspan="2" class="text-center" style="background-color: #fafa7d;"><b>HARI KERJA</b></td>
                            <td rowspan="2" class="text-center"><b>GAJI POKOK EFEKTIF</b></td>
                            <td colspan="3" class="text-center"><b>TUNJANGAN</b></td>
                            <td rowspan="2" class="text-center"><b>GAJI BRUTO</b></td>
                            <td rowspan="2" class="text-center" style="background-color: #fafa7d;"><b>GAJI PERHARI</b></td>
                            <td rowspan="2" class="text-center" style="background-color: #fafa7d;"><b>GAJI SETELAH DIPOTONG HARI</b></td>
                            <td rowspan="2" class="text-center" style="background-color: #fafa7d;"><b>LEMBUR, ROLLING, DLL</b></td>
                            <td colspan="3" class="text-center" style="background-color: #fafa7d;"><b>POTONGAN</b></td>
                            <td colspan="3" class="text-center" style="background-color: #fafa7d;"><b>KOREKSI (+/-)</b></td>
                            <td rowspan="2" class="text-center" style="background-color: #fafa7d;"><b>TOTAL GAJI</b></td>
                            <td colspan="8" class="text-center" style="background-color: #fafa7d;"><b>JAMSOSTEK (DARI GAJI POKOK)</b></td>
                            <td rowspan="2" class="text-center" style="background-color: #fafa7d;"><b><b>TOTAL TAKE HOME PAY</b></b></td>
                        </tr>
                        <tr>
                            <td class="text-center"><b>Tetap</b></td>
                            <td class="text-center"><b>Transport</b></td>
                            <td class="text-center"><b>Jabatan</b></td>
                            <td class="text-center" style="background-color: #fafa7d;"><b>No.</b></td>
                            <td class="text-center" style="background-color: #fafa7d;"><b>Total</b></td>
                            <td class="text-center" style="background-color: #fafa7d;"><b>Keterangan</b></td>
                            <td class="text-center" style="background-color: #fafa7d;"><b>No.</b></td>
                            <td class="text-center" style="background-color: #fafa7d;"><b>Total</b></td>
                            <td class="text-center" style="background-color: #fafa7d;"><b>Keterangan</b></td>
                            <td class="text-center" style="background-color: #fafa7d;"><b>JKK (0.24%)</b></td>
                            <td class="text-center" style="background-color: #fafa7d;"><b>JKM (0.30%)</b></td>
                            <td class="text-center" style="background-color: #fafa7d;"><b>BPJS (4.0%)</b></td>
                            <td class="text-center" style="background-color: #fafa7d;"><b>JHT (3.7%)</b></td>
                            <td class="text-center" style="background-color: #fafa7d;"><b>JPN (2%)</b></td>
                            <td class="text-center" style="background-color: #fafa7d;"><b>JPN (1%)</b></td>
                            <td class="text-center" style="background-color: #fafa7d;"><b>JHT (2.0%)</b></td>
                            <td class="text-center" style="background-color: #fafa7d;"><b>BPJS (1%)</b></td>
                        </tr>
                    </thead>

                    <tfoot class="class bg-success">
                        <tr>
                            <th colspan="10"></th>
                            <th id="bruto"></th>
                            <th id="gapok"></th>
                            <th id="tunj_tetap"></th>
                            <th id="total_hari"></th>
                            <th id="gaji_pokok"></th>
                            <th id="hari_kerja"></th>
                            <th id="gaji_pokok_efektif"></th>
                            <th id="tunjangan_tetap"></th>
                            <th id="tunjangan_transport"></th>
                            <th id="tunjangan_jabatan"></th>
                            <th id="gaji_bruto"></th>
                            <th id="gaji_perhari"></th>
                            <th id="gaji_setelah_dipotong_hari"></th>
                            <th id="lembur"></th>
                            <th colspan="6"></th>
                            <th id="total_gaji"></th>
                            <th id="jkk_024"></th>
                            <th id="jkm_03"></th>
                            <th id="bpjs_4"></th>
                            <th id="jht_37"></th>
                            <th id="jpn_2"></th>
                            <th id="jpn_1"></th>
                            <th id="jht_2"></th>
                            <th id="bpjs_1"></th>
                            <th id="total_thp"></th>
                        </tr>
                    </tfoot>

                    {{-- <tfoot>
                        <tr>
                            <td style="background-color: #aff2ac;" class="text-center"><b></b></td>
                            <td style="background-color: #aff2ac;" class="text-center"><b></b></td>
                            <td style="background-color: #aff2ac;" class=""><b></b></td>
                            <td style="background-color: #aff2ac;" class=""><b></b></td>
                            <td style="background-color: #aff2ac;" class=""><b></b></td>
                            <td style="background-color: #aff2ac;" class=""><b></b></td>
                            <td style="background-color: #aff2ac;" class=""><b></b></td>
                            <td style="background-color: #aff2ac;" class=""><b></b></td>
                            <td style="background-color: #aff2ac;" class=""><b></b></td>
                            <td style="background-color: #aff2ac;" class="text-center"><b></b></td>
                            <td style="background-color: #aff2ac;" class="text-center"><b></b></td>
                            <td style="background-color: #aff2ac;" class="text-right"><b>7.000.000</b></td>
                            <td style="background-color: #aff2ac;" class="text-right"><b>5.250.000</b></td>
                            <td style="background-color: #aff2ac;" class="text-right"><b>1.750.000</b></td>
                            <td style="background-color: #aff2ac;" class="text-right"><b>21</b></td>
                            <td style="background-color: #aff2ac;" class="text-right"><b>5.20.000</b></td>
                            <td style="background-color: #aff2ac;" class="text-right"><b><b>21</b></b></td>
                            <td style="background-color: #aff2ac;" class="text-right"><b>5.250.000</b></td>
                            <td style="background-color: #aff2ac;" class="text-right"><b>1.750.000</b></td>
                            <td style="background-color: #aff2ac;" class="text-right"><b></b></td>
                            <td style="background-color: #aff2ac;" class="text-right"><b></b></td>
                            <td style="background-color: #aff2ac;" class="text-right"><b>7.000.000</b></td>
                            <td style="background-color: #aff2ac;" class="text-right"><b></b></td>
                            <td style="background-color: #aff2ac;" class="text-right"><b></b></td>
                            <td style="background-color: #aff2ac;" class="text-right"><b></b></td>
                            <td style="background-color: #aff2ac;" class="text-right"><b></b></td>
                            <td style="background-color: #aff2ac;" class="text-right"><b></b></td>
                            <td style="background-color: #aff2ac;" class="text-right"><b></b></td>
                            <td style="background-color: #aff2ac;" class="text-right"><b></b></td>
                            <td style="background-color: #aff2ac;" class="text-right"><b>7.000.000</b></td>
                            <td style="background-color: #aff2ac;" class="text-right"><b>16.800</b></td>
                            <td style="background-color: #aff2ac;" class="text-right"><b>21.000</b></td>
                            <td style="background-color: #aff2ac;" class="text-right"><b>280.000</b></td>
                            <td style="background-color: #aff2ac;" class="text-right"><b>259.000</b></td>
                            <td style="background-color: #aff2ac;" class="text-right"><b>140.000</b></td>
                            <td style="background-color: #aff2ac;" class="text-right"><b>70.000</b></td>
                            <td style="background-color: #aff2ac;" class="text-right"><b>140.000</b></td>
                            <td style="background-color: #aff2ac;" class="text-right"><b>70.000</b></td>
                            <td style="background-color: #aff2ac;" class="text-right"><b>6.720.000</b></td>
                        </tr>
                    </tfoot> --}}
                </table>
            </div>
        </div>
    </div>
</main>

<div class="modal fade" id="modal-popin" tabindex="-1" role="dialog" aria-labelledby="modal-popin" aria-hidden="true">
    <input type="hidden" name="modal-id-gaji">
    <input type="hidden" name="modal-id-karyawan">
    <div class="modal-dialog modal-dialog-popin modal-xl" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Proses Gaji Karyawan : <span id="nama-karyawan"></span></h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div id="hari-kerja-lembur">
                        <div class="form-group row">
                            <label class="col-12">Hari Kerja</label>
                            <div class="col-md-12">
                                <input type="number" class="form-control" name="modal-hari-kerja">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-12">Lembur</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control text-right" name="modal-lembur" placeholder="0">
                            </div>
                        </div>
                        <button class="btn btn-success btn-block" onclick="storePenggajianDetail()">
                            Simpan Data
                        </button>
                    </div>
                    <div class="row">
                        <div class="col-sm-5 mt-3">
                            <hr>
                        </div>
                        <div class="col-sm-2 mt-3 text-center">
                            <p><b>POTONGAN</b></p>
                        </div>
                        <div class="col-sm-5 mt-3">
                            <hr>
                        </div>

                        <div class="col-sm-5 text-center">Total</div>
                        <div class="col-sm-5 text-center">Keterangan</div>
                        <div class="col-sm-2 text-center"></div>

                        <div class="col-sm-5 text-center">
                            <input type="text" class="form-control text-right" name="modal-potongan-total[]"
                                placeholder="0">
                        </div>
                        <div class="col-sm-5 text-center">
                            <input type="text" class="form-control" name="modal-potongan-keterangan[]"
                                placeholder="Keterangan">
                        </div>
                        <div class="col-sm-2 text-center">
                            <button type="button" class="btn btn-sm btn-success" onclick="storePotonganGaji()">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>

                    <div id="potongan-container">
                        {{-- potongan row --}}
                    </div>

                    <div class="row" style="margin-top: 50px;">
                        <div class="col-sm-5">
                            <hr>
                        </div>
                        <div class="col-sm-2 text-center">
                            <p><b>KOREKSI</b></p>
                        </div>
                        <div class="col-sm-5">
                            <hr>
                        </div>

                        <div class="col-sm-5 text-center">Total</div>
                        <div class="col-sm-5 text-center">Keterangan</div>
                        <div class="col-sm-2 text-center"></div>

                        <div class="col-sm-5 text-center">
                            <input type="text" class="form-control text-right" name="modal-koreksi-total"
                                placeholder="0">
                        </div>
                        <div class="col-sm-5 text-center">
                            <input type="text" class="form-control" name="modal-koreksi-keterangan"
                                placeholder="Keterangan">
                        </div>
                        <div class="col-sm-2 text-center">
                            <button type="button" class="btn btn-sm btn-success" onclick="storeKoreksiGaji()">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>

                    <div id="koreksi-container">
                        {{-- koreksi row --}}
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="margin-top: 30px;">
                <button type="button" class="btn btn-primary btn-block" data-dismiss="modal">
                    TUTUP
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
    $(document).ready(function() {
        dataTable();

        $('#modal-popin').on('hidden.bs.modal', function() {
            $(this).find('input').val('');

            $('#potongan-container').html('');
            $('#koreksi-container').html('');

            $('#data-table').DataTable().ajax.reload();
        })

        $("input[name='modal-lembur']").on('input', function() {
            let input = $(this)
            let formattedValue = formatRibuan(input.val())
            input.val(formattedValue)
        })
    })

    function dataTable() {
        $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ $urlDataTable }}",
                type: 'POST'
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
                    name: 'nama',
                    render: function(data, type, row) {
                        var html = `
                            <button onclick="getModalData('${row.id_karyawan}')" class="btn-block">
                                <b>${data}</b>
                            </button>
                        `
                        return html;
                    }
                },
                {
                    data: 'jabatan',
                    name: 'jabatan',
                    class: 'text-center'
                },
                {
                    data: 'divisi_region',
                    name: 'divisi_region',
                    class: 'text-center'
                },
                {
                    data: 'tanggal_lahir',
                    name: 'tanggal_lahir',
                    class: 'text-center'
                },
                {
                    data: 'stat_ptkp',
                    name: 'stat_ptkp',
                    class: 'text-center'
                },
                {
                    data: 'tgl_masuk',
                    name: 'tgl_masuk',
                    class: 'text-center'
                },
                {
                    data: 'tgl_akhir_pkwt',
                    name: 'tgl_akhir_pkwt',
                    class: 'text-center'
                },
                {
                    data: 'rek_final',
                    name: 'rek_final',
                    class: 'text-center'
                },
                {
                    data: 'bruto',
                    name: 'bruto',
                    class: 'text-right',
                    render: function(data, type, row) {
                        return parseInt(data).toLocaleString('id-ID');
                    }
                },
                {
                    data: 'gapok',
                    name: 'gapok',
                    class: 'text-right',
                    render: function(data, type, row) {
                        return parseInt(data).toLocaleString('id-ID');
                    }
                },
                {
                    data: 'tunj_tetap',
                    name: 'tunj_tetap',
                    class: 'text-right',
                    render: function(data, type, row) {
                        return parseInt(data).toLocaleString('id-ID');
                    }
                },
                {
                    data: 'total_hari',
                    name: 'total_hari',
                    class: 'text-center'
                },
                {
                    data: 'gaji_pokok',
                    name: 'gaji_pokok',
                    class: 'text-right',
                    render: function(data, type, row) {
                        return parseInt(data).toLocaleString('id-ID');
                    }
                },
                {
                    data: 'hari_kerja',
                    name: 'hari_kerja',
                    class: 'text-center'
                },
                {
                    data: 'gaji_pokok_efektif',
                    name: 'gaji_pokok_efektif',
                    class: 'text-right',
                    render: function(data, type, row) {
                        return parseInt(data).toLocaleString('id-ID');
                    }
                },
                {
                    data: 'tunjangan_tetap',
                    name: 'tunjangan_tetap',
                    class: 'text-right',
                    render: function(data, type, row) {
                        return parseInt(data).toLocaleString('id-ID');
                    }
                },
                {
                    data: 'tunjangan_transport',
                    name: 'tunjangan_transport',
                    class: 'text-right',
                    render: function(data, type, row) {
                        return parseInt(data).toLocaleString('id-ID');
                    }
                },
                {
                    data: 'tunjangan_jabatan',
                    name: 'tunjangan_jabatan',
                    class: 'text-right',
                    render: function(data, type, row) {
                        return parseInt(data).toLocaleString('id-ID');
                    }
                },
                {
                    data: 'gaji_bruto',
                    name: 'gaji_bruto',
                    class: 'text-right',
                    render: function(data, type, row) {
                        return parseInt(data).toLocaleString('id-ID');
                    }
                },
                {
                    data: 'gaji_perhari',
                    name: 'gaji_perhari',
                    class: 'text-right',
                    render: function(data, type, row) {
                        return parseInt(data).toLocaleString('id-ID');
                    }
                },
                {
                    data: 'gaji_setelah_dipotong_hari',
                    name: 'gaji_setelah_dipotong_hari',
                    class: 'text-right',
                    render: function(data, type, row) {
                        return parseInt(data).toLocaleString('id-ID');
                    }
                },
                {
                    data: 'lembur',
                    name: 'lembur',
                    class: 'text-right',
                    render: function(data, type, row) {
                        return parseInt(data).toLocaleString('id-ID');
                    }
                },
                {
                    data: 'no_potongan',
                    name: 'no_potongan',
                    class: 'text-center',
                    render: function(data, type, row) {
                        if(data !== null) {
                            return data.split(",").join("<br>");
                        } else {
                            return null
                        }
                    }
                },
                {
                    data: 'total_potongan',
                    name: 'total_potongan',
                    class: 'text-right',
                    render: function(data, type, row) {
                        if(data !== null) {
                            return data.split(",").join("<br>");
                        } else {
                            return null
                        }
                    }
                },
                {
                    data: 'keterangan_potongan',
                    name: 'keterangan_potongan',
                    render: function(data, type, row) {
                        if(data !== null) {
                            return data.split(",").join("<br>");
                        } else {
                            return null
                        }
                    }
                },
                {
                    data: 'no_koreksi',
                    name: 'no_koreksi',
                    class: 'text-center',
                    render: function(data, type, row) {
                        if(data !== null) {
                            return data.split(",").join("<br>");
                        } else {
                            return null
                        }
                    }
                },
                {
                    data: 'total_koreksi',
                    name: 'total_koreksi',
                    class: 'text-right',
                    render: function(data, type, row) {
                        if(data !== null) {
                            return data.split(",").join("<br>");
                        } else {
                            return null
                        }
                    }
                },
                {
                    data: 'keterangan_koreksi',
                    name: 'keterangan_koreksi',
                    render: function(data, type, row) {
                        if(data !== null) {
                            return data.split(",").join("<br>");
                        } else {
                            return null
                        }
                    }
                },
                {
                    data: 'total_gaji',
                    name: 'total_gaji',
                    class: 'text-right',
                    render: function(data, type, row) {
                        return parseInt(data).toLocaleString('id-ID');
                    }
                },
                {
                    data: 'jkk_024',
                    name: 'jkk_024',
                    class: 'text-right',
                    render: function(data, type, row) {
                        return parseInt(data).toLocaleString('id-ID');
                    }
                },
                {
                    data: 'jkm_03',
                    name: 'jkm_03',
                    class: 'text-right',
                    render: function(data, type, row) {
                        return parseInt(data).toLocaleString('id-ID');
                    }
                },
                {
                    data: 'bpjs_4',
                    name: 'bpjs_4',
                    class: 'text-right',
                    render: function(data, type, row) {
                        return parseInt(data).toLocaleString('id-ID');
                    }
                },
                {
                    data: 'jht_37',
                    name: 'jht_37',
                    class: 'text-right',
                    render: function(data, type, row) {
                        return parseInt(data).toLocaleString('id-ID');
                    }
                },
                {
                    data: 'jpn_2',
                    name: 'jpn_2',
                    class: 'text-right',
                    render: function(data, type, row) {
                        return parseInt(data).toLocaleString('id-ID');
                    }
                },
                {
                    data: 'jpn_1',
                    name: 'jpn_1',
                    class: 'text-right',
                    render: function(data, type, row) {
                        return parseInt(data).toLocaleString('id-ID');
                    }
                },
                {
                    data: 'jht_2',
                    name: 'jht_2',
                    class: 'text-right',
                    render: function(data, type, row) {
                        return parseInt(data).toLocaleString('id-ID');
                    }
                },
                {
                    data: 'bpjs_1',
                    name: 'bpjs_1',
                    class: 'text-right',
                    render: function(data, type, row) {
                        return parseInt(data).toLocaleString('id-ID');
                    }
                },
                {
                    data: 'total_thp',
                    name: 'total_thp',
                    class: 'text-right',
                    render: function(data, type, row) {
                        return parseInt(data).toLocaleString('id-ID');
                    }
                },
            ],
            footerCallback: function(row, data, start, end, display) {
                var api = this.api();

                var intVal = function(i) {
                    return typeof i === 'string' ?
                        i.replace(/[\Rp,.]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };

                var totalBruto = api.column(10, { page: 'current' }).data().reduce(function(a, b) {
                    console.log(a, b);
                    return intVal(a) + intVal(b);
                }, 0);
                var totalGapok = api.column(11, { page: 'current' }).data().reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                var totalTunjTetap = api.column(12, { page: 'current' }).data().reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                var totalHari = api.column(13, { page: 'current' }).data().reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                var totalGajiPokok = api.column(14, { page: 'current' }).data().reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                var totalHariKerja = api.column(15, { page: 'current' }).data().reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                var totalGajiPokokEfektif = api.column(16, { page: 'current' }).data().reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                var totalTunjTetap = api.column(17, { page: 'current' }).data().reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                var totalTunjTransport = api.column(18, { page: 'current' }).data().reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                var totalTunjJabatan = api.column(19, { page: 'current' }).data().reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                var totalGajiBruto = api.column(20, { page: 'current' }).data().reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                var totalTotalGajiPerhari = api.column(21, { page: 'current' }).data().reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                var totalGajiSetelahDipotongHari = api.column(22, { page: 'current' }).data().reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                var totalLembur = api.column(23, { page: 'current' }).data().reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                var totalTotalGaji = api.column(30, { page: 'current' }).data().reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                var totalJkk024 = api.column(31, { page: 'current' }).data().reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                var totalJkm03 = api.column(32, { page: 'current' }).data().reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                var totalBpjs4 = api.column(33, { page: 'current' }).data().reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                var totalJht37 = api.column(34, { page: 'current' }).data().reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                var totalJpn2 = api.column(35, { page: 'current' }).data().reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                var totalJpn1 = api.column(36, { page: 'current' }).data().reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                var totalJht2 = api.column(37, { page: 'current' }).data().reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                var totalBpjs1 = api.column(38, { page: 'current' }).data().reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);
                var total_THP = api.column(39, { page: 'current' }).data().reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

                $('#bruto').html(totalBruto.toLocaleString('id-ID'));
                $('#gapok').html(totalGapok.toLocaleString('id-ID'));
                $('#tunj_tetap').html(totalTunjTetap.toLocaleString('id-ID'));
                $('#total_hari').html(totalHari);
                $('#hari_kerja').html(totalHariKerja);
                $('#gaji_pokok').html(totalGajiPokok.toLocaleString('id-ID'));
                $('#gaji_pokok_efektif').html(totalGajiPokokEfektif.toLocaleString('id-ID'));
                $('#tunjangan_tetap').html(totalTunjTetap.toLocaleString('id-ID'));
                $('#tunjangan_transport').html(totalTunjTransport.toLocaleString('id-ID'));
                $('#tunjangan_jabatan').html(totalTunjJabatan.toLocaleString('id-ID'));
                $('#gaji_bruto').html(totalGajiBruto.toLocaleString('id-ID'));
                $('#lembur').html(totalLembur.toLocaleString('id-ID'));
                $('#gaji_perhari').html(totalTotalGajiPerhari.toLocaleString('id-ID'));
                $('#gaji_setelah_dipotong_hari').html(totalGajiSetelahDipotongHari.toLocaleString('id-ID'));
                $('#total_gaji').html(totalTotalGaji.toLocaleString('id-ID'));
                $('#jkk_024').html(totalJkk024.toLocaleString('id-ID'));
                $('#jkm_03').html(totalJkm03.toLocaleString('id-ID'));
                $('#bpjs_4').html(totalBpjs4.toLocaleString('id-ID'));
                $('#jht_37').html(totalJht37.toLocaleString('id-ID'));
                $('#jpn_2').html(totalJpn2.toLocaleString('id-ID'));
                $('#jpn_1').html(totalJpn1.toLocaleString('id-ID'));
                $('#jht_2').html(totalJht2.toLocaleString('id-ID'));
                $('#bpjs_1').html(totalBpjs1.toLocaleString('id-ID'));
                $('#total_thp').html(total_THP.toLocaleString('id-ID'));
            }
        });
    }

    function getModalData(id) {
        $.ajax({
            url: "{{ url('gaji/modal-data') }}/" + id,
            type: 'GET',
            success: function(data) {
                $('#modal-popin').modal('show');
                $('input[name="modal-id-gaji"]').val(data.employee.id_gaji);
                $('input[name="modal-id-karyawan"]').val(data.employee.id_karyawan);
                $('#nama-karyawan').text(data.employee.nama);
                $('input[name="modal-hari-kerja"]').val(data.employee.hari_kerja);
                $('input[name="modal-lembur"]').val(data.employee.lembur.toLocaleString('id-ID'));
                loadDataPotongan(data.employee.potongan_gajis);
                loadKoreksi(data.employee.koreksi_gajis);

                console.log('input[name="modal-lembur"]', $('input[name="modal-lembur"]').val());
            }
        })

        $('input[name="modal-potongan-total[]"]').on('input', function() {
            let input = $(this)
            let formattedValue = formatRibuan(input.val())
            input.val(formattedValue)
        })

        $('input[name="modal-koreksi-total"]').on('input', function() {
            let input = $(this)
            let formattedValue = formatRibuan(input.val())
            input.val(formattedValue)
        })
    }

    function loadDataPotongan(data) {
        $('#potongan-container').html('');

        data.forEach(function(item) {
            let newRow = `
                <div class="row potongan-row mt-2">
                    <div class="col-sm-5 text-center">
                        <input type="text" class="form-control text-right" name="total[]" value="${item.total}" placeholder="0" readonly>
                    </div>
                    <div class="col-sm-5 text-center">
                        <input type="text" class="form-control" name="keterangan[]" value="${item.keterangan}" placeholder="Keterangan" readonly>
                    </div>
                    <div class="col-sm-2 text-center">
                        <button type="button" class="btn btn-sm btn-danger btn-remove" onclick="deletePotonganGaji('${item.id}')">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                </div>
            `
            $('#potongan-container').append(newRow);
        })

        $('input[name="total[]"]').each(function() {
            let input = $(this)
            let formattedValue = formatRibuan(input.val())
            input.val(formattedValue)
        })
    }

    function loadKoreksi(data) {
        $('#koreksi-container').html('');

        data.forEach(function(item) {
            let newRow = `
                <div class="row koreksi-row mt-2">
                    <div class="col-sm-5 text-center">
                        <input type="number" class="form-control text-right" name="total[]" value="${item.total}" placeholder="0" readonly>
                    </div>
                    <div class="col-sm-5 text-center">
                        <input type="text" class="form-control" name="keterangan[]" value="${item.keterangan}" placeholder="Keterangan" readonly>
                    </div>
                    <div class="col-sm-2 text-center">
                        <button type="button" class="btn btn-sm btn-danger btn-remove" onclick="deleteKoreksiGaji('${item.id}')">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                </div>
            `
            $('#koreksi-container').append(newRow);
        })

        $('input[name="total[]"]').each(function() {
            let input = $(this)
            let formattedValue = formatRibuan(input.val())
            input.val(formattedValue)
        })
    }

    function storePotonganGaji() {
        $.ajax({
            url: "{{ url('gaji/add-potongan') }}",
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                id_gaji: $('input[name="modal-id-gaji"]').val(),
                id_karyawan: $('input[name="modal-id-karyawan"]').val(),
                total: $('input[name="modal-potongan-total[]"]').val(),
                keterangan: $('input[name="modal-potongan-keterangan[]"]').val()
            },
            success: function(data) {
                loadDataPotongan(data.data);
            }
        })
    }

    function storeKoreksiGaji() {
        $.ajax({
            url: "{{ url('gaji/add-koreksi') }}",
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                id_gaji: $('input[name="modal-id-gaji"]').val(),
                id_karyawan: $('input[name="modal-id-karyawan"]').val(),
                total: $('input[name="modal-koreksi-total"]').val(),
                keterangan: $('input[name="modal-koreksi-keterangan"]').val()
            },
            success: function(data) {
                loadKoreksi(data.data);
            }
        })
    }

    function deletePotonganGaji(id_potongan) {
        $.ajax({
            url: "{{ url('gaji/delete-potongan') }}",
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                id_potongan: id_potongan,
                id_gaji: $('input[name="modal-id-gaji"]').val(),
                id_karyawan: $('input[name="modal-id-karyawan"]').val()
            },
            success: function(data) {
                loadDataPotongan(data.data);
            }
        })
    }

    function deleteKoreksiGaji(id_koreksi) {
        $.ajax({
            url: "{{ url('gaji/delete-koreksi') }}",
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                id_koreksi: id_koreksi,
                id_gaji: $('input[name="modal-id-gaji"]').val(),
                id_karyawan: $('input[name="modal-id-karyawan"]').val()
            },
            success: function(data) {
                loadKoreksi(data.data);
            }
        })
    }

    function storePenggajianDetail() {
        $.ajax({
            url: "{{ url('gaji/store-detail') }}",
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                id_gaji: $('input[name="modal-id-gaji"]').val(),
                id_karyawan: $('input[name="modal-id-karyawan"]').val(),
                hari_kerja: $('input[name="modal-hari-kerja"]').val(),
                lembur: $('input[name="modal-lembur"]').val()
            },
            success: function(data) {
                $('#modal-popin').modal('hide');
                $('#data-table').DataTable().ajax.reload();
            }
        })
    }
</script>
@endsection