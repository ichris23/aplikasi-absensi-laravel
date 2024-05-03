@extends('layouts.admin.tabler')
@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
        <div class="col">
            <h2 class="page-title">
                Data Karyawan
            </h2>
        </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">  
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                @if (Session::get('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if (Session::get('failed'))
                                    <div class="alert alert-danger">
                                        {{ session('failed') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <a href="#" class="btn btn-success mb-3" id="btnTambahKaryawan">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M12 5l0 14"></path>
                                        <path d="M5 12l14 0"></path>
                                    </svg>Tambah Data
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <form action="/karyawan" method="GET">
                                <div class="col-12">
                                    <div class="form-group">
                                        <input type="text" class ="form-control" placeholder="Cari Karyawan" name="nama_karyawan" id="nama_karyawan" value="{{ Request('nama_karyawan') }}" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-4 mt-3">
                                    <div class="form-group">
                                        <select name="kode_dept" id="kode_dept" class="form-select">
                                            <option value="">Departemen</option>
                                            @foreach ($departemen as $d)
                                                @if (Request('kode_dept') == $d->kode_dept)   
                                                    <option value="{{ $d->kode_dept }}" selected>{{ $d->nama_dept }}</option>
                                                @else
                                                    <option value="{{ $d->kode_dept }}">{{ $d->nama_dept }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3 mt-3">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary d-flex align-items-center justify-content-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                                <path d="M21 21l-6 -6"></path>
                                            </svg> 
                                            Cari
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive col-lg-12">
                            <table class="table table-striped table-xl">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nomor Karyawan</th>
                                        <th>Nama</th>
                                        <th>Jabatan</th>
                                        <th>Nomor HP</th>
                                        <th>Foto</th>
                                        <th>Departemen</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($karyawan as $d)
                                    @php
                                        $path = Storage::url('uploads/karyawan/'.$d->foto);
                                    @endphp
                                        <tr>
                                            <td>{{ $loop->iteration + $karyawan->firstItem() -1 }}</td>
                                            <td>{{ $d->nik }}</td>
                                            <td>{{ $d->nama_lengkap }}</td>
                                            <td>{{ $d->jabatan }}</td>
                                            <td>{{ $d->no_hp }}</td>
                                            <td>
                                                @if (empty($d->foto))    
                                                <img src="assets/img/sample/avatar/avatar1.jpg " class="avatar" alt="foto-karyawan">
                                                @else
                                                <img src="{{ url($path) }}" class="avatar" alt="foto-karyawan">
                                                @endif
                                            </td>
                                            <td>{{ $d->nama_dept }}</td>
                                            <td>
                                                <a href ="#" class="edit btn" nik="{{ $d->nik }}"><i class="bi bi-pencil" style="font-size: 1.25rem; color: green;"></i></a>
                                                <form action="/karyawan/delete/{{ $d->nik }}" method="post" class="d-inline">
                                                    @method('delete')
                                                    @csrf
                                                    <button class="btn px-2 border-0" onclick="return confirm('Are you sure?')"><i class="bi bi-trash" style="font-size: 1.25rem; color: red;"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                                {{ $karyawan->links() }}
                            
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal modal-blur fade" id="modal-inputkaryawan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Karyawan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/karyawan/store" method="POST" id="frmKaryawan" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-id-badge-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M7 12h3v4h-3z"></path>
                                        <path d="M10 6h-6a1 1 0 0 0 -1 1v12a1 1 0 0 0 1 1h16a1 1 0 0 0 1 -1v-12a1 1 0 0 0 -1 -1h-6"></path>
                                        <path d="M10 3m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v3a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z"></path>
                                        <path d="M14 16h2"></path>
                                        <path d="M14 12h4"></path>
                                    </svg>
                                </span>
                                <input type="text" value="" class="form-control" placeholder="Nomor Karyawan" name="nik" required autocomplete="off" minlength="3" oninvalid="this.setCustomValidity('Mohon masukkan Nomor Karyawan dengan valid')" oninput="this.setCustomValidity('')" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                    </svg>
                                </span>
                                <input type="text" value="" class="form-control" placeholder="Nama Lengkap" name="nama_lengkap" autocomplete="off" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-laptop" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M3 19l18 0"></path>
                                        <path d="M5 6m0 1a1 1 0 0 1 1 -1h12a1 1 0 0 1 1 1v8a1 1 0 0 1 -1 1h-12a1 1 0 0 1 -1 -1z"></path>
                                    </svg>
                                </span>
                                <input type="text" value="" class="form-control" placeholder="Jabatan" name="jabatan" autocomplete="off" required/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-phone-call" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2"></path>
                                        <path d="M15 7a2 2 0 0 1 2 2"></path>
                                        <path d="M15 3a6 6 0 0 1 6 6"></path>
                                    </svg>
                                </span>
                                <input type="text" value="" class="form-control" placeholder="Nomor HP" name="no_hp" autocomplete="off" required minlength="11" oninvalid="this.setCustomValidity('Mohon masukkan Nomor HP dengan panjang minimal 11 karakter.')" oninput="this.setCustomValidity('')" />
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-label">Foto</div>
                        <input type="file" name="foto" class="form-control" >
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <select name="kode_dept" id="kode_dept" class="form-select mb-3">
                                <option value="" requried>Departemen</option>
                                @foreach ($departemen as $d)
                                    @if (Request('kode_dept') == $d->kode_dept)   
                                        <option value="{{ $d->kode_dept }}" selected>{{ $d->nama_dept }}</option>
                                    @else
                                        <option value="{{ $d->kode_dept }}">{{ $d->nama_dept }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <button class="btn btn-primary w-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-telegram" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M15 10l-4 4l6 6l4 -16l-18 7l4 2l2 6l3 -4"></path>
                                    </svg>
                                    Simpan Data
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Edit Modal --}}
<div class="modal modal-blur fade" id="modal-editkaryawan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Karyawan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="loadeditform">
                
            </div>
        </div>
    </div>
</div>
@endsection

@push('myscript')
<script>
    $(function(){
        $('#btnTambahKaryawan').click(function(){
            $('#modal-inputkaryawan').modal("show");
        });

        $(".edit").click(function(){
            var nik = $(this).attr('nik');
            $.ajax({
                type: 'POST',
                url: '/karyawan/edit',
                cache: false,
                data: {
                    _token: "{{ csrf_token(); }}",
                    nik: nik
                },
                success:function(respond){
                    $("#loadeditform").html(respond);
                }
            });
            $('#modal-editkaryawan').modal("show");
        });

        $(".delete-confirm").click(function(e){
            e.preventDefault();
        });
    });
</script>
@endpush