<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>A4</title>

  <!-- Normalize or reset CSS with your favorite library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

  <!-- Load paper.css for happy printing -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->
  <style>
    @page {
      size: A4
    }

    #title {
      font-family: Arial, Helvetica, sans-serif;
      font-size: 18px;
      font-weight: bold;
    }

    .tabeldatakaryawan {
      margin-top: 40px;
    }

    .tabeldatakaryawan tr td {
      padding: 5px;
    }

    .tabelpresensi {
      width: 100%;
      margin-top: 20px;
      border-collapse: collapse;
    }

    .tabelpresensi tr th {
      border: 1px solid black;
      padding: 8px;
      background-color: lightgrey;
    }

    .tabelpresensi tr td {
      border: 1px solid black;
      padding: 5px;
      font-size: 12px;
    }

    .foto {
      width: 40px;
      height: 30px;
    }
  </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->

<body class="A4">

@php
    function selisih($jam_in, $jam_out)
        {
            list($h, $m, $s) = explode(":", $jam_in);
            $dtAwal = mktime($h, $m, $s, "1", "1", "1");
            list($h, $m, $s) = explode(":", $jam_out);
            $dtAkhir = mktime($h, $m, $s, "1", "1", "1");
            $dtSelisih = $dtAkhir - $dtAwal;
            $totalmenit = $dtSelisih / 60;
            $jam = explode(".", $totalmenit / 60);
            $sisamenit = ($totalmenit / 60) - $jam[0];
            $sisamenit2 = $sisamenit * 60;
            $jml_jam = $jam[0];
            return $jml_jam . ":" . round($sisamenit2);
        }
@endphp

  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
  <section class="sheet padding-10mm">

    <table style="width: 100%">
      <tr>
        <td style="width: 30px">
          <img src="{{ asset('assets/img/logopresensi.png') }}" width="70" height="70" alt="">
        </td>
        <td>
          <span id="title">
            LAPORAN PRESENSI KARYAWAN <br>
            PERIODE {{ strtoupper($namabulan[$bulan]) }} {{ $tahun }} <br>
            CV. ADHITAMA KARYA MANDIRI <br>
          </span>
          <span><i>Jl. Mutiara Citra Asri Blok L4 No.3, Kelurahan Candi, Kabupaten Sidoarjo</i></span>
        </td>
      </tr>
    </table>
    <table class="tabeldatakaryawan">
      <tr>
        <td rowspan="6">
          @php
          $path = Storage::url('uploads/karyawan/'.$karyawan->foto);
          $path2 = Storage::url('uploads/karyawan/avatar1.jpg')
          @endphp
          @if($karyawan->foto)
            <img src="{{ url($path) }}" alt="" width="120px" height="150px">
          @else
            <img src="{{ url($path2) }}" alt="" width="120px" height="150px">
          @endif
        </td>
      </tr>
      <tr>
        <td>NIK</td>
        <td>:</td>
        <td>{{ $karyawan->nik }}</td>
      </tr>
      <tr>
        <td>Nama Karyawan</td>
        <td>:</td>
        <td>{{ $karyawan->nama_lengkap }}</td>
      </tr>
      <tr>
        <td>Jabatan</td>
        <td>:</td>
        <td>{{ $karyawan->jabatan }}</td>
      </tr>
      <tr>
        <td>Departemen</td>
        <td>:</td>
        <td>{{ $karyawan->nama_dept }}</td>
      </tr>
      <tr>
        <td>No. HP</td>
        <td>:</td>
        <td>{{ $karyawan->no_hp }}</td>
      </tr>
    </table>
    <table class="tabelpresensi">
      <tr>
        <th>No.</th>
        <th>Tanggal</th>
        <th>Jam Masuk</th>
        <th>Foto</th>
        <th>Jam Pulang</th>
        <th>Foto</th> 
        <th>Keterangan</th>
        <th>Jumlah Jam</th>
      </tr>
      @foreach ($presensi as $d)
      @php
      $path_in = Storage::url('uploads/absensi/'.$d->foto_in);
      $path_out = Storage::url('uploads/absensi/'.$d->foto_out);
      $jamterlambat = selisih('07:00:00',$d->jam_in);
      @endphp
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ date("d-m-Y",strtotime($d->tgl_presensi)) }}</td>
        <td>{{ $d->jam_in }}</td>
        <td><img src="{{ url($path_in) }}" alt="" class="foto"></td>
        <td>
          {{ $d->jam_out != null ? $d->jam_out : 'Belum Absen' }}
        </td>
        <td>
          @if($d->jam_out != null)
            <img src="{{ url($path_out) }}" alt="" class="foto">
          @else
            <img src="{{ url($path2) }}" alt="" width="120px" height="150px">
          @endif
        </td>
        <td>
          @if ($d->jam_in > '07.00')
          <p style="color: red">Terlambat {{ $jamterlambat }}</p>
          @else
          Tepat Waktu
          @endif
        </td>
        <td>
          @if ($d->jam_out)
            @php
              $jmljamkerja = selisih($d->jam_in,$d->jam_out);
            @endphp
          @else
            @php
              $jmljamkerja = 0;
            @endphp            
          @endif
          {{ $jmljamkerja }}
        </td>
      </tr>
      @endforeach
    </table>
    <table width="100%" style="margin-top: 100px;">
      <tr>
        <td colspan="2" style="text-align: right;">Sidoarjo, {{ date('d-m-Y') }}</td>
      </tr>
      <tr>
        <td style="text-align : center; vertical-align:bottom;" height="130" >
          <u>Manager</u><br>
          <i><b>HRD Maneger</b></i>
        </td>
        <td style="text-align : center; vertical-align:bottom;"  height="130">
          <u>Direktur</u><br>
          <i><b>Direktur</b></i>
        </td>
      </tr>
    </table>
  </section>

</body>

</html>