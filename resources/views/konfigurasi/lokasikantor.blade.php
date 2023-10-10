@extends('layouts.admin.tabler')
@section('content')
<div class="page-header d-print-none">
<div class="container-xl">
    <div class="row g-2 align-items-center">
        <div class="col">
            <h2 class="page-title">
            Konfigurasi Lokasi Kantor
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
            <form action="/konfigurasi/updatelokasikantor" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12">
                                    <div class="input-icon mb-3">
                                        <span class="input-icon-addon">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-current-location" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                                                <path d="M12 12m-8 0a8 8 0 1 0 16 0a8 8 0 1 0 -16 0"></path>
                                                <path d="M12 2l0 2"></path>
                                                <path d="M12 20l0 2"></path>
                                                <path d="M20 12l2 0"></path>
                                                <path d="M2 12l2 0"></path>
                                            </svg>
                                        </span>
                                        <input type="text" value="{{ $lok_kantor->lokasi_kantor }}" class="form-control" placeholder="Lokasi Kantor" id="lokasi_kantor" name="lokasi_kantor" required autocomplete="off"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12">
                                    <div class="input-icon mb-3">
                                        <span class="input-icon-addon">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-flightradar24" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                                <path d="M12 12m-5 0a5 5 0 1 0 10 0a5 5 0 1 0 -10 0"></path>
                                                <path d="M8.5 20l3.5 -8l-6.5 6"></path>
                                                <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
                                            </svg>
                                        </span>
                                        <input type="text" value="{{ $lok_kantor->radius }}" class="form-control" placeholder="Radius Kantor" id="lokasi_kantor" name="radius" required autocomplete="off"/>
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