<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" id="css-main" href="{{ asset('css/codebase.css') }}">

    <style>
        @media print {

            @page {
                size: A3 landscape;
                max-height: 100%;
                max-width: 100%
            }

            body {
                width: 100%;
                height: 100%;
            }
        }

        table {
            border-collapse: collapse;
            width: 100%;
            font-size: 3pt;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
        }
    </style>

</head>

<body>
    <div class="text-center">
        <h5>PERIODE 21 {{ strtoupper($bulanStart) }} - {{ strtoupper($tanggalEnd) }}</h5>
    </div>
    <div class="mb-3">
        <label class="text-danger"><b>Subsidiary :</b></label> <label><b> PT. INTERNASIONAL ASIA PRIMA
                SUKSES</b></label>
    </div>

    <table class="table table-bordered table-striped table-vcenter" id="data-table">
        <thead>
            <tr>
                <td rowspan="2" class="text-center">No.</td>
                <td rowspan="2" class="text-center">NIK</td>
                <td rowspan="2" class="text-center">Nama</td>
                <td rowspan="2" class="text-center">Jabatan</td>
                <td rowspan="2" class="text-center">Divisi / Cabang</td>
                <td rowspan="2" class="text-center">Tgl Lahir</td>
                <td rowspan="2" class="text-center">Status Kel.</td>
                <td rowspan="2" class="text-center">Tanggal Masuk</td>
                <td rowspan="2" class="text-center">Tanggal Akhir PKWT
                </td>
                {{-- <td rowspan="2" class="text-center">Bank</td> --}}
                <td rowspan="2" class="text-center">Rekening</td>
                <td rowspan="2" class="text-center">Bruto</td>
                <td rowspan="2" class="text-center">Gapok</td>
                <td rowspan="2" class="text-center">Tunj. Tetap</td>
                <td rowspan="2" class="text-center">Total Hari</td>
                <td rowspan="2" class="text-center">GAJI POKOK</td>
                <td rowspan="2" class="text-center"><b>HARI KERJA</b>
                </td>
                <td rowspan="2" class="text-center">GAJI POKOK EFEKTIF</td>
                <td colspan="3" class="text-center">TUNJANGAN</td>
                <td rowspan="2" class="text-center">GAJI BRUTO</td>
                <td rowspan="2" class="text-center">GAJI PERHARI</td>
                <td rowspan="2" class="text-center">GAJI SETELAH DIPOTONG HARI</td>
                <td rowspan="2" class="text-center">LEMBUR, ROLLING, DLL
                </td>
                <td colspan="3" class="text-center">POTONGAN</td>
                <td colspan="3" class="text-center">KOREKSI (+/-)</td>
                <td rowspan="2" class="text-center">TOTAL GAJI</td>
                <td colspan="8" class="text-center">JAMSOSTEK (DARI GAJI
                    POKOK)</td>
                <td rowspan="2" class="text-center"><b>TOTAL TAKE HOME
                        PAY</b></td>
            </tr>
            <tr>
                <td class="text-center">Tetap</td>
                <td class="text-center">Transport</td>
                <td class="text-center">Jabatan</td>
                <td class="text-center">No.</td>
                <td class="text-center">Total</td>
                <td class="text-center">Keterangan</td>
                <td class="text-center">No.</td>
                <td class="text-center">Total</td>
                <td class="text-center">Keterangan</td>
                <td class="text-center">JKK (0.24%)</td>
                <td class="text-center">JKM (0.30%)</td>
                <td class="text-center">BPJS (4.0%)</td>
                <td class="text-center">JHT (3.7%)</td>
                <td class="text-center">JPN (2%)</td>
                <td class="text-center">JPN (1%)</td>
                <td class="text-center">JHT (2.0%)</td>
                <td class="text-center">BPJS (1%)</td>
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
                <th id="gaji_perhari"></th>
                <th id="gaji_setelah_dipotong_hari"></th>
                <th id="gaji_bruto"></th>
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
    </table>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script>
        console.log('{{ $urlDataTable }}');

        $(document).ready(function() {
            console.log('ready');

            dataTable();
        })

        function dataTable() {
            $('#data-table').DataTable({
                processing: false,
                serverSide: true,
                paging: false,
                info: false,
                searching: false,
                lengthChange: false,
                ordering: false,
                ajax: {
                    url: "{{ $urlDataTable }}",
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    }
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
                    },
                    {
                        data: 'jabatan',
                        name: 'jabatan'
                    },
                    {
                        data: 'divisi_region',
                        name: 'divisi_region'
                    },
                    {
                        data: 'tanggal_lahir',
                        name: 'tanggal_lahir'
                    },
                    {
                        data: 'stat_ptkp',
                        name: 'stat_ptkp'
                    },
                    {
                        data: 'tgl_masuk',
                        name: 'tgl_masuk'
                    },
                    {
                        data: 'tgl_akhir_pkwt',
                        name: 'tgl_akhir_pkwt'
                    },
                    {
                        data: 'rek_final',
                        name: 'rek_final'
                    },
                    {
                        data: 'bruto',
                        name: 'bruto',
                        render: function(data, type, row) {
                            return 'Rp ' + parseInt(data).toLocaleString('id-ID');
                        }
                    },
                    {
                        data: 'gapok',
                        name: 'gapok',
                        render: function(data, type, row) {
                            return 'Rp ' + parseInt(data).toLocaleString('id-ID');
                        }
                    },
                    {
                        data: 'tunj_tetap',
                        name: 'tunj_tetap',
                        render: function(data, type, row) {
                            return 'Rp ' + parseInt(data).toLocaleString('id-ID');
                        }
                    },
                    {
                        data: 'total_hari',
                        name: 'total_hari'
                    },
                    {
                        data: 'gaji_pokok',
                        name: 'gaji_pokok',
                        render: function(data, type, row) {
                            return 'Rp ' + parseInt(data).toLocaleString('id-ID');
                        }
                    },
                    {
                        data: 'hari_kerja',
                        name: 'hari_kerja'
                    },
                    {
                        data: 'gaji_pokok_efektif',
                        name: 'gaji_pokok_efektif',
                        render: function(data, type, row) {
                            return 'Rp ' + parseInt(data).toLocaleString('id-ID');
                        }
                    },
                    {
                        data: 'tunjangan_tetap',
                        name: 'tunjangan_tetap',
                        render: function(data, type, row) {
                            return 'Rp ' + parseInt(data).toLocaleString('id-ID');
                        }
                    },
                    {
                        data: 'tunjangan_transport',
                        name: 'tunjangan_transport',
                        render: function(data, type, row) {
                            return 'Rp ' + parseInt(data).toLocaleString('id-ID');
                        }
                    },
                    {
                        data: 'tunjangan_jabatan',
                        name: 'tunjangan_jabatan',
                        render: function(data, type, row) {
                            return 'Rp ' + parseInt(data).toLocaleString('id-ID');
                        }
                    },
                    {
                        data: 'gaji_bruto',
                        name: 'gaji_bruto',
                        render: function(data, type, row) {
                            return 'Rp ' + parseInt(data).toLocaleString('id-ID');
                        }
                    },
                    {
                        data: 'gaji_perhari',
                        name: 'gaji_perhari',
                        render: function(data, type, row) {
                            return 'Rp ' + parseInt(data).toLocaleString('id-ID');
                        }
                    },
                    {
                        data: 'gaji_setelah_dipotong_hari',
                        name: 'gaji_setelah_dipotong_hari',
                        render: function(data, type, row) {
                            return 'Rp ' + parseInt(data).toLocaleString('id-ID');
                        }
                    },
                    {
                        data: 'lembur',
                        name: 'lembur',
                        render: function(data, type, row) {
                            return 'Rp ' + parseInt(data).toLocaleString('id-ID');
                        }
                    },
                    {
                        data: 'no_potongan',
                        name: 'no_potongan',
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
                        render: function(data, type, row) {
                            return 'Rp ' + parseInt(data).toLocaleString('id-ID');
                        }
                    },
                    {
                        data: 'jkk_024',
                        name: 'jkk_024',
                        render: function(data, type, row) {
                            return 'Rp ' + parseInt(data).toLocaleString('id-ID');
                        }
                    },
                    {
                        data: 'jkm_03',
                        name: 'jkm_03',
                        render: function(data, type, row) {
                            return 'Rp ' + parseInt(data).toLocaleString('id-ID');
                        }
                    },
                    {
                        data: 'bpjs_4',
                        name: 'bpjs_4',
                        render: function(data, type, row) {
                            return 'Rp ' + parseInt(data).toLocaleString('id-ID');
                        }
                    },
                    {
                        data: 'jht_37',
                        name: 'jht_37',
                        render: function(data, type, row) {
                            return 'Rp ' + parseInt(data).toLocaleString('id-ID');
                        }
                    },
                    {
                        data: 'jpn_2',
                        name: 'jpn_2',
                        render: function(data, type, row) {
                            return 'Rp ' + parseInt(data).toLocaleString('id-ID');
                        }
                    },
                    {
                        data: 'jpn_1',
                        name: 'jpn_1',
                        render: function(data, type, row) {
                            return 'Rp ' + parseInt(data).toLocaleString('id-ID');
                        }
                    },
                    {
                        data: 'jht_2',
                        name: 'jht_2',
                        render: function(data, type, row) {
                            return 'Rp ' + parseInt(data).toLocaleString('id-ID');
                        }
                    },
                    {
                        data: 'bpjs_1',
                        name: 'bpjs_1',
                        render: function(data, type, row) {
                            return 'Rp ' + parseInt(data).toLocaleString('id-ID');
                        }
                    },
                    {
                        data: 'total_thp',
                        name: 'total_thp',
                        render: function(data, type, row) {
                            return 'Rp ' + parseInt(data).toLocaleString('id-ID');
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

                    $('#bruto').html('Rp ' + totalBruto.toLocaleString('id-ID'));
                    $('#gapok').html('Rp ' + totalGapok.toLocaleString('id-ID'));
                    $('#tunj_tetap').html('Rp ' + totalTunjTetap.toLocaleString('id-ID'));
                    $('#total_hari').html(totalHari);
                    $('#hari_kerja').html(totalHariKerja);
                    $('#gaji_pokok').html('Rp ' + totalGajiPokok.toLocaleString('id-ID'));
                    $('#gaji_pokok_efektif').html('Rp ' + totalGajiPokokEfektif.toLocaleString('id-ID'));
                    $('#tunjangan_tetap').html('Rp ' + totalTunjTetap.toLocaleString('id-ID'));
                    $('#tunjangan_transport').html('Rp ' + totalTunjTransport.toLocaleString('id-ID'));
                    $('#tunjangan_jabatan').html('Rp ' + totalTunjJabatan.toLocaleString('id-ID'));
                    $('#gaji_bruto').html('Rp ' + totalGajiBruto.toLocaleString('id-ID'));
                    $('#lembur').html('Rp ' + totalLembur.toLocaleString('id-ID'));
                    $('#gaji_perhari').html('Rp ' + totalTotalGajiPerhari.toLocaleString('id-ID'));
                    $('#gaji_setelah_dipotong_hari').html('Rp ' + totalGajiSetelahDipotongHari.toLocaleString('id-ID'));
                    $('#total_gaji').html('Rp ' + totalTotalGaji.toLocaleString('id-ID'));
                    $('#jkk_024').html('Rp ' + totalJkk024.toLocaleString('id-ID'));
                    $('#jkm_03').html('Rp ' + totalJkm03.toLocaleString('id-ID'));
                    $('#bpjs_4').html('Rp ' + totalBpjs4.toLocaleString('id-ID'));
                    $('#jht_37').html('Rp ' + totalJht37.toLocaleString('id-ID'));
                    $('#jpn_2').html('Rp ' + totalJpn2.toLocaleString('id-ID'));
                    $('#jpn_1').html('Rp ' + totalJpn1.toLocaleString('id-ID'));
                    $('#jht_2').html('Rp ' + totalJht2.toLocaleString('id-ID'));
                    $('#bpjs_1').html('Rp ' + totalBpjs1.toLocaleString('id-ID'));
                    $('#total_thp').html('Rp ' + total_THP.toLocaleString('id-ID'));
                },
                initComplete: function(settings, json) {
                    window.print();
                },
            });
        }
    </script>

</body>


</html>
