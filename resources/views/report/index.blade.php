<html>
    <head>
        <title>Kehadiran Siswa {{$dT}}</title>
    </head>
    <body>
        <br>
        <h1>Kehadiran Siswa {{$dT}}</h1>
        <br>
        <table>
            <thead>
                <th>#</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Datang Pukul</th>
                <th>Status</th>
            </thead>
            <tbody>
                @forelse ($students as $student)
                    <tr>
                        <td>{{$student->id}}</td>
                        <td>{{$student->name}}</td>
                        <td>{{$student->grade->grade . ' - '. $student->grade->name}}</td>
                        @if ($student->presences->first())
                            @php
                                $ca = $student->presences->first()->created_at;
                                $tf = \Carbon\Carbon::parse($ca);
                                $stf = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$tf->format('Y-m-d') .' 07:00:00');
                                $diff = $tf->diff($stf);
                                $diffInMinutes = $diff->h*60 + $diff->i;
                            @endphp
                            <td>{{$tf->format('H:i A')}}</td>
                            @if ($tf->lessThan($stf))
                                <td>Tepat Waktu</td>
                            @else
                                <td>Telat {{$diffInMinutes}} Menit</td>
                            @endif
                        @else
                            <td> - </td>
                            <td>Tidak Hadir</td>
                        @endif
                    </tr>
                @empty
                    <p>Data Siswa Tidak Ditemukan</p>
                @endforelse
            </tbody>
        </table>
    </body>
</html>