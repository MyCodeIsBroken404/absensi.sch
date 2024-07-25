@extends('layouts.app')

@section('content')
        
<div class="mt-5 row justify-content-center">
    <div class="col-md-6 text-center">
        <img src="{{asset('/images/'.$student->image)}}" class='img-fluid rounded-start' width="150">
        <h3>{{$student->name}}</h3>
        <p>{{$student->grade->grade . ' - ' . $student->grade->name}}</p>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-md-8">
        <table class="table table-striped mt-5">
            <thead>
                <tr class="table-striped">
                    <th>Tanggal</th>
                    <th>Datang Pukul</th>
                    <th>Status</th>
                </tr>
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
                    <p>Siswa Tidak Ditemukan!</p>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection