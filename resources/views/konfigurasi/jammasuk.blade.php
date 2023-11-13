@extends('layouts.admin.tabler')
@section('content')
<div class="page-header d-print-none">
<div class="container-xl">
    <div class="row g-2 align-items-center">
        <div class="col">
            <h2 class="page-title">
            Konfigurasi Jam Masuk
            </h2>
        </div>
    </div>
</div>
</div>
<div class="page-body">
<div class="container-xl">
    <div class="row">
    <div class="col-6">
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
        <div class="card">
        <div class="card-body">
            <form action="/konfigurasi/updatejammasuk" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12">
                                    <div class="input-icon mb-3">
                                        <span class="input-icon-addon">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alarm-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M16 6.072a8 8 0 1 1 -11.995 7.213l-.005 -.285l.005 -.285a8 8 0 0 1 11.995 -6.643zm-4 2.928a1 1 0 0 0 -1 1v3l.007 .117a1 1 0 0 0 .993 .883h2l.117 -.007a1 1 0 0 0 .883 -.993l-.007 -.117a1 1 0 0 0 -.993 -.883h-1v-2l-.007 -.117a1 1 0 0 0 -.993 -.883z" stroke-width="0" fill="currentColor"></path>
                                                <path d="M6.412 3.191a1 1 0 0 1 1.273 1.539l-.097 .08l-2.75 2a1 1 0 0 1 -1.273 -1.54l.097 -.08l2.75 -2z" stroke-width="0" fill="currentColor"></path>
                                                <path d="M16.191 3.412a1 1 0 0 1 1.291 -.288l.106 .067l2.75 2a1 1 0 0 1 -1.07 1.685l-.106 -.067l-2.75 -2a1 1 0 0 1 -.22 -1.397z" stroke-width="0" fill="currentColor"></path>
                                            </svg>
                                        </span>
                                        <input type="text" value="{{ $jam_masuk->jam }}" class="form-control" placeholder="Jam Masuk" id="jam" name="jam" required autocomplete="off"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button class="btn btn-primary w-100">
                                    Update
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        </div>
    </div>
    </div>
</div>
</div>
@endsection