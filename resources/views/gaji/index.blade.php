@extends('layouts.main')
@section('content')
<main class="main">
    <div class="content">
        <div class="row">
            <div class="col-md-6">
                <h5><b>Data Arsip Gaji Karyawan</b></h5>
            </div>
            <div class="col-md-6 text-right">
                <button class="btn btn-success text-left" data-toggle="modal" data-target="#modal-popin">
                    <i class="fa fa-exclamation-circle mr-5"></i>Proses Gaji Karyawan
                </button>
            </div>
        </div>

        <div class="block">
            <div class="block-content block-content-full">
                <table class="table table-bordered table-striped table-vcenter js-datatable-full">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Periode</th>
                            <th class="text-center">Waktu Proses</th>
                            <th class="text-center">Nama User</th>
                            <th class="text-center">Total THP</th>
                            <th class="text-center"><i class="fa fa-gear"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gajis as $gaji)
                        <tr>
                            <td class="text-center">{{ $loop->index + 1 }}</td>
                            <td class="text-center">{{ $gaji->periode }}</td>
                            <td class="text-center">
                                {{ Carbon\Carbon::parse($gaji->waktu_proses)->format('d M Y H:i:s') }}
                            </td>
                            <td class="text-center">{{ $gaji->nama_user }}</td>
                            <td class="text-center">{{ $gaji->total_thp ?? 'BELUM DIHITUNG' }}</td>
                            <td class="text-center">
                                <a href="{{ route('gaji.detail', $gaji->id) }}" class="btn btn-sm btn-info">
                                    <i class="fa fa-file"></i>
                                </a> |
                                <a href="{{ route('gaji.print-excel', $gaji->id) }}" class="btn btn-sm btn-success"
                                    target="_blank">
                                    <i class="fa fa-print"></i>
                                </a> |
                                <a href="{{ route('gaji.print-pdf', $gaji->id) }}" class="btn btn-sm btn-danger"
                                    target="_blank">
                                    <i class="fa fa-print"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>


{{-- modal --}}
<div class="modal fade" id="modal-popin" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-popin" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Proses Gaji Karyawan</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="form-group row">
                        <label class="col-12">Periode</label>
                        <div class="col-md-12">
                            <input type="text" class="form-control" name=""
                                value="{{ Carbon\Carbon::now()->locale('id')->translatedFormat('F Y') }}" disabled>
                        </div>
                    </div>
                    @if (Carbon\Carbon::now()->format('d') < 20) <div class="form-group row">
                        <label class="col-12 text-danger">*Gaji hanya dapat di proses setelah tanggal 20</label>
                </div>
                @endif
                <div class="form-group row">
                    <div class="col-md-12">
                        <div class="progress push">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                style="width: {{ $progressPercentage }}%;" aria-valuenow="{{ $progressPercentage }}"
                                aria-valuemin="0" aria-valuemax="100">
                                <span class="progress-bar-label">{{ round($progressPercentage) }}%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form action="{{ route('gaji.create-gaji') }}" method="post" class="modal-footer">
            @csrf
            <button type="submit" class="btn btn-primary btn-block" {{ $progressPercentage < 100 ? 'disabled' : '' }}>
                PROSES DATA
            </button>
        </form>
    </div>
</div>
</div>
@endsection