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
                            <form action="/karyawan" method="GET">
                                <div class="col-12">
                                    <div class="form-group">
                                        <input type="text" class ="form-control" placeholder="Search" name="nama_karyawan" id="nama_karyawan" value="{{ Request('nama_karyawan') }}" autocomplete="off">
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
                                            Search
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>NIK</th>
                                            <th>Nama</th>
                                            <th>Jabatan</th>
                                            <th>Nomor HP</th>
                                            <th>Foto</th>
                                            <th>Departemen</th>
                                            <th>Action</th>
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
                                                <td></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $karyawan->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection