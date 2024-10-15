@extends('layouts.main')
@section('content')
<div class="content">
    <div class="row gutters-tiny invisible" data-toggle="appear">
        <div class="col-6 col-md-4 col-xl-4">
            <a class="block text-center" href="#">
                <div class="block-content ribbon ribbon-bookmark ribbon-crystal ribbon-left bg-gd-dusk rounded">
                    <div class="ribbon-box">750</div>
                    <p class="mt-5">
                        <i class="fa fa-users fa-4x text-white-op"></i>
                    </p>
                    <p class="font-w600 text-white"><b>JUMLAH KARYAWAN</b></p>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-4 col-xl-4">
            <a class="block text-center" href="#">
                <div class="block-content ribbon ribbon-bookmark ribbon-crystal ribbon-left bg-gd-primary rounded">
                    <div class="ribbon-box">550</div>
                    <p class="mt-5">
                        <i class="fa fa-address-card-o fa-4x text-white-op"></i>
                    </p>
                    <p class="font-w600 text-white"><b>JUMLAH KARYAWAN PKWT</b></p>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-4 col-xl-4">
            <a class="block text-center" href="#">
                <div class="block-content ribbon ribbon-bookmark ribbon-crystal ribbon-left bg-gd-sea rounded">
                    <div class="ribbon-box">200</div>
                    <p class="mt-5">
                        <i class="fa fa-address-card fa-4x text-white-op"></i>
                    </p>
                    <p class="font-w600 text-white"><b>JUMLAH KARYAWAN TETAP</b></p>
                </div>
            </a>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6 col-xl-6">
            <div class="block">
                <div class="block-content block-content-full text-center bg-gd-sun rounded block-sticky-options">
                    <div class="block-options">
                        <div class="block-options-item">
                            <i class="fa fa-spinner fa-spin fa-3x text-white-op"></i>
                        </div>
                    </div>
                    <div class="p-20 mb-10">
                        <i class="fa fa-3x fa-building text-white-op"></i>
                    </div>
                    <p class="font-size-lg font-w600 text-white mb-0">
                        Manage Branch
                    </p>
                </div>
                <div class="block-content block-content-full">
                    <table class="table table-borderless table-striped table-hover mb-0">
                        <tbody>
                            <tr>
                                <td class="text-center" style="width: 40px;">01</td>
                                <td>
                                    <strong>HO IAPS</strong>
                                </td>
                                <td>
                                    <strong>Jakarta</strong>
                                </td>
                                <td class="text-center" style="width: 40px;">
                                    <strong class="text-primary">40</strong>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">02</td>
                                <td>
                                    <strong>HO AIRA</strong>
                                </td>
                                <td>
                                    <strong>Jakarta</strong>
                                </td>
                                <td class="text-center">
                                    <strong class="text-success">20</strong>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">03</td>
                                <td>
                                    <strong>HO IAPS</strong>
                                </td>
                                <td>
                                    <strong>BATAM</strong>
                                </td>
                                <td class="text-center">
                                    <strong class="text-success">10</strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="block-content block-content-full text-center bg-body-light">
                    <a class="btn btn-alt-secondary" href="javascript:void(0)">
                        <i class="fa fa-eye mr-5"></i> Show all..
                    </a>
                </div>
            </div>
        </div>


        <div class="col-md-6 col-xl-6">
            <div class="block">
                <div class="block-content block-content-full text-center bg-gd-lake rounded block-sticky-options">
                    <div class="block-options">
                        <div class="block-options-item">
                            <i class="fa fa-spinner fa-spin fa-3x text-white-op"></i>
                        </div>
                    </div>
                    <div class="p-20 mb-10">
                        <i class="fa fa-3x fa-user-times text-white-op"></i>
                    </div>
                    <p class="font-size-lg font-w600 text-white mb-0">
                        Contract Expired
                    </p>
                </div>
                <div class="block-content block-content-full">
                    <table class="table table-borderless table-striped table-hover mb-0">
                        <tbody>
                            <tr>
                                <td class="text-center" style="width: 40px;">01</td>
                                <td>
                                    <strong>Udin Sedunia</strong>
                                </td>
                                <td>
                                    <strong>IAPS Batam</strong>
                                </td>
                                <td class="text-center">
                                    <strong class="text-danger">11 Oktober 2024</strong>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center" style="width: 40px;">02</td>
                                <td>
                                    <strong>Udin Aja</strong>
                                </td>
                                <td>
                                    <strong>IAPS Batam</strong>
                                </td>
                                <td class="text-center">
                                    <strong class="text-danger">21 Januari 2025</strong>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center" style="width: 40px;">03</td>
                                <td>
                                    <strong>Udin</strong>
                                </td>
                                <td>
                                    <strong>IAPS Batam</strong>
                                </td>
                                <td class="text-center">
                                    <strong class="text-danger">01 Februari 2025</strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="block-content block-content-full text-center bg-body-light">
                    <a class="btn btn-alt-secondary" href="javascript:void(0)">
                        <i class="fa fa-eye mr-5"></i> Show all..
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
