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
@foreach ($presensi as $d)
@php
    $foto_in = Storage::url('uploads/absensi/'.$d->foto_in);
    $foto_out = Storage::url('uploads/absensi/'.$d->foto_out);
@endphp
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $d->nik }}</td>
        <td>{{ $d->nama_lengkap }}</td>
        <td>{{ $d->nama_dept }}</td>
        <td>{{ $d->jam_in }}</td>
        <td><img src="{{ url($foto_in) }}" class="avatar" alt=""></td>
        <td>
            {!! $d->jam_out != null ? $d->jam_out : '<span class="badge bg-danger">Belum Absen Pulang' !!}
        </td>
        <td>
            @if($d->jam_out != null )
                <img src="{{ url($foto_out) }}" class="avatar" alt="">
            @else
                <img src="assets/img/sample/avatar/avatar1.jpg" alt="avatar" class="imaged w64 rounded">
            @endif
        </td>
        <td>
            @if ($d->jam_in >= '07:00')
            @php
                $jamterlambat = selisih('07:00:00',$d->jam_in)
            @endphp
                <span class="badge bg-danger">Terlambat {{ $jamterlambat }}</span>
                @else
                <span class="badge bg-success">Tepat Waktu</span>
            @endif
        </td>
        <td class="text-center">
        <a href="#" class="btn tampilkanpeta" id="{{ $d->id }}"> <i class="mb-3 bi bi-geo-alt-fill" style="font-size: 1.25rem; color: red;"></i></a>
        </td>
    </tr>
@endforeach

<script>
    $(function(){
        $(".tampilkanpeta").click(function(e){
            var id = $(this).attr("id");
            $.ajax({
                type: 'POST',
                url: '/tampilkanpeta',
                data: {
                    _token:"{{ csrf_token() }}",
                    id: id
                },
                cache: false,
                success:function(respond){
                    $("#loadmap").html(respond);
                }
            });
            $("#modal-tampilkanpeta").modal("show");
        });
    });
</script>