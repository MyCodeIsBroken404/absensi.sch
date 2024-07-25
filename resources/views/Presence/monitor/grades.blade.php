@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 text-center">
        <h1>Kelas {{$grade->grade . ' - ' . $grade->name}}</h1>
        
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-md-8">
        <table class="table table-striped mt-5">
            <thead>
                <tr class="table-striped">
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Jurusan</th>
                    <th>Waktu Kehadiran</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($students as $student)
                <tr>
                    <td><img src='{{asset('/images/'.$student->image)}}' class="img-fluid rounded-circle" width="50"></td>
                    <td>{{$student->name}}</td>
                    <td>{{$student->grade->grade}}</td>
                    <td>{{$student->grade->name}}</td>
                    <td>
                        @if ($student->presences->isNotEmpty())
                            {{ \Carbon\Carbon::parse($student->presences->first()->created_at)->setTimezone('Asia/Jakarta')->format('H:i A')}}
                        @else
                            -
                        @endif
                    </td>
                    <td><span class="badge text-bg-success">
                            @if ($student->presences->isNotEmpty())
                            @php
                                $stdTime = $student->presences->first()->created_at;
                                $tf = \Carbon\Carbon::parse($stdTime);
                                $stf = \Carbon\Carbon::createFromFormat('H:i','07:00');
                                $diff = $stf->diff($tf);
                                $diffInMinutes = $diff->h * 60 + $diff->i;
                            @endphp
                            @if ($tf->lessThan($stf))
                                Tepat Waktu
                            @else
                                Telat ({{$diffInMinutes}} Menit)
                            @endif
                        @else
                            Tidak Hadir
                        @endif
                    </span></td>
                </tr>
                @empty
                    <p>Siswa Tidak Ditemukan!</p>
                @endforelse
            </tbody>
        </table>
        <a href="{{ route('report.kelas',[$grade->id,\Carbon\Carbon::today()->toDateString()]) }}" class='btn btn-secondary'>Print</a>
        
    </div>
</div>


<script>
    // Function to get scroll position
    function getScrollPosition() {
        return window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;
    }

    // Function to set scroll position
    function setScrollPosition(position) {
        document.documentElement.scrollTop = position;
        document.body.scrollTop = position;
    }

    // Save the scroll position before reloading
    setInterval(function() {
        localStorage.setItem('scrollPosition', getScrollPosition());
        location.reload();
    }, 10000); // 10000 milliseconds = 10 seconds

    // Restore the scroll position after reloading
    window.onload = function() {
        var scrollPosition = localStorage.getItem('scrollPosition');
        if (scrollPosition !== null) {
            setScrollPosition(scrollPosition);
            localStorage.removeItem('scrollPosition'); // Remove it after restoring
        }
    };
</script>
@endsection