@extends('layouts.presensi')

@section('header')
<!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="javascript:;" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">Presensi</div>
    <div class="right"></div>
</div>
<!-- * App Header -->
<style>
    .webcam-capture,
    .webcam-capture video {
        display: inline-block;
        width: 100% !important;
        margin: auto;
        height: auto !important;
        border-radius: 15px;
    }
    #map {
        height: 180px;
    }
    @media only screen and (min-width: 543px){
        .webcam-capture,
        .webcam-capture video {
            display: flex;
            width: 75% !important;
            margin: auto;
            height: auto !important;
            border-radius: 15px;
        }
        #map {
            display:flex;
            width: 50% !important;
            height: 70% !important;
            margin: auto;
        }
    }
    @media only screen and (min-width: 716px){
        .webcam-capture,
        .webcam-capture video {
            display: flex;
            width: 49% !important;
            margin: auto;
            height: auto !important;
            border-radius: 15px;
        }
        #map {
            display:flex;
            width: 50% !important;
            height: 70% !important;
            margin: auto;
        }
    }
</style>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
@endsection
@section('content')
<div class="row" style="margin-top:70px;">
    <div class="col">
        @if ($cek > 0)
        <input type="hidden" id="lokasi" disabled readonly>
        <div class="webcam-capture mb-2"></div>
        <div id="map" class="mb-2"></div>
        <button id="takeabsen" class="btn btn-warning btn-block"><ion-icon name="camera-outline"></ion-icon>Absen Pulang</button>
        @else
        <input type="hidden" id="lokasi" disabled readonly>
        <div class="webcam-capture mb-2"></div>
        <div id="map" class="mb-2"></div>
        <button id="takeabsen" class="btn btn-primary btn-block"><ion-icon name="camera-outline"></ion-icon>Absen Masuk</button>
        @endif
    </div>
</div>
@endsection

@push('myscript')
<script>
    Webcam.set({
        height:320,
        width:640,
        image_format:'jpeg',
        jpeg_quality: 80
    });

    Webcam.attach('.webcam-capture');

    var lokasi = document.getElementById('lokasi');
    if (navigator.geolocation){
        navigator.geolocation.getCurrentPosition(successCallBack, errorCallBack);
    }

    function successCallBack(position){
        lokasi.value = position.coords.latitude+ "," +position.coords.longitude;
        var map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 15);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {maxZoom: 19, attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'}).addTo(map);
        var marker = L.marker([position.coords.latitude, position.coords.longitude]).addTo(map);
        var circle = L.circle([position.coords.latitude, position.coords.longitude], {color: 'red',fillColor: '#f03',fillOpacity: 0.5,radius: 20}).addTo(map);
    }    

    function errorCallBack(){
    }

    $("#takeabsen").click(function(e){
        Webcam.snap(function(uri){
            image = uri;
        })
        var lokasi = $("#lokasi").val();
        $.ajax({
           type: 'POST',
            url:'/presensi/store',
            data : {
                _token: "{{ csrf_token() }}",
                image:image,
                lokasi:lokasi
            },
            cache:false,
            success:function(respond){
                var status = respond.split("|")
                if(status[0] == "success"){
                    Swal.fire({
                        title: 'Berhasil!',
                        text: status[1],
                        icon: 'success',
                })
                setTimeout("location.href='/dashboard'", 3000);
                }else{
                    Swal.fire({
                        title: 'Error',
                        text: 'Error Wir!!',
                        icon: 'error',
                })
                }
            }
        });
    });
</script>
@endpush