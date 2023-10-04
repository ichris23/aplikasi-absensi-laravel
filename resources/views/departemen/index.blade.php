@extends('layouts.admin.tabler')
@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
        <div class="col">
            <h2 class="page-title">
                Departemen
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
                                <a href="#" class="btn btn-success mb-3" id="btnTambahDepartemen">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M12 5l0 14"></path>
                                        <path d="M5 12l14 0"></path>
                                    </svg>Tambah Data
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <form action="/departemen" method="GET">
                                <div class="col-12">
                                    <div class="form-group">
                                        <input type="text" class ="form-control" placeholder="Cari Departemen" name="nama_dept" id="nama_dept" value="{{ Request('nama_dept') }}" autocomplete="off">
                                    </div>
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
                                        <th>Kode Departemen</th>
                                        <th>Nama Departemen</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($departemen as $d)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $d->kode_dept }}</td>
                                            <td>{{ $d->nama_dept }}</td>
                                            <td>
                                                <a href ="#" class="edit btn" kode_dept="{{ $d->kode_dept }}"><i class="bi bi-pencil" style="font-size: 1.25rem; color: green;"></i></a>
                                                <form action="/departemen/delete/{{ $d->kode_dept }}" method="post" class="d-inline">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal untuk tambah data departemen --}}
<div class="modal modal-blur fade" id="modal-inputdepartemen" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Departemen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/departemen/store" method="POST" id="frmDepartemen">
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
                                <input type="text" value="" class="form-control" placeholder="Kode Departemen" name="kode_dept" required autocomplete="off"/>
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
                                <input type="text" value="" class="form-control" placeholder="Nama Departemen" name="nama_dept" autocomplete="off" required/>
                            </div>
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
<div class="modal modal-blur fade" id="modal-editdepartemen" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Departemen</h5>
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
        $('#btnTambahDepartemen').click(function(){
            $('#modal-inputdepartemen').modal("show");
        });

        $(".edit").click(function(){
            var kode_dept = $(this).attr('kode_dept');
            $.ajax({
                type: 'POST',
                url: '/departemen/edit',
                cache: false,
                data: {
                    _token: "{{ csrf_token(); }}",
                    kode_dept: kode_dept
                },
                success:function(respond){
                    $("#loadeditform").html(respond);
                }
            });
            $('#modal-editdepartemen').modal("show");
        });

        $(".delete-confirm").click(function(e){
            e.preventDefault();
        });
    });
</script>
@endpush