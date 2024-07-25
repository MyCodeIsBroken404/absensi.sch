@extends('layouts.app')

@section('content')
        
<div class="row justify-content-center">
    <div class="col-md-8">
        <table class="table table-striped mt-5">
            <thead>
                <tr class="table-striped">
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Jurusan</th>
                    <th>Action</th>
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
                        <a href="{{ route('monitor.show',$student->id) }}" class="btn btn-primary">Show</a>
                        <a href="{{ route('report.siswa',$student->id) }}" class="btn btn-secondary">Print</a>
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