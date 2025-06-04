@extends('layouts.layout')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('temp/src/plugins/src/table/datatable/datatables.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('temp/src/plugins/css/light/table/datatable/dt-global_style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('temp/src/plugins/css/dark/table/datatable/dt-global_style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('temp/src/plugins/css/dark/table/datatable/custom_dt_miscellaneous.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('temp/src/plugins/css/light/table/datatable/custom_dt_miscellaneous.css')}}">
    <link href="{{asset('temp/src/plugins/src/animate/animate.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('temp/src/assets/css/light/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('temp/src/assets/css/light/components/carousel.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('temp/src/assets/css/light/components/modal.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('temp/src/assets/css/light/components/tabs.css')}}" rel="stylesheet" type="text/css">

    <link href="{{asset('temp/src/assets/css/dark/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('temp/src/assets/css/dark/components/carousel.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('temp/src/assets/css/dark/components/modal.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('temp/src/assets/css/dark/components/tabs.css')}}" rel="stylesheet" type="text/css">

    {{-- <link rel="stylesheet" href="{{asset('temp/src/plugins/src/filepond/filepond.min.css')}}">
    <link rel="stylesheet" href="{{asset('temp/src/plugins/src/filepond/FilePondPluginImagePreview.min.css')}}">
    <link href="{{asset('temp/src/plugins/css/light/filepond/custom-filepond.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('temp/src/plugins/css/dark/filepond/custom-filepond.css')}}" rel="stylesheet" type="text/css" /> --}}
@endsection
@section('content')
    <div id="content" class="main-content">
        <div class="layout-px-spacing">

            <div class="middle-content container-xxl p-0">

                <!-- BREADCRUMB -->
                <div class="page-meta">
                    <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Pelanggan</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Semua Pelanggan</li>
                        </ol>
                    </nav>
                </div>
                <!-- /BREADCRUMB -->

                <div class="row layout-top-spacing">
                    <div class="col-xl-12 col-lg-12 col-sm-12 my-3">
                        <button data-bs-toggle="modal" data-bs-target="#inputFormModal" class="btn btn-primary btn-sm _effect--ripple waves-effect waves-light">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        </button>
                    </div>
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
                                        {{-- <th>Tenggang</th> --}}
                                        <th>Kode Tarif</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($customer as $user)
                                        <tr>
                                            <td>
                                                {{$no++}}
                                            </td>
                                            <td>
                                                {{$user->id_pelanggan}}
                                            </td>
                                            <td>
                                                {{$user->no_meter}}
                                            </td>
                                            <td>
                                                @if($user->user)
                                                    {{$user->user->nama}}
                                                @else
                                            </td>
                                            <td>
                                                @if ($user->alamat)
                                                    {{$user->alamat->nama_alamat}}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($user->tarif)
                                                    {{$user->tarif->kode}}

                                                @endif
                                            </td>
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
                                                        <li><a class="dropdown-item" href="{{route('customer.allshow', $user->id)}}">View</a></li>
                                                        <li><a class="dropdown-item" href="javascript:void(0);"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#editForm"
                                                            data-id="{{ $user->id }}"
                                                            data-idpelanggan="{{ $user->id_pelanggan }}"
                                                            data-nama="{{ $user->user->nama }}"
                                                            data-alamat="{{ $user->alamat_id }}"
                                                            data-tarif = "{{$user->tarif_id}}"
                                                            data-meter = "{{$user->no_meter}}"
                                                            >Edit</a></li>
                                                        <li><a class="dropdown-item btndelete" href="javascript:void(0);" data-id="{{$user->id}}" data-nama="{{$user->user->nama}}">Delete</a></li>
                                                    </ul>
                                                </div>
                                            </td>
                                            {{-- <td>
                                                <a class="btn btn-info btn-sm _effect--ripple waves-effect waves-light edit-btn"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editForm"
                                                    data-id="{{ $user->id }}"
                                                    data-idpelanggan="{{ $user->id_pelanggan }}"
                                                    data-nama="{{ $user->user_id }}"
                                                    data-alamat="{{ $user->alamat_id }}"
                                                    data-tarif="{{ $user->tarif_id }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                        </svg>
                                                </a>
                                                <a class="btn btn-danger btn-sm _effect--ripple waves-effect waves-light btndelete" id="btndelete{{$user->id}}" data-id="{{$user->id}}" data-nama="{{$user->nama}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                                </a>
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </div>

        </div>

        <!--  BEGIN FOOTER  -->
        <div class="footer-wrapper mt-0">
            <div class="footer-section f-section-1">
                <p class="">Copyright © <span class="dynamic-year">2024</span> <a target="_blank" href="https://designreset.com/equation/">DesignReset</a>, All rights reserved.</p>
            </div>
            <div class="footer-section f-section-2">
                <p class="">Coded with <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg></p>
            </div>
        </div>
        <!--  END CONTENT AREA  -->
    </div>

    <!-- Modal -->
    <div class="modal fade inputForm-modal" id="inputFormModal" tabindex="-1" role="dialog" aria-labelledby="inputFormModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">

            <div class="modal-header" id="inputFormModalLabel">
                <h5 class="modal-title">Tambah Customer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
            </div>
            <form class="mt-0" action='{{route('customer.allstore')}}' method="post" id="storeform">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                            </span>
                            <input type="text" class="form-control" placeholder="ID Pelanggan (Kosongi jika ingin otomatis dari sistem)" aria-label="email" name="idpel">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                            </span>
                            <input type="text" class="form-control" placeholder="Nama Pelanggan" aria-label="email" name="nama">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
                            </span>
                            <input type="text" class="form-control" placeholder="Nomor Meter" aria-label="email" name="no_meter">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                            </span>
                            <select name="alamat" class="form-control">
                                <option value="">Pilih Alamat</option>
                                @foreach ($alamat as $a)
                                    <option value="{{$a->id}}">{{$a->nama_alamat}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <span class="input-group-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                            </span>
                            <select name="tarif" class="form-control" id="pilihtambahtarif" data-api-endpoint="/get-tarif">
                                <option value="">Pilih Tarif</option>
                            </select>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    {{-- <button type="submit" class="btn btn-primary mt-2 mb-2 btn-no-effect">
                        Simpan
                        <div class="spinner-border text-white me-2 align-self-center loader-sm "></div>
                    </button> --}}
                    <button class="btn btn-light-danger btn-lg mb-2 me-4 btn-no-effect" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    {{-- <button class="btn btn-primary btn-lg mb-2 me-4 btn-no-effect" disabled>
                        <div class="spinner-border spinner-border-sm text-white align-self-center"></div> Loading
                    </button> --}}
                    <button type="submit" class="btn btn-primary btn-lg mb-2 me-4" id="saveBtn">
                        Simpan
                    </button>

                </div>
            </form>
          </div>
        </div>
    </div>

    <div class="modal fade inputForm-modal" id="editForm" tabindex="-1" role="dialog" aria-labelledby="editFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" id="editFormLabel">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                </div>
                <form class="mt-0" method="post" id="editform" action="{{route('customer.allupdate')}}">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="id" id="idedit">
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <span class="input-group-text">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                </span>
                                <input type="text" class="form-control" placeholder="Nama Pelanggan" name="nama" id="namaedit">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <span class="input-group-text">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
                                </span>
                                <input type="text" class="form-control" placeholder="Nomor Meter" aria-label="email" name="no_meter" id="no_meter">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <span class="input-group-text">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                </span>
                                <select name="alamatedit" class="form-control" onchange="updateTarifOptions(this.value)" id="alamatedit">
                                    <option value="">Pilih Alamat</option>
                                    @foreach ($alamat as $a)
                                        <option value="{{$a->id}}">{{$a->nama_alamat}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group mb-3">
                                <span class="input-group-text">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                                </span>
                                <select name="tarif" class="form-control" id="pilihEdittarif">
                                    <option value="">Pilih Tarif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-danger" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="saveBtnedit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
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
        $(document).on('click', '.edit-btn', function() {
            // Ambil data dari atribut data-* pada tombol yang diklik
            var id = $(this).data('id');
            var nama = $(this).data('nama');
            var username = $(this).data('username');
            var no_telp = $(this).data('no_telp');
            var role = $(this).data('role');

            // Isi modal dengan data yang sesuai
            $('#editForm #iduser').val(id);
            $('#editForm #nama').val(nama);
            $('#editForm #username').val(username);
            $('#editForm #no_telp').val(no_telp);
            $('#editForm #role').val(role);

            // Pastikan form action diarahkan ke route yang sesuai dengan id
        });
    </script>
    <script>
        $(document).ready(function() {
        $('#saveBtn').on('click', function() {
            // Menonaktifkan tombol dan mengganti teksnya dengan spinner
            $(this).prop('disabled', true);  // Nonaktifkan tombol
            $(this).html('<div class="spinner-border spinner-border-sm text-white align-self-center"></div> Loading');  // Ganti tombol dengan spinner

            // Lakukan aksi lain, misalnya submit form atau proses lainnya
            setTimeout(function() {
                // Setelah proses selesai, kembalikan tombol dan teks
                $('#saveBtn').prop('disabled', false);  // Mengaktifkan kembali tombol
                $('#saveBtn').html('Simpan');  // Kembalikan teks tombol
            }, 10000); // Durasi simulasi loading 3 detik
            document.getElementById('storeform').submit();
        });
    });

    </script>
    <script>
        $(document).ready(function() {
        $('#saveBtnedit').on('click', function() {
            // Menonaktifkan tombol dan mengganti teksnya dengan spinner
            $(this).prop('disabled', true);  // Nonaktifkan tombol
            $(this).html('<div class="spinner-border spinner-border-sm text-white align-self-center"></div> Loading');  // Ganti tombol dengan spinner

            // Lakukan aksi lain, misalnya submit form atau proses lainnya
            setTimeout(function() {
                // Setelah proses selesai, kembalikan tombol dan teks
                $('#saveBtn').prop('disabled', false);  // Mengaktifkan kembali tombol
                $('#saveBtn').html('Simpan');  // Kembalikan teks tombol
            }, 10000); // Durasi simulasi loading 3 detik
            document.getElementById('editform').submit();
        });
    });

    </script>
    <script>
        $(document).ready(function(){
            $('.btndelete').on('click', function(){
            var id = $(this).data('id');
            var nama = $(this).data('nama');
            Swal.fire({
                title: "Apakah kamu yakin ingin menghapus akun " + nama + " ?",
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
                        url: '/pelannggan/' + id + '/destroy', // Ganti dengan URL endpoint penghapusan di server
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Menambahkan CSRF token
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Akun " + nama + " berhasil dihapus.",
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
        document.querySelector('[name="alamat"]').addEventListener('change', function() {
            const selectedRole = this.value;
            updateTarifOptions(selectedRole, 'pilihtambahtarif');
        });
        document.querySelector('[name="alamatedit"]').addEventListener('change', function() {
            const selectedRole = this.value;
            updateTarifOptions(selectedRole, 'pilihEdittarif');
        });
        $(document).ready(function() {
            // Event handler untuk tombol edit
            $('.dropdown-item[data-bs-toggle="modal"]').on('click', function() {
                // Ambil data dari atribut data-*
                var id = $(this).data('id');
                var idPelanggan = $(this).data('idpelanggan');
                var nama = $(this).data('nama');
                var alamat = $(this).data('alamat');
                var tarif = $(this).data('tarif');
                var meter = $(this).data('meter');

                // Isi form dengan data yang diambil
                $('#editForm #idedit').val(id);
                $('#editForm #namaedit').val(nama);

                // Set nilai alamat
                $('#editForm #alamatedit').val(alamat);
                $('#editForm #no_meter').val(meter);

                // Update opsi tarif berdasarkan alamat yang dipilih
                updateTarifOptions(alamat, 'pilihEdittarif');
            });
        });

        function updateTarifOptions(alamat, idselect, selectedValue = null) {
            fetch(`/get-tarif/${alamat}`)
                .then(response => response.json())
                .then(data => {
                    const tarifSelect = document.getElementById(idselect);
                    tarifSelect.innerHTML = '<option value="">Pilih Tarif</option>';

                    data.forEach(item => {
                        const option = new Option(item.kode, item.id);

                        if(item.id == selectedValue) {
                            console.log("Item selected:", item.kode); // Debug: Cek item yang akan diselect
                            option.selected = true;
                        }

                        tarifSelect.add(option);
                    });
                });
        }
    </script>
@endsection
