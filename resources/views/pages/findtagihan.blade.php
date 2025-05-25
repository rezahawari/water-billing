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

                                    <div class="col-xl-9">

                                        <div class="invoice-container">
                                            <div class="invoice-inbox">

                                                <div id="ct" class="">

                                                    <div class="invoice-00001">
                                                        <div class="content-section">

                                                            <div class="inv--head-section inv--detail-section">

                                                                <div class="row">

                                                                    <div class="col-sm-6 col-12 mr-auto">
                                                                        <div class="d-flex">
                                                                            {{-- <img class="company-logo" src="../src/assets/img/EQUATION-logo.png" alt="company"> --}}
                                                                            <h3 class="in-heading align-self-center">SUMBER TIRTA</h3>
                                                                        </div>
                                                                        <p class="inv-street-addr mt-3">Jl. Karanggawang Lama Kel.Sendangguwo, Kec. Tembalang, Semarang</p>
                                                                        <p class="inv-email-address">Telp. (024) 6723477</p>
                                                                        <p class="inv-email-address">HP. 081 249 7777 22</p>
                                                                    </div>

                                                                    <div class="col-sm-6 text-sm-end">
                                                                        <p class="inv-list-number mt-sm-3 pb-sm-2 mt-4"><span class="inv-title">Invoice : </span> <span class="inv-number">#0001</span></p>
                                                                        <p class="inv-created-date mt-sm-5 mt-3"><span class="inv-title">Invoice Date : </span> <span class="inv-date">20 Mar 2024</span></p>
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
                                                                $bln = isset($bulanArray[$tagihan->bulan]) ? $bulanArray[$tagihan->bulan] : 'Bulan Tidak Valid'
                                                            @endphp

                                                            <div class="inv--product-table-section">
                                                                <div class="table-responsive">
                                                                    <table class="table">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td><strong>ID Pel</strong></td>
                                                                                <td>: {{$tagihan->id_pelanggan}}</td>
                                                                                <td><strong>Nama</strong></td>
                                                                                <td>: {{$tagihan->customer->user->nama}}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><strong>Tarif</strong></td>
                                                                                <td>: {{$tagihan->customer->tarif->kode}}</td>
                                                                                <td><strong>Bulan / Tahun</strong></td>
                                                                                <td>: {{$tagihan->bulan}} / {{$tagihan->tahun}}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><strong>Stand Meter</strong></td>
                                                                                <td>: {{$tagihan->catat->meter_awal}} - {{$tagihan->catat->meter_akhir}} ({{$tagihan->penggunaan}} M&sup3;)</td>
                                                                                <td></td>
                                                                                <td></td>
                                                                            </tr>

                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>

                                                            @php
                                                                $tghn = $tagihan->penggunaan * $tagihan->customer->tarif->tarif;
                                                            @endphp

                                                            <div class="inv--total-amounts">
                                                                <div class="row mt-4">
                                                                    <div class="col-sm-5 col-12 order-sm-0 order-1">
                                                                    </div>
                                                                    <div class="col-sm-7 col-12 order-sm-1 order-0">
                                                                        <div class="text-sm-end">
                                                                            <div class="row">
                                                                                <div class="col-sm-8 col-7">
                                                                                    <p class="">Tagihan :</p>
                                                                                </div>
                                                                                <div class="col-sm-4 col-5">
                                                                                    <p class="">Rp {{$tagihan->penggunaan * $tagihan->customer->tarif->tarif}}</p>
                                                                                </div>
                                                                                <div class="col-sm-8 col-7">
                                                                                    <p class="">Denda :</p>
                                                                                </div>
                                                                                <div class="col-sm-4 col-5">
                                                                                    <p class="">Rp {{$tagihan->total_denda}}</p>
                                                                                </div>
                                                                                <div class="col-sm-8 col-7">
                                                                                    <p class=" discount-rate">Abonemen :</p>
                                                                                </div>
                                                                                <div class="col-sm-4 col-5">
                                                                                    <p class="">Rp {{$tagihan->customer->tarif->abonemen}}</p>
                                                                                </div>
                                                                                <div class="col-sm-8 col-7">
                                                                                    <p class=" discount-rate"><strong>Grand Total :</strong></p>
                                                                                </div>
                                                                                <div class="col-sm-4 col-5">
                                                                                    <p class=""><strong>Rp {{$tghn + $tagihan->total_denda + $tagihan->customer->tarif->abonemen}}</strong></p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                            <div class="inv--note">

                                                                <div class="row mt-4">
                                                                    <div class="col-sm-12 col-12 order-sm-0 order-1">
                                                                        <p>Untuk menghindari denda dan pemutusan, bayarlah pada tanggal 1 s/d 20 tiap bulannya Rincian Tagihan dapat menghubungi kami</p>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>


                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-xl-3">

                                        <div class="invoice-actions-btn">

                                            <div class="invoice-action-btn">

                                                <div class="row">
                                                    <div class="col-xl-12 col-md-3 col-sm-6">
                                                        <a href="javascript:void(0);" class="btn btn-primary btn-send">Send Invoice</a>
                                                    </div>
                                                    <div class="col-xl-12 col-md-3 col-sm-6">
                                                        <a href="javascript:void(0);" class="btn btn-secondary btn-print  action-print">Print</a>
                                                    </div>
                                                    <div class="col-xl-12 col-md-3 col-sm-6">
                                                        <a href="javascript:void(0);" class="btn btn-success btn-download">Download</a>
                                                    </div>
                                                    <div class="col-xl-12 col-md-3 col-sm-6">
                                                        <a href="./app-invoice-edit.html" class="btn btn-dark btn-edit">Edit</a>
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
