@extends('layouts.layout')
@section('style')
    <link href="{{asset('temp/src/assets/css/light/apps/invoice-preview.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('temp/src/assets/css/dark/apps/invoice-preview.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="middle-content container-xxl p-0">

                    <div class="row invoice layout-top-spacing layout-spacing">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                            <div class="doc-container">

                                <div class="row">

                                    <div class="col-xl-12">

                                        <div class="invoice-container">
                                            <div class="invoice-inbox">

                                                <div id="ct" class="">

                                                    <div class="invoice-00001">
                                                        <div class="content-section">

                                                            <div class="inv--head-section inv--detail-section">

                                                                <div class="row">
                                                                    @php
                                                                        $months = [
                                                                            1 => 'Januari',
                                                                            2 => 'Februari',
                                                                            3 => 'Maret',
                                                                            4 => 'April',
                                                                            5 => 'Mei',
                                                                            6 => 'Juni',
                                                                            7 => 'Juli',
                                                                            8 => 'Agustus',
                                                                            9 => 'September',
                                                                            10 => 'Oktober',
                                                                            11 => 'November',
                                                                            12 => 'Desember'
                                                                        ];
                                                                        // dd($months[1]);
                                                                    @endphp
                                                                    <div class="col-sm-12 col-12 mr-auto">
                                                                        <div class="d-fle text-center">
                                                                            {{-- <img class="company-logo" src="../src/assets/img/EQUATION-logo.png" alt="company"> --}}
                                                                            <h3 class="in-heading align-self-center mb-3">SUMBER TIRTA</h3>
                                                                        </div>
                                                                        {{-- <p class="inv-street-addr mt-3">Jl. Karanggawang Lama Kel.Sendangguwo, Kec. Tembalang, Semarang</p>
                                                                        <p class="inv-email-address">Telp. (024) 6723477</p>
                                                                        <p class="inv-email-address">HP. 081 249 7777 22</p> --}}
                                                                    </div>
                                                                    <div class="col-sm-12 col-12 mr-auto">
                                                                        <p class="text-center">Bulan Tagihan: <strong>{{$months[$request->bulan]}} {{$request->tahun}}</p>
                                                                    </div>
                                                                    <div class="col-sm-12 col-12 mr-auto">
                                                                        <p class="text-center">Wilayah : <strong>{{$alamat->nama_alamat}}</p>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            @php
                                                                $bulanArray = [
                                                                        1 => 'Januari',
                                                                        2 => 'Februari',
                                                                        3 => 'Maret',
                                                                        4 => 'April',
                                                                        5 => 'Mei',
                                                                        6 => 'Juni',
                                                                        7 => 'Juli',
                                                                        8 => 'Agustus',
                                                                        9 => 'September',
                                                                        10 => 'Oktober',
                                                                        11 => 'November',
                                                                        12 => 'Desember',
                                                                    ];
                                                                // $bln = isset($bulanArray[$tagihan->bulan]) ? $bulanArray[$tagihan->bulan] : 'Bulan Tidak Valid'
                                                            @endphp

                                                            <div class="inv--product-table-section">
                                                                <h4 class="text-center mb-3">DAFTAR PENGGUNAAN</h4>
                                                                <div class="table-responsive">
                                                                    <table class="table table-bordered">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>No</th>
                                                                                <th>ID Pel</th>
                                                                                <th>Nama</th>
                                                                                <th>Meter Awal</th>
                                                                                <th>Meter AKhir</th>
                                                                                <th>M&sup3;</th>
                                                                            </tr>
                                                                        </thead>
                                                                        @if ($catat->isEmpty())
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td colspan="6" class="text-center">Data tidak ditemukan</td>
                                                                                </tr>

                                                                            </tbody>

                                                                        @else
                                                                            <tbody>
                                                                                @foreach ($catat as $c)
                                                                                    @php
                                                                                        $no = 1;
                                                                                    @endphp
                                                                                    <tr>
                                                                                        <td>{{$no++}}</td>
                                                                                        <td>{{$c->id_pelanggan}}</td>
                                                                                        <td>{{$c->user->nama}}</td>
                                                                                        <td>{{$c->meter_awal}}</td>
                                                                                        <td>{{$c->meter_akhir}}</td>
                                                                                        <td>{{$c->meter_akhir - $c->meter_awal}}</td>
                                                                                    </tr>

                                                                                @endforeach
                                                                            </tbody>

                                                                        @endif
                                                                    </table>
                                                                </div>
                                                            </div>

                                                            {{-- @php
                                                                $tghn = $tagihan->penggunaan * $tagihan->customer->tarif->tarif;
                                                            @endphp --}}


                                                            {{-- <div class="inv--note">

                                                                <div class="row mt-4">
                                                                    <div class="col-sm-12 col-12 order-sm-0 order-1">
                                                                        <p>Untuk menghindari denda dan pemutusan, bayarlah pada tanggal 1 s/d 20 tiap bulannya Rincian Tagihan dapat menghubungi kami</p>
                                                                    </div>
                                                                </div>

                                                            </div> --}}

                                                        </div>
                                                    </div>

                                                </div>


                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-xl-12 mt-3">

                                        <div class="invoice-actions-btn">

                                            <div class="invoice-action-btn">

                                                <div class="row">
                                                    {{-- <div class="col-xl-12 col-md-3 col-sm-6">
                                                        <a href="javascript:void(0);" class="btn btn-primary btn-send">Send Invoice</a>
                                                    </div> --}}
                                                    <div class="col-xl-12 col-md-3 col-sm-6">
                                                        <a href="javascript:void(0);" class="btn btn-secondary btn-print  action-print">Print</a>
                                                    </div>
                                                    <div class="col-xl-12 col-md-3 col-sm-6">
                                                        <a href="javascript:void(0);" class="btn btn-success btn-download">Download</a>
                                                    </div>
                                                    {{-- <div class="col-xl-12 col-md-3 col-sm-6">
                                                        <a href="./app-invoice-edit.html" class="btn btn-dark btn-edit">Edit</a>
                                                    </div> --}}
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>

                </div>

            </div>

            <!--  BEGIN FOOTER  -->
            <div class="footer-wrapper">
                <div class="footer-section f-section-1">
                    <p class="">Copyright © <span class="dynamic-year">2024</span> <a target="_blank" href="https://designreset.com/equation/">DesignReset</a>, All rights reserved.</p>
                </div>
                <div class="footer-section f-section-2">
                    <p class="">Coded with <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg></p>
                </div>
            </div>
            <!--  END FOOTER  -->
    </div>
@endsection
@section('script')
    <script src="{{asset('temp/src/assets/js/apps/invoice-preview.js')}}"></script>
@endsection
