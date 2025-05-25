@extends('layouts.layout')
@section('style')
    <link href="{{asset('temp/src/assets/css/light/components/list-group.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('temp/src/assets/css/light/users/user-profile.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('temp/src/assets/css/dark/components/list-group.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('temp/src/assets/css/dark/users/user-profile.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{asset('temp/src/plugins/src/table/datatable/datatables.css')}}">

    {{-- <link rel="stylesheet" type="text/css" href="{{asset('temp/src/plugins/css/light/table/datatable/dt-global_style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('temp/src/plugins/css/dark/table/datatable/dt-global_style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('temp/src/plugins/css/dark/table/datatable/custom_dt_miscellaneous.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('temp/src/plugins/css/light/table/datatable/custom_dt_miscellaneous.css')}}"> --}}
    <style>
        .sticker-container {
            width: 100%;
            max-width: 340px; /* Keep the original max-width for large screens */
            margin: auto;
            border: 2px dashed #333;
            background-color: #fff;
            padding: 20px;
        }

        .headersticker {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
        }

        .logo {
            width: 100px; /* Sesuaikan dengan ukuran logo Anda */
            margin-right: 15px;
        }

        .company-info {
            flex-grow: 1;
        }

        .company-info h2 {
            margin: 0;
            color: #333;
            font-size: 20px;
        }

        .company-info p {
            margin: 5px 0;
            color: #666;
            font-size: 10px;
        }

        .content {
            display: flex;
            align-items: center;
        }

        .barcode-section {
            margin-right: 20px;
        }

        .barcode-section img {
            width: 90px;
            height: 90px;
        }

        .customer-info {
            font-size: 14px;
            line-height: 1.5;
            margin-bottom: 20px;
        }

        .customer-info strong {
            font-size: 16px;
        }

        .print-btn {
            text-align: center;
            margin-top: 20px;
        }

        .print-btn button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        .print-btn button:hover {
            background-color: #0056b3;
        }

        @media (max-width: 768px) {
            .headersticker {
                flex-direction: column;
                align-items: flex-start;
            }

            .logo {
                margin-bottom: 10px;
            }

            .company-info h2 {
                font-size: 18px;
            }

            .company-info p {
                font-size: 12px;
            }

            .content {
                flex-direction: column;
                align-items: flex-start;
            }

            .barcode-section {
                margin-right: 0;
                margin-bottom: 10px;
            }

            .customer-info {
                font-size: 12px;
            }
        }

        @media (max-width: 480px) {
            .sticker-container {
                padding: 15px;
            }

            .logo {
                width: 80px; /* Adjust logo size for small screens */
            }

            .customer-info {
                font-size: 12px;
            }

            .print-btn button {
                padding: 8px 16px;
            }
        }

        @media print {
            body {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }

            @page {
                margin: 0; /* Hilangkan margin di sekitar halaman */
            }

            .sticker-container {
                border: 2px dashed #333;
                padding: 20px;
                width: 320px;
            }

            .headersticker {
                display: flex;
                align-items: center;
                margin-bottom: 20px;
                border-bottom: 2px solid #ddd;
                padding-bottom: 10px;
            }

            .headersticker img.logo {
                width: 80px;
                margin-right: 10px;
            }

            .company-info h2 {
                margin: 0;
                font-size: 16px;
            }

            .company-info p {
                margin: 5px 0;
                font-size: 10px;
            }

            .content {
                display: flex;
                align-items: flex-start;
            }

            .barcode-section img {
                width: 90px;
                height: 90px;
                margin-right: 20px;
            }

            .customer-info {
                font-size: 12px;
                line-height: 1.5;
            }

            .print-btn {
                display: none; /* Sembunyikan tombol cetak */
            }
        }


    </style>
@endsection
@section('content')
    <!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content">
        <div class="layout-px-spacing">

            <div class="middle-content container-xxl p-0">

                <!-- BREADCRUMB -->
                <div class="page-meta">
                    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Pelanggan</a></li>
                            <li class="breadcrumb-item"><a href="{{route('customer.all')}}">Semua Pelanggan</a></li>
                            <li class="breadcrumb-item active" aria-current="page">View Detail</li>
                        </ol>
                    </nav>
                </div>
                <!-- /BREADCRUMB -->

                <div class="row layout-spacing ">
                    <div class="col-xl-5 col-lg-12 col-md-12 col-sm-12 layout-top-spacing">
                        <div class="user-profile">
                            <div class="widget-content widget-content-area">
                                <div class="d-flex justify-content-between">
                                    <h3 class="">Data Pelanggan</h3>
                                </div>
                                <div class="text-center user-info">
                                    <p class="">{{$customer->user->nama}}</p>
                                </div>
                                <table class="table table-bordered">
                                    {{-- <thead> --}}
                                        <tr>
                                            <th>ID Pelanggan</th>
                                            <th>{{$customer->id_pelanggan}}</th>
                                        </tr>
                                        <tr>
                                            <th>No Meter</th>
                                            <th>{{$customer->no_meter}}</th>
                                        </tr>
                                        <tr>
                                            <th>Tarif</th>
                                            <th>{{$customer->tarif->kode}}</th>
                                        </tr>
                                        <tr>
                                            <th>Alamat</th>
                                            <th>{{$customer->alamat->nama_alamat}}</th>
                                        </tr>
                                        <tr>
                                            <th>Nomor Telpon</th>
                                            <th>{{$customer->user->no_telp}}</th>
                                        </tr>
                                        <tr>
                                            <th>Customer Sejak</th>
                                            <th>{{$customer->created_at}}</th>
                                        </tr>
                                    {{-- </thead> --}}

                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Content -->
                    <div class="col-xl-7 col-lg-12 col-md-12 col-sm-12 layout-top-spacing">
                        <div class="user-profile">
                            <div class="widget-content widget-content-area">
                                <div class="d-flex justify-content-between mb-3">
                                    <h3 class="">Barcode</h3>
                                </div>
                                <div class="sticker-container">
                                    <!-- Header dengan Logo -->
                                    <div class="headersticker">
                                        <img src="{{ asset('logo.png') }}" alt="Company Logo" class="logo">
                                        <div class="company-info">
                                            <h2>Sumber Tirta</h2>
                                            <p>Alamat Perusahaan Anda</p>
                                            <p>Telp: (021) 1234567 | Email: info@perusahaan.com</p>
                                        </div>
                                    </div>

                                    <!-- Content -->
                                    <div class="content">
                                        <div class="barcode-section">
                                            {{-- Menggunakan PNG untuk kompatibilitas cetak yang lebih baik --}}
                                            <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($customer->id_pelanggan, 'QRCODE', 3, 3) }}" alt="QR Code">
                                        </div>
                                        <div class="customer-info">
                                            <strong>{{ $customer->user->nama }}</strong><br>
                                            No Meter: {{ $customer->no_meter }}<br>
                                            Alamat: {{ $customer->alamat->nama_alamat }}<br>
                                            Phone: {{ $customer->user->no_telp }}
                                        </div>
                                    </div>
                                </div>
                                <div class="print-btn">
                                    <button onclick="printSticker()">Cetak Sticker</button>
                                </div>

                                {{-- <div class="text-center user-info">
                                    <img src="../src/assets/img/profile-3.jpeg" alt="avatar">
                                    <p class="">Jimmy Turner</p>
                                </div>
                                <div class="user-info-list">

                                    <div class="">
                                        <ul class="contacts-block list-unstyled">
                                            <li class="contacts-block__item">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-coffee me-3"><path d="M18 8h1a4 4 0 0 1 0 8h-1"></path><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"></path><line x1="6" y1="1" x2="6" y2="4"></line><line x1="10" y1="1" x2="10" y2="4"></line><line x1="14" y1="1" x2="14" y2="4"></line></svg> Web Developer
                                            </li>
                                            <li class="contacts-block__item">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar me-3"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>Jan 20, 1989
                                            </li>
                                            <li class="contacts-block__item">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin me-3"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>New York, USA
                                            </li>
                                            <li class="contacts-block__item">
                                                <a href="mailto:example@mail.com"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail me-3"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>Jimmy@gmail.com</a>
                                            </li>
                                            <li class="contacts-block__item">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone me-3"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg> +1 (530) 555-12121
                                            </li>
                                        </ul>

                                        <ul class="list-inline mt-4">
                                            <li class="list-inline-item mb-0">
                                                <a class="btn btn-info btn-icon btn-rounded" href="javascript:void(0);">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>
                                                </a>
                                            </li>
                                            <li class="list-inline-item mb-0">
                                                <a class="btn btn-danger btn-icon btn-rounded" href="javascript:void(0);">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dribbble"><circle cx="12" cy="12" r="10"></circle><path d="M8.56 2.75c4.37 6.03 6.02 9.42 8.03 17.72m2.54-15.38c-3.72 4.35-8.94 5.66-16.88 5.85m19.5 1.9c-3.5-.93-6.63-.82-8.94 0-2.58.92-5.01 2.86-7.44 6.32"></path></svg>
                                                </a>
                                            </li>
                                            <li class="list-inline-item mb-0">
                                                <a class="btn btn-dark btn-icon btn-rounded" href="javascript:void(0);">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-github"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path></svg>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 layout-top-spacing">

                        <div class="usr-tasks ">
                            <div class="widget-content widget-content-area">
                                <h3 class="">Catatan Meter</h3>
                                <div class="table-responsive">
                                    <table id="zero-config1" class="table table-bordered dt-table-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>ID Pelanggan</th>
                                                <th>No Meter</th>
                                                <th>Nama</th>
                                                <th>Alamat</th>
                                                <th>Kode Tarif</th>
                                                <th>Bulan Tagihan</th>
                                                <th>Meter Awal</th>
                                                <th>Meter Akhir</th>
                                                <th>Tgl Cek</th>
                                                <th>Petugas</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $no = 1;
                                            @endphp
                                            @foreach ($catat as $c)
                                                <tr>
                                                    <td>{{$no++}}</td>
                                                    <td>{{$c->id_pelanggan}}</td>
                                                    <td>{{$c->customer->no_meter}}</td>
                                                    <td>{{$c->user->nama}}</td>
                                                    <td>{{$c->customer->alamat->nama_alamat}}</td>
                                                    <td>{{$c->customer->tarif->kode}}</td>
                                                    <td>{{ $months[$c->month]. ' '.$c->year ?? 'Bulan Tidak Diketahui' }}</td>
                                                    <td>{{$c->meter_awal}}</td>
                                                    <td>{{$c->meter_akhir}}</td>
                                                    <td>{{$c->tgl_cek}}</td>
                                                    <td>{{$c->petugas->nama}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 layout-top-spacing">

                        <div class="usr-tasks ">
                            <div class="widget-content widget-content-area">
                                <h3 class="">Tagihan</h3>
                                <div class="table-responsive">
                                    <table id="zero-config2" class="table table-bordered dt-table-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>ID Pelanggan</th>
                                                <th>Nama Pelanggan</th>
                                                <th>Bulan Tagihan</th>
                                                <th>Total Penggunaan</th>
                                                <th>Total Tagihan</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $no = 1;
                                            @endphp
                                            @foreach ($tagihan as $t)
                                                <tr>
                                                    <td>{{$no}}</td>
                                                    <td>{{$t->id_pelanggan}}</td>
                                                    <td>{{$t->customer->user->nama}}</td>
                                                    @if ($t->bulan < 10)
                                                    <td>0{{$t->bulan}}/{{$t->tahun}}</td>

                                                    @else
                                                    <td>{{$t->bulan}}/{{$t->tahun}}</td>

                                                    @endif

                                                    <td>{{$t->penggunaan}} M&sup3;</td>
                                                    <td>Rp{{$t->tagihan}}</td>
                                                    @if ($t->status == 1)
                                                    <td><span class="badge bg-danger">Belum Lunas</span></td>
                                                    <td>
                                                        <a href="">
                                                            <span class="badge bg-primary">Bayar</span>
                                                        </a>
                                                    </td>

                                                    @else
                                                    <td><span class="badge bg-success">Lunas</span></td>
                                                    <td>
                                                        <a href="">
                                                            <span class="badge badge-dark">Bayar</span>
                                                        </a>
                                                    </td>
                                                    @endif

                                                </tr>

                                            @endforeach
                                        </tbody>
                                    </table>
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
    <script src="{{asset('temp/src/plugins/src/table/datatable/datatables.js')}}"></script>
    <script src="{{asset('temp/src/plugins/src/table/datatable/button-ext/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('temp/src/plugins/src/table/datatable/button-ext/jszip.min.js')}}"></script>
    <script src="{{asset('temp/src/plugins/src/table/datatable/button-ext/buttons.html5.min.js')}}"></script>
    <script src="{{asset('temp/src/plugins/src/table/datatable/button-ext/buttons.print.min.js')}}"></script>
    <script src="{{asset('temp/src/plugins/src/table/datatable/custom_miscellaneous.js')}}"></script>
    <script>
        $('#zero-config1').DataTable({
                "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
            "<'table-responsive'tr>" +
            "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
                "oLanguage": {
                    "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                    "sInfo": "Showing page _PAGE_ of _PAGES_",
                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  _MENU_",
                },
                "stripeClasses": [],
                "lengthMenu": [7, 10, 20, 50],
                "pageLength": 10
            });
        $('#zero-config2').DataTable({
                "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
            "<'table-responsive'tr>" +
            "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
                "oLanguage": {
                    "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                    "sInfo": "Showing page _PAGE_ of _PAGES_",
                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  _MENU_",
                },
                "stripeClasses": [],
                "lengthMenu": [7, 10, 20, 50],
                "pageLength": 10
            });
    </script>
    <script>
        function printSticker() {
            var printContents = document.querySelector('.sticker-container').outerHTML;
            var originalContents = document.body.innerHTML;

            // Temporarily change the body content to the sticker container
            document.body.innerHTML = printContents;

            // Trigger the print dialog
            window.print();

            // Restore the original body content after printing
            document.body.innerHTML = originalContents;
        }
    </script>
@endsection
