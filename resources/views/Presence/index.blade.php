@extends('layouts.app')

@section('content')
@livewire('scan')
<div class="container justify-content-center align-items-center d-flex mt-5">
    <div class="card mb-3" style="max-width: 540px;">
        @livewire('status-info')
        @livewire('attendance-profile')
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        {{-- <table class="table table-striped mt-5">
            <thead>
                <tr class="table-striped">
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Jurusan</th>
                    <th>Waktu Kehadiran</th>
                    <th>Status</th>
                    @role('Admin')
                        <th>Action</th>
                    @endrole
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
                            {{ \Carbon\Carbon::parse($student->presences->first()->created_at)->format('H:i A')}}
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
                    <!-- Button trigger modal -->
                    @role('Admin')
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#{{$student->id}}Modal">
                            Details
                        </button>
                    </td>
                    @endrole
                </tr>
                @empty
                    <p>Siswa Tidak Ditemukan!</p>
                @endforelse
            </tbody>
        </table> --}}
        @livewire('main-monitor',['refreshMode' => 'refreshStudents'])
    </div>
</div>

@role('Admin')
    <div class="modal" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
        @livewire('details-info')
    </div>
@endrole
@endsection