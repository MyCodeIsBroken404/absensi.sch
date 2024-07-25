@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <table class="table table-striped mt-5">
            <thead>
                <tr>
                    <th>Grade</th>
                    <th>Name</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($grades as $grade)
                <tr>
                    <td>{{$grade->grade}}</td>
                    <td>{{$grade->name}}</td>
                    <!-- Button trigger modal -->
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#{{$grade->id}}Modal">
                            Details
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>    
        </table>
    </div>
</div>

<!-- Modal -->
@foreach ($grades as $grade)
<div class="modal fade" id="{{$grade->id}}Modal" tabindex="-1" aria-labelledby="{{$grade->id}}ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="{{$grade->id}}ModalLabel">Data Siswa {{$grade->grade . ' - ' . $grade->name}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class='table'>
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Nama</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($grade->students as $student)
                            <tr>
                                <td><img src="{{asset('/images/'.$student->image)}}" class="img-fluid rounded-start" width="50"></td>
                                <td>{{$student->name}}</td>
                            </tr>
                        @empty
                            <p>Siswa Tidak Ditemukan!</p>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a class="btn btn-primary" href="{{route('grade.edit',$grade->id)}}">Edit</a>
                <form action="{{route('grade.delete',$grade->id)}}" method="POST" class='justify-content-between'>
                @csrf
                @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>           
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection