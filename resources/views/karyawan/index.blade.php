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
                                        <td>{{ $loop->iteration }}</td>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection