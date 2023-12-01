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
                <img src="/assets/img/sample/avatar/avatar1.jpg" alt="avatar" class="imaged rounded w-6">
            @endif
        </td>
        <td>
            @if ($d->jam_in >= $jam_masuk->jam)
            @php
                $jamterlambat = selisih($jam_masuk->jam,$d->jam_in)
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