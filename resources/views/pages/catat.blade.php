@extends('layouts.layout')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('temp/src/plugins/src/stepper/bsStepper.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('temp/src/assets/css/light/scrollspyNav.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('temp/src/plugins/css/light/stepper/custom-bsStepper.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('temp/src/assets/css/dark/scrollspyNav.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('temp/src/plugins/css/dark/stepper/custom-bsStepper.css')}}">
    <link href="{{asset('temp/src/assets/css/light/components/list-group.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('temp/src/assets/css/light/users/user-profile.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('temp/src/assets/css/dark/components/list-group.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('temp/src/assets/css/dark/users/user-profile.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{asset('temp/src/plugins/src/table/datatable/datatables.css')}}">

    <link href="{{asset('temp/src/plugins/src/autocomplete/css/autoComplete.02.css')}}" rel="stylesheet" type="text/css" />

    {{-- <link href="{{asset('temp/src/assets/css/light/scrollspyNav.css')}}" rel="stylesheet" type="text/css" /> --}}
    <link href="{{asset('temp/src/plugins/css/light/autocomplete/css/custom-autoComplete.css')}}" rel="stylesheet" type="text/css" />

    {{-- <link href="{{asset('temp/src/assets/css/dark/scrollspyNav.css')}}" rel="stylesheet" type="text/css" /> --}}
    <link href="{{asset('temp/src/plugins/css/dark/autocomplete/css/custom-autoComplete.css')}}" rel="stylesheet" type="text/css" />
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('temp/src/plugins/css/light/table/datatable/dt-global_style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('temp/src/plugins/css/dark/table/datatable/dt-global_style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('temp/src/plugins/css/dark/table/datatable/custom_dt_miscellaneous.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('temp/src/plugins/css/light/table/datatable/custom_dt_miscellaneous.css')}}"> --}}
    <style>
        .scan-state {
            transition: all 0.3s ease;
            min-height: 300px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .modal-content.custom-white-modal {
            background-color: #ffffff !important;
            color: #333; /* Warna teks default */
        }

        .custom-white-modal .modal-header {
            border-bottom: 1px solid #dee2e6; /* Garis pemisah header */
            background-color: #f8f9fa; /* Warna header lebih muda */
        }

        .custom-white-modal .modal-footer {
            border-top: 1px solid #dee2e6; /* Garis pemisah footer */
        }

        .month-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr); /* Tepat 3 kolom */
            gap: 15px;
            margin-top: 20px;
        }

        .month-tile {
            aspect-ratio: 1/1; /* Membuat tile menjadi persegi sempurna */
            border: 1px solid #ddd;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
            font-size: 18px;
            font-weight: 500;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .month-tile:hover {
            background-color: #f5f5f5;
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .month-tile.selected {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }

        .month-tile.disabled {
            background-color: #f0f0f0;
            color: #999;
            cursor: not-allowed;
            opacity: 0.7;
            box-shadow: none;
            position: relative;
        }

        .month-tile.disabled::after {
            content: "✓";
            position: absolute;
            top: 5px;
            right: 5px;
            font-size: 12px;
            color: #28a745;
            background: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Tampilan Desktop: 3 kolom */
        @media (min-width: 992px) {
            .month-grid {
                grid-template-columns: repeat(3, 1fr); /* 3 kolom di layar besar */
            }
        }

        /* Tampilan Tablet: 2 kolom */
        @media (min-width: 576px) and (max-width: 991px) {
            .month-grid {
                grid-template-columns: repeat(2, 1fr); /* 2 kolom di tablet */
            }
        }

        /* Tampilan Mobile: 1 kolom */
        @media (max-width: 575px) {
            .month-grid {
                grid-template-columns: repeat(2, 1fr); /* 1 kolom di mobile */
            }
        }
    </style>
@endsection
@section('content')
    <!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="">

                <!-- BREADCRUMB -->
                <div class="page-meta">
                    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Penggunaan</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Input</li>
                        </ol>
                    </nav>
                </div>
                <!-- /BREADCRUMB -->



                <div class="row layout-top-spacing" id="cancel-row">

                    <div id="wizard_Default" class="col-lg-12 layout-spacing">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header" data-bs-toggle="collapse" data-bs-target="#defaultAccordionOne" aria-expanded="false" aria-controls="defaultAccordionOne">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4>Catat Meter</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area collapse show" id="defaultAccordionOne">
                                <div class="bs-stepper stepper-form-one">
                                    <div class="bs-stepper-header" role="tablist">
                                        <div class="step" data-target="#defaultStep-one">
                                            <button type="button" class="step-trigger" role="tab" >
                                                <span class="bs-stepper-circle">1</span>
                                                <span class="bs-stepper-label">Scan/Input ID Pelanggan</span>
                                            </button>
                                        </div>
                                        <div class="line"></div>
                                        <div class="step" data-target="#defaultStep-two">
                                            <button type="button" class="step-trigger" role="tab">
                                                <span class="bs-stepper-circle">2</span>
                                                <span class="bs-stepper-label">Pilih bulan yang <br>ingin di input</span>
                                            </button>
                                        </div>
                                        {{-- <div class="line"></div> --}}
                                        {{-- <div class="step" data-target="#defaultStep-three">
                                            <button type="button" class="step-trigger" role="tab"  >
                                                <span class="bs-stepper-circle">3</span>
                                                <span class="bs-stepper-label">
                                                    <span class="bs-stepper-title">Step Three</span>
                                                </span>
                                            </button>
                                        </div> --}}
                                    </div>
                                    <div class="bs-stepper-content">
                                        <div id="defaultStep-one" class="content" role="tabpanel">
                                            <form method="post" action="{{route('catat.store')}}" id="storeform">
                                                @csrf
                                                <div class="form-group mb-4">
                                                    <label for="idpel">ID Pelanggan</label>
                                                    <input type="text" class="form-control" id="idpel" autocomplete="off" name="idpel" oninput="removeDisable('btnnextidpel')">
                                                </div>


                                            <div class="button-action mt-5">
                                                <a class="btn btn-info me-3" id="start-scan">Scan</a>
                                                <a class="btn btn-secondary btn-prev me-3" disabled>Prev</a>
                                                <a class="btn btn-secondary btn-nxt disabled" id="btnnextidpel" onclick="fillinput()" id="next">Next</a>
                                            </div>
                                        </div>

                                        <div id="defaultStep-two" class="content" role="tabpanel" >
                                            <div class="text-center" id="detailcust"></div>

                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <div class="col-12">
                                                            <label for="meterawal" class="form-label">Nama Pelanggan</label>
                                                            <input type="text" class="form-control" id="nama" placeholder="1234 Main St" name="nama" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <div class="col-12">
                                                            <label for="meterawal" class="form-label">Bulan Tahun Penggunaan</label>
                                                            <input type="text" class="form-control" id="bulanpenggunaan" placeholder="Bulan" onkeyup="fillmthyear()">
                                                            <input type="hidden" name="bulan" id="bln" value="">
                                                            <input type="hidden" name="tahun" id="thn" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <div class="col-12">
                                                            <label for="meterawal" class="form-label">Meter Awal</label>
                                                            <input type="number" class="form-control" id="meterawal" placeholder="0" name="meterawal">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <div class="col-12">
                                                            <label for="meterakhir" class="form-label">Meter Akhir</label>
                                                            <input type="text" class="form-control" id="meterakhir" placeholder="0" name="meterakhir" onkeyup="checkawalakhir()">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <div class="col-12">
                                                            <label for="tglcek" class="form-label">Tgl Pengecekan</label>
                                                            <input type="date" class="form-control" id="tglcek" placeholder="dd/mm/yyyy" name="tglcek">
                                                        </div>
                                                    </div>
                                                    <div class="" id="isrusak">
                                                        <div class="form-check form-switch form-check-inline mt-3">
                                                            <input class="form-check-input" name="isrusak" type="checkbox" role="switch" id="flexSwitchCheckChecked">
                                                            <label class="form-check-label" for="flexSwitchCheckChecked">Meteran Rusak</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="button-action mt-3">
                                                    <a class="btn btn-secondary btn-prev me-3">Prev</a>
                                                    <button class="btn btn-success me-3" type="submit" id="saveBtn">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

                <div class="">

                    <div class="middle-content container-xxl p-0">

                        <div class="row layout-top-spacing">
                            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                                <div class="widget-content widget-content-area br-8">
                                    <table id="zero-config" class="table table-striped dt-table-hover" style="width:100%">
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
                                                <th></th>
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
                                                    <td>
                                                        {{-- <div class="dropdown">
                                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                                            </a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink6">
                                                                <a class="dropdown-item" href="javascript:void(0);">View</a>
                                                                <a class="dropdown-item" href="javascript:void(0);">Edit</a>
                                                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                                            </div>
                                                        </div> --}}
                                                        <div class="btn-group dropstart">
                                                            <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                              Action
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <li><a class="dropdown-item editBtn" href="javascript:void(0);"
                                                                    data-id="{{ $c->id }}">Edit</a></li>
                                                                <li><a class="dropdown-item btndelete" href="javascript:void(0);" data-id="{{$c->id}}">Delete</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
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

        <div class="footer-wrapper">
            <div class="footer-section f-section-1">
                <p class="">Copyright © <span class="dynamic-year">2024</span> <a target="_blank" href="https://designreset.com/equation/">DesignReset</a>, All rights reserved.</p>
            </div>
            <div class="footer-section f-section-2">
                <p class="">Coded with <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg></p>
            </div>
        </div>

    </div>

    <!-- Tambahkan di section content -->
    <div class="modal fade" id="scanner-modal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content custom-white-modal">
                <div class="modal-header">
                    <h5 class="modal-title">Proses Scanning</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <!-- State 1: Camera Preview -->
                    <div id="scan-view" class="scan-state">
                        <video id="preview" width="100%" style="max-height: 60vh"></video>
                        <div class="alert alert-info mt-2">Arahkan kamera ke barcode pelanggan</div>
                    </div>

                    <!-- State 2: Loading -->
                    <div id="scan-loading" class="scan-state d-none">
                        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;"></div>
                        <div class="mt-3">Mencari data pelanggan...</div>
                    </div>

                    <!-- State 3: Confirmation -->
                    <div id="scan-result" class="scan-state d-none">
                        <h5 class="mb-3">Data Pelanggan Ditemukan</h5>
                        <div id="customer-detail" class="text-start mb-4"></div>
                        <button id="confirm-btn" class="btn btn-success me-2">
                            <i class="fa fa-check-circle"></i> Setuju
                        </button>
                        <button id="rescan-btn" class="btn btn-warning">
                            <i class="fa fa-redo"></i> Rescan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{asset('temp/src/plugins/src/stepper/bsStepper.min.js')}}"></script>
    <script src="{{asset('temp/src/plugins/src/stepper/custom-bsStepper.min.js')}}"></script>
    <script src="{{asset('temp/src/plugins/src/table/datatable/datatables.js')}}"></script>
    <script src="{{asset('temp/src/plugins/src/table/datatable/button-ext/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('temp/src/plugins/src/table/datatable/button-ext/jszip.min.js')}}"></script>
    <script src="{{asset('temp/src/plugins/src/table/datatable/button-ext/buttons.html5.min.js')}}"></script>
    <script src="{{asset('temp/src/plugins/src/table/datatable/button-ext/buttons.print.min.js')}}"></script>
    <script src="{{asset('temp/src/plugins/src/table/datatable/custom_miscellaneous.js')}}"></script>
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script src="{{asset('temp/src/assets/js/scrollspyNav.js')}}"></script>
    <script src="{{asset('temp/src/plugins/src/autocomplete/autoComplete.min.js')}}"></script>

    <script>
        async function fillmthyear() {
            let tanggal = document.getElementById('bulanpenggunaan').value;
            // console.log(data);
            // Memecah string berdasarkan tanda '/'
            let parts = tanggal.split('/');

            // Mendapatkan bulan dan tahun secara terpisah
            let bulan = parts[0];
            let tahun = parts[1];

            document.getElementById('bln').value = bulan;
            document.getElementById('thn').value = tahun;
        }
    </script>

    <script>
        // Menangani input ketika pengguna mengetik
        document.getElementById('bulanpenggunaan').addEventListener('input', function(e) {
            let value = e.target.value;

            // Hanya izinkan dua digit untuk bulan dan empat digit untuk tahun (MM/YYYY)
            if (value.length === 2) {
                e.target.value = value + '/';
            }
            if (value.length > 7) {
                e.target.value = value.slice(0, 7); // Batasi hanya sampai 7 karakter (MM/YYYY)
            }
        });
    </script>

    <script>
        $(document).ready(function(){
            $('.btndelete').on('click', function(){
            var id = $(this).data('id');
            // var nama = $(this).data('nama');
            Swal.fire({
                title: "Apakah kamu yakin ingin menghapus data catatan ini?",
                text: "Kamu tidak akan bisa mengembalikan ini!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, hapus saja!",
                cancelButtonText: 'Tidak, kembali ke tampilan awal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/catat/' + id + '/destroy', // Ganti dengan URL endpoint penghapusan di server
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Menambahkan CSRF token
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Data catatab berhasil dihapus.",
                                    icon: "success"
                                }).then(() => {
                                    // Refresh halaman setelah berhasil menghapus
                                    location.reload(); // Halaman akan di-refresh
                                });
                            } else {
                                Swal.fire({
                                    title: "Gagal!",
                                    text: "Terjadi kesalahan saat menghapus akun.",
                                    icon: "error"
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                title: "Gagal!",
                                text: error,
                                icon: "error"
                            });
                        }
                    });
                }
            });
        });
        });
    </script>

    <script>
        $('#zero-config').DataTable({
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
        const autoCompleteJS = new autoComplete({
            selector: "#idpel",
            placeHolder: "Cari Nomor Meter",
            data: {
                src: async () => {
                    try {
                        // Query pencarian dari input
                        const query = autoCompleteJS.input.value;

                        // Fetch data dari API Laravel
                        const source = await fetch(`/search-pelanggan?query=${query}`);
                        const data = await source.json();
                        // console.log(data);

                        // Return data
                        return data;
                    } catch (error) {
                        console.error("Error:", error);
                        return [];
                    }
                },
                cache: false,
                keys: ["label"] // Mencocokkan dengan properti "label"
            },
            resultsList: {
                element: (list, data) => {
                    console.log(data);

                    if (!data.results.length) {
                        const message = document.createElement("div");
                        message.setAttribute("class", "no_result");
                        message.innerHTML = `<span>Tidak ada hasil untuk "${data.query}"</span>`;
                        list.prepend(message);
                    }
                },
                noResults: true,
            },
            resultItem: {
                highlight: {
                    render: true
                }
            },
            events: {
                input: {
                    focus() {
                        if (autoCompleteJS.input.value.length) autoCompleteJS.start();
                    },
                    selection(event) {
                        const feedback = event.detail;

                        // Feedback memiliki seluruh objek hasil (termasuk label dan value)
                        const selectedItem = feedback.selection;
                        // console.log(selectedItem);
                        // Menggunakan value (ID pelanggan) untuk input
                        autoCompleteJS.input.value = selectedItem.value.value;
                    }
                }
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            // Perbarui event handler saveBtn
            $('#saveBtn').on('click', function() {
                $(this).prop('disabled', true);
                $(this).html('<div class="spinner-border spinner-border-sm text-white align-self-center"></div> Loading');

                setTimeout(function() {
                    $('#saveBtn').prop('disabled', false);
                    $('#saveBtn').html('Simpan');
                }, 10000);

                document.getElementById('storeform').submit();
            });
    });

    </script>

    <script>
        async function setdetailvalue(){
            const showState = (state) => {
                document.querySelectorAll('.scan-state').forEach(el => el.classList.add('d-none'));
                document.querySelector(`#${state}`).classList.remove('d-none');
            };
            const idPelanggan = document.getElementById('idpel').value;
            const bulan = document.getElementById('selectedMonth').value;
            const tahun = document.getElementById('selectedYear').value;
            const response = await fetch('/cek-pelanggan/' + idPelanggan, {
                 headers: {
                     'X-CSRF-TOKEN': '{{ csrf_token() }}',
                     'Accept': 'application/json'
                 }
             })
             const data = await response.json()
             if(data.error) {
                 alert(data.error);
                 return;
             }

             document.getElementById('detailcust').innerHTML = `
                        <p><strong>ID Pelanggan:</strong> ${data.id}</p>
                        <p><strong>Nama:</strong> ${data.nama}</p>
                        <p><strong>Alamat:</strong> ${data.alamat}</p>
                        <p><strong>Tarif:</strong> ${data.tarif}</p>
                        <p><strong>Bulan/Tahun:</strong> ${bulan}/${tahun}</p>
            `;
            //  document.getElementById('pidpel').value = data.id;
            //  document.getElementById('pnama').value = data.nama;
            //  document.getElementById('ptarif').value = data.tarif;
            //  document.getElementById('pbulan').value = `${bulan}/${tahun}`;
            try {
                    const response = await fetch('/cek-catat/' + idPelanggan, {
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    });

                    const data = await response.json();

                    if(data.error) {
                        alert(data.error);
                        return;
                    }

                    document.getElementById('meterawal').value = data.meterawal;


                } catch (error) {
                    console.error('Error:', error);
                    alert('Gagal memuat data pelanggan');
                    showState('scan-view');
                }

        }

        async function checkawalakhir(){
            const awal = document.getElementById('meterawal').value;
            const akhir = document.getElementById('meterakhir').value;

            if(awal == akhir) {
                document.getElementById('isrusak').innerHTML = `
                    <div class="form-check form-switch form-check-inline mt-3">
                        <input class="form-check-input" name="isrusak" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                        <label class="form-check-label" for="flexSwitchCheckChecked">Meteran Rusak</label>
                    </div>
                `;
            }else {
                document.getElementById('isrusak').innerHTML = `
                    <div class="form-check form-switch form-check-inline mt-3">
                        <input class="form-check-input" name="isrusak" type="checkbox" role="switch" id="flexSwitchCheckChecked">
                        <label class="form-check-label" for="flexSwitchCheckChecked">Meteran Rusak</label>
                    </div>
                `;
            }
        }
    </script>

    <script>
        async function fillinput(){
            const monthsList = {
                1: 'Januari',
                2: 'Februari',
                3: 'Maret',
                4: 'April',
                5: 'Mei',
                6: 'Juni',
                7: 'Juli',
                8: 'Agustus',
                9: 'September',
                10: 'Oktober',
                11: 'November',
                12: 'Desember'
            };
            const idpel = document.getElementById('idpel').value;
            const response = await fetch('/cek-catat/' + idpel, {
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            });
            const data = await response.json();
            console.log(data);

            document.getElementById('nama').value = data.catat.user.nama;
            document.getElementById('meterawal').value = data.catat.meter_akhir;

            // Mendapatkan tanggal hari ini
            const today = new Date();

            // Format tanggal menjadi YYYY-MM-DD
            let yyyy = today.getFullYear();
            let mm = today.getMonth() + 1;  // Bulan dimulai dari 0, jadi kita tambahkan 1
            let dd = today.getDate();

            // Pastikan bulan dan hari selalu dua digit
            if (mm < 10) {
                mm = '0' + mm;
            }
            if (dd < 10) {
                dd = '0' + dd;
            }

            // Format tanggal sebagai YYYY-MM-DD
            const formattedDate = yyyy + '-' + mm + '-' + dd;
            document.getElementById('tglcek').value = formattedDate;

            let mthinnumber = data.catat.month + 1;



            const bulan = monthsList[mthinnumber];
            let tahun = data.catat.year;

            if(mthinnumber > 12) {
                mthinnumber = 1;
                tahun++;
            }

            if (mthinnumber < 10) {
                mthinnumber = '0' + mthinnumber;
            }

            document.getElementById('bulanpenggunaan').value = `${mthinnumber}/${tahun}`;

            fillmthyear();
        }
    </script>

    <script>
        document.getElementById('start-scan').addEventListener('click', function() {
            const modal = new bootstrap.Modal('#scanner-modal');
            let scanner = null;

            const showState = (state) => {
                document.querySelectorAll('.scan-state').forEach(el => el.classList.add('d-none'));
                document.querySelector(`#${state}`).classList.remove('d-none');
            };

            const processScan = async (idPelanggan) => {
                showState('scan-loading');

                try {
                    const response = await fetch('/cek-pelanggan/' + idPelanggan, {
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    });

                    const data = await response.json();

                    if(data.error) {
                        alert(data.error);
                        showState('scan-view');
                        scanner.start();
                        return;
                    }

                    // Tampilkan data pelanggan
                    document.getElementById('customer-detail').innerHTML = `
                        <p><strong>ID Pelanggan:</strong> ${data.id}</p>
                        <p><strong>Nama:</strong> ${data.nama}</p>
                        <p><strong>Alamat:</strong> ${data.alamat}</p>
                        <p><strong>Tarif</strong> Rp ${data.tarif}</p>
                    `;
                    showState('scan-result');

                    
                    // Handle tombol setuju
                    document.getElementById('confirm-btn').onclick = () => {
                        document.getElementById('idpel').value = data.no_meter;
                        modal.hide();

                        // Auto save and next
                        setTimeout(() => {
                            document.querySelector('.btn-nxt').click();
                        }, 300);
                    };

                    // Handle rescan
                    document.getElementById('rescan-btn').onclick = () => {
                        showState('scan-view');
                        scanner.start();
                    };

                } catch (error) {
                    console.error('Error:', error);
                    alert('Gagal memuat data pelanggan');
                    showState('scan-view');
                }
            };

            modal.show();
            showState('scan-view');

            Instascan.Camera.getCameras().then(cameras => {
                if (cameras.length > 0) {
                    scanner = new Instascan.Scanner({
                        video: document.getElementById('preview'),
                        mirror: false
                    });

                    scanner.addListener('scan', (content) => {
                        scanner.stop();
                        processScan(content);
                    });

                    scanner.start(cameras[0]);
                } else {
                    alert('Kamera tidak tersedia!');
                    modal.hide();
                }
            });

            modal._element.addEventListener('hidden.bs.modal', () => {
                if(scanner) scanner.stop();
            });
        });
    </script>

    <script>
        // Simpan daftar bulan secara global
        const monthsList = {
            1: 'Januari',
            2: 'Februari',
            3: 'Maret',
            4: 'April',
            5: 'Mei',
            6: 'Juni',
            7: 'Juli',
            8: 'Agustus',
            9: 'September',
            10: 'Oktober',
            11: 'November',
            12: 'Desember'
        };

        // Fungsi untuk mengambil data bulan berdasarkan tahun
        function fetchMonthData() {
            const yearSelect = document.getElementById('year-select');
            const selectedYear = yearSelect.value;
            const idPelanggan = document.getElementById('idpel').value;
            // const idPelanggan = '17398731436390';

            // Reset pilihan bulan dan tampilan
            document.getElementById('selectedMonth').value = '';
            document.querySelectorAll('.month-tile').forEach(tile => {
                tile.classList.remove('selected');
            });

            // Tidak melakukan apa-apa jika tahun belum dipilih
            if (!selectedYear) {
                document.getElementById('month-container').style.display = 'none';
                document.getElementById('next-btn').disabled = true;
                return;
            }

            // Tampilkan tahun yang dipilih dan simpan ke hidden input
            document.getElementById('displayed-year').textContent = selectedYear;
            document.getElementById('selectedYear').value = selectedYear;

            // Tampilkan loading
            document.getElementById('month-container').style.display = 'block';
            const monthGrid = document.querySelector('.month-grid');
            monthGrid.innerHTML = '<div class="text-center w-100 py-5"><div class="spinner-border text-primary"></div><p class="mt-2">Memuat data bulan...</p></div>';

            // Ambil data bulan yang sudah diisi dari server
            fetch(`/get-filled-months?tahun=${selectedYear}&id_pelanggan=${idPelanggan}`, {
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                // Reset month grid
                monthGrid.innerHTML = '';

                // Render bulan-bulan
                for (let i = 1; i <= 12; i++) {
                    const isDisabled = data.filledMonths.includes(i);
                    const monthTile = document.createElement('div');
                    monthTile.className = `month-tile ${isDisabled ? 'disabled' : ''}`;
                    monthTile.dataset.value = i;
                    monthTile.textContent = monthsList[i];

                    // Jika tidak disabled, tambahkan event listener
                    if (!isDisabled) {
                        monthTile.addEventListener('click', function() {
                            selectMonth(this, i);
                        });
                    }

                    monthGrid.appendChild(monthTile);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                monthGrid.innerHTML = '<div class="alert alert-danger w-100">Gagal memuat data bulan. Silahkan coba lagi.</div>';
            });
        }

        function selectMonth(element, monthValue) {
            if (element.classList.contains('disabled')) {
                return; // Fungsi langsung keluar tanpa melakukan apa-apa
            }

            // Hapus kelas selected dari semua tile
            document.querySelectorAll('.month-tile').forEach(tile => {
                tile.classList.remove('selected');
            });

            // Tambahkan kelas selected ke tile yang dipilih
            element.classList.add('selected');

            // Isi nilai input hidden
            document.getElementById('selectedMonth').value = monthValue;
        }
    </script>

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
        // Tambahkan di bagian script
        $(document).ready(function() {
            // Inisialisasi stepper
            var stepper = document.querySelector('.bs-stepper');
            var bsStepper = new Stepper(stepper);

            // Handler untuk tombol edit
            $('.editBtn').on('click', function() {
                const id = $(this).data('id');

                // Fetch detail data
                $.ajax({
                    url: `/catat/detail/${id}`,
                    method: 'GET',
                    success: function(response) {
                        console.log(response.data);

                        if(response.status === 'success') {
                            const data = response.data;

                            $('#idpel').val(data.no_meter);
                            removeDisable('btnnextidpel');
                            $('#nama').val(data.nama);
                            if(data.bulan < 10) {
                                $('#bulanpenggunaan').val('0'+data.bulan+'/'+data.tahun);
                            }else {
                                $('#bulanpenggunaan').val(data.bulan+'/'+data.tahun);
                            }

                            $('#bulan').val(data.bulan);
                            $('#tahun').val(data.tahun);

                            $('#meterawal').val(data.meter_awal);
                            $('#meterakhir').val(data.meter_akhir);
                            $('#tglcek').val(data.tgl_cek);

                            // $('#idpel').val(data.id_pelanggan);
                            // $('#idpel').data('isUpdate', true); // Tandai sebagai update
                            // $('#idpel').data('updateId', data.id);



                            // Isi form dengan data
                            // $('#idpel').val(data.id_pelanggan);
                            // $('#idpel').data('isUpdate', true); // Tandai sebagai update
                            // $('#idpel').data('updateId', data.id);

                            // Set tahun dan bulan
                            // $('#year-select').val(data.tahun);
                            // $('#selectedMonth').val(data.bulan);
                            // $('#selectedYear').val(data.tahun);

                            // Isi form step 3
                            // $('#meterawal').val(data.meter_awal);
                            // $('#meterakhir').val(data.meter_akhir);
                            // $('#tglcek').val(data.tgl_cek);

                            // Set detail pelanggan

                            // Set checkbox meteran rusak
                            $('#flexSwitchCheckChecked').prop('checked', data.is_rusak === 1);

                            // Update form action untuk update
                            $('#storeform').attr('action', `/catat/update/${data.id}`);

                            // Tambahkan method PUT
                            if($('#method-put').length === 0) {
                                $('#storeform').append('<input type="hidden" name="_method" value="PUT" id="method-put">');
                            }

                            // Pindah ke step 3
                            bsStepper.to(2);
                        }
                    },
                    error: function() {
                        alert('Gagal mengambil data');
                    }
                });
            });
        });

    </script>

    <script>
        function removeDisable(id) {
            const element = document.getElementById(id);
            element.classList.remove('disabled');
        }
    </script>
@endsection
