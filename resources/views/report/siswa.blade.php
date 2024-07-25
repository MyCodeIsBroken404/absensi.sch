<html>
    <head>
        <title>Record Kehadiran {{$student->name}} {{$student->grade->grade . ' - ' . $student->grade->name}} diambil pada tanggal {{$dT}}</title>
    </head>
    <body>
        <br>
        <h1>Record Kehadiran {{$student->name}} {{$student->grade->grade . ' - ' . $student->grade->name}} diambil pada tanggal {{$dT}}</h1>
        <br>
        <table>
            <thead>
                <th>Tanggal</th>
                <th>Masuk Pukul</th>
                <th>Status</th>
            </thead>
            <tbody>
                @forelse ($student->presences as $presence)
                    <tr>
                        @php
                            \Carbon\Carbon::setLocale('id');
                            $ca = $presence->created_at;
                            $tf = \Carbon\Carbon::parse($ca);
                            $stf = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$tf->format('Y-m-d').' 07:00:00');
                            $diff = $tf->diff($stf);
                            $diffInMinutes = $diff->h*60 + $diff->i;
                        @endphp
                        <td>{{$tf->translatedFormat('l d M Y')}}</td>
                        <td>{{$tf->format('H:i A')}}</td>
                        <td>
                            @if ($tf->lessThan($stf))
                                Tepat Waktu
                            @else
                                Telat {{$diffInMinutes}} Menit
                            @endif
                        </td>
                    </tr>
                @empty
                    <p>Data Siswa Tidak Ditemukan</p>
                @endforelse
            </tbody>
        </table>
    </body>
</html>