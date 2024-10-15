@extends('layouts.main')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-6">
            <h5><b>Detail Data Karyawan</b></h5>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('data_karyawan.index') }}" type="button" class="btn btn-success text-left" data-toggle="tooltip" data-placement="top" data-title="Kembali">
                <i class="fa fa-backward"></i>
            </a>
        </div>
    </div>

    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Data Pribadi</h3>
        </div>
        <div class="block-content block-content-full row">
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-12">NIK</label>
                    <div class="col-md-12">
                        <input type="text" class="form-control" name="" placeholder="0" value="{{ $data->nik }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">No. KTP <span class="text-danger">*</span></label>
                    <div class="col-md-12">
                        <input type="number" class="form-control" name="" placeholder="0" value="{{ $data->ktp }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">No. KK <span class="text-danger">*</span></label>
                    <div class="col-md-12">
                        <input type="number" class="form-control" name="" placeholder="0" value="{{ $data->no_kk }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Nama Lengkap <span class="text-danger">*</span></label>
                    <div class="col-md-12">
                        <input type="text" class="form-control" name="" placeholder="Nama Lengkap" value="{{ $data->nama }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Tempat, Tanggal Lahir <span class="text-danger">*</span></label>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="" placeholder="Tempat Lahir" value="{{ $data->tempat_lahir }}">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="" value="{{ $data->tanggal_lahir }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Nama Ibu Kandung</label>
                    <div class="col-md-12">
                        <input type="text" class="form-control" name="" placeholder="{{ $data->ibu_kandung }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Jenis Kelamin <span class="text-danger">*</span></label>
                    <div class="col-md-12">
                        <select class="form-control" name="">
                            <option value="Laki-Laki" {{ $data->jenis_kelamin == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                            <option value="Perempuan" {{ $data->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Golongan Darah</label>
                    <div class="col-md-12">
                        <select class="form-control" name="">
                            <option value="AB" {{ $data->gol_darah == 'AB' ? 'selected' : '' }}>AB</option>
                            <option value="A" {{ $data->gol_darah == 'A' ? 'selected' : '' }}>A</option>
                            <option value="B" {{ $data->gol_darah == 'B' ? 'selected' : '' }}>B</option>
                            <option value="O" {{ $data->gol_darah == 'O' ? 'selected' : '' }}>O</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Agama <span class="text-danger">*</span></label>
                    <div class="col-md-12">
                        <select class="form-control" name="">
                            <option value="ISLAM" {{ $data->agama == 'ISLAM' ? 'selected' : '' }}>ISLAM</option>
                            <option value="BUDHA" {{ $data->agama == 'BUDHA' ? 'selected' : '' }}>BUDHA</option>
                            <option value="HINDU" {{ $data->agama == 'HINDU' ? 'selected' : '' }}>HINDU</option>
                            <option value="KRISTEN" {{ $data->agama == 'KRISTEN' ? 'selected' : '' }}>KRISTEN</option>
                            <option value="KATOLIK" {{ $data->agama == 'KATOLIK' ? 'selected' : '' }}>KATOLIK</option>
                            <option value="KONGHUCU" {{ $data->agama == 'KONGHUCU' ? 'selected' : '' }}>KONGHUCU</option>
                        </select>
                    </div>
                </div>
            </div>


            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-12">NPWP</label>
                    <div class="col-md-12">
                        <input type="text" class="form-control" name="" placeholder="0" value="{{ $data->npwp }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-12">No. Handphone 1 <span class="text-danger">*</span></label>
                            <div class="col-md-12">
                                <input type="number" class="form-control" name="" placeholder="0" value="{{ $data->no_hp }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-12">No. Handphone 2</label>
                            <div class="col-md-12">
                                <input type="number" class="form-control" name="" placeholder="0">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">No. Telepon</label>
                    <div class="col-md-12">
                        <input type="number" class="form-control" name="" placeholder="0">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Nama Lembaga Pendidikan</label>
                    <div class="col-md-12">
                        <input type="text" class="form-control" name="" placeholder="Nama Lembaga Pendidikan" value="{{ $data->nama_lembaga }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-12">Tingkat Pendidikan</label>
                            <div class="col-md-12">
                                <select class="form-control" name="">
                                    <option value="D3/D4" {{ $data->tingkat_pendidikan == 'D3' | $data->tingkat_pendidikan == 'D4' ? 'selected' : '' }}>D3/D4</option>
                                    <option value="SMA" {{ $data->tingkat_pendidikan == 'SMA' ? 'selected' : '' }}>SMA</option>
                                    <option value="Sarjana (S1)" {{ $data->tingkat_pendidikan == 'S1' ? 'selected' : '' }}>Sarjana (S1)</option>
                                    <option value="Magister (S2)" {{ $data->tingkat_pendidikan == 'S2' ? 'selected' : '' }}>Magister (S2)</option>
                                    <option value="Doktor (S3)" {{ $data->tingkat_pendidikan == 'S3' ? 'selected' : '' }}>Doktor (S3)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-12">Jurusan Pendidikan</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="" placeholder="Jurusan Pendidikan" value="{{ $data->jurusan }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Email Pribadi</label>
                    <div class="col-md-12">
                        <input type="email" class="form-control" name="" value="{{ $data->email_pribadi }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Email Perusahaan</label>
                    <div class="col-md-12">
                        <input type="email" class="form-control" name="" value="{{ $data->email_perusahaan }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Alamat KTP <span class="text-danger">*</span></label>
                    <div class="col-12">
                        <textarea class="form-control" name="" rows="5" placeholder="Alamat KTP">{{ $data->alamat_ktp }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-6">Alamat Domisili <span class="text-danger">*</span></label>
                    <div class="col-12">
                        <textarea class="form-control" name="" rows="5" placeholder="Alamat Domisili" disabled>{{ $data->alamat_domisili ?? $data->alamat_ktp }}</textarea>
                        <label class="css-control css-control-sm css-control-primary css-switch">
                            <input type="checkbox" class="css-control-input" {{ !$data->alamat_domisili ? 'checked' : '' }}>
                            <span class="css-control-indicator"></span><span style="font-size:10px">Jika Sama Dengan Alamat KTP</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Data Perusahaan </h3>
        </div>
        <div class="block-content block-content-full row">
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-12">Divisi / Cabang <span class="text-danger">*</span></label>
                    <div class="col-md-12">
                        <input type="text" class="form-control" name="" placeholder="Divisi / Cabang" value="{{ $data->divisi_region }} / {{ $data->kantor_cab }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Status <span class="text-danger">*</span></label>
                    <div class="col-md-12">
                        <select class="form-control" name="">
                            <option value="BEKERJA" {{ $data->status == 'AKTIF' ? 'selected' : '' }}>BEKERJA</option>
                            <option value="RESIGN" {{ $data->status == 'TIDAK AKTIF' ? 'selected' : '' }}>RESIGN</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Status Karyawan<span class="text-danger">*</span></label>
                    <div class="col-md-12">
                        <select class="form-control" name="">
                            <option value="KONTRAK" {{ $data->status_karyawan == 'KONTRAK' ? 'selected' : '' }}>KONTRAK</option>
                            <option value="TETAP" {{ $data->status_karyawan == 'TETAP' ? 'selected' : '' }}>TETAP</option>
                            <option value="PKHL" {{ $data->status_karyawan == 'PKHL' ? 'selected' : '' }}>PKHL</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-12">Jabatan Awal <span class="text-danger">*</span></label>
                            <div class="col-md-12">
                                <input type="text" name="" class="form-control" placeholder="Jabatan Awal" value="{{ $data->jabatan_awal }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-12">Jabatan Sekarang</label>
                            <div class="col-md-12">
                                <input type="text" name="" class="form-control" placeholder="Jabatan Sekarang" value="{{ $data->jabatan_sekarang }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Direcy / Indirect</label>
                    <div class="col-md-12">
                        <select class="form-control" name="">
                            <option value="DIRECT" {{ $data->dirin == 'DIRECT' ? 'selected' : '' }}>DIRECT</option>
                            <option value="INDIRECT" {{ $data->dirin == 'INDIRECT' ? 'selected' : '' }}>INDIRECT</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Status Golongan</label>
                    <div class="col-md-12">
                        <select class="form-control" name="">
                            <option value="Staff" {{ $data->status_gol == 'Staff' ? 'selected' : '' }}>Staff</option>
                            <option value="Senior Staff" {{ $data->status_gol == 'Senior Staff' ? 'selected' : '' }}>Senior Staff</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-12">Tgl Join</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="" placeholder="0" value="{{ $data->tgl_join }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-12">Tgl Akhir Kontrak</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="" placeholder="0" value="{{ $data->tgl_akhir_kontrak ?? 'Tetap' }}">
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="form-group row">
                    <label class="col-12">Masa Kerja</label>
                    <div class="col-md-12">
                        <input type="text" class="form-control" name="" value="3 Bulan" disabled>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">PKWT</label>
                    <div class="col-md-12">
                        <input type="number" class="form-control" name="" placeholder="0" value="1">
                    </div>
                </div> --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-12">Start</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="" value="{{ $data->start_pkwt }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-12">End</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="" value="{{ $data->end_pkwt }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-12">No. SK Tetap</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="" placeholder="0" {{ $data->sk_tetap }}>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-12">Tgl SK Tetap</label>
                            <div class="col-md-12">
                                <input type="date" class="form-control" name="" {{ $data->tgl_sk_tetap }}>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Status PTKP</label>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <select class="form-control" name="">
                                    <option value="">Please select</option>
                                    <option value="K">K</option>
                                    <option value="TK">TK</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <input type="number" class="form-control" name="" placeholder="0">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">No. Rekening A/N</label>
                    <div class="col-md-12">
                        <input type="number" class="form-control" name="" placeholder="0" value="{{ $data->pem_rek }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-12">Nama Bank</label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="" value="MANDIRI" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-12">No. Rekening</label>
                            <div class="col-md-12">
                                <input type="number" class="form-control" name="" placeholder="0" value="{{ $data->rek_mandiri }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">No. Jamsostek</label>
                    <div class="col-md-12">
                        <input type="number" class="form-control" name="" placeholder="0" value="{{ $data->bpjstk }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">No. BPJS Kesehatan</label>
                    <div class="col-md-12">
                        <input type="number" class="form-control" name="" placeholder="0" value="{{ $data->bpjskes }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-12">Tanggal Resign</label>
                    <div class="col-md-12">
                        <input type="date" class="form-control" name="">
                    </div>
                </div>
                <div class="form-group row text-danger">
                    <label class="col-12"><b>Gaji Pokok</b></label>
                    <div class="col-md-12">
                        <b><input type="text" class="form-control" name="" value="Rp {{ number_format($data->gaji_pokok, 0, ',', '.') }}"></b>
                    </div>
                </div>
                <div class="form-group row text-danger">
                    <label class="col-12"><b>Tunjangan Tetap</b></label>
                    <div class="col-md-12">
                        <b><input type="text" class="form-control" name="" value="Rp {{ number_format($data->tunjangan, 0, ',', '.') }}"></b>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });
    </script>
@endsection