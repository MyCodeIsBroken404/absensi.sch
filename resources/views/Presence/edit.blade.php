@extends('layouts.app')

@section('content')
<div class="container mt-4 ">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex ">
                    <a class="btn btn-outline-black m-0 " href=""><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                      </svg></a>
                      <h3>Form Edit Student</h3>
                    </div>
                    
                    <form action="{{ route('presence.update', $student->id)}}" method="POST"  enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="rfid">{{__('rfid') }}</label>
                            <input type="text" name="rfid" class="form-control" value="{{ $student->rfid }}" required>
                        </div>
                        <div class="form-group">
                            <label for="name">{{__('name') }}</label>
                            <input type="text" name="name" class="form-control" value="{{ $student->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="grade_id">{{__('kelas')}}</label>
                            <select id="grade_id" class="form-control" name="grade_id" required>
                                @foreach ($grades as $grade)
                                    <option value="{{ $grade->id }}" {{ $student->grade_id == $grade->id ? 'selected' : '' }}>{{ $grade->grade }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tgl_lahir">{{__('Tanggal_lahir')}}</label>
                            <input type="date" name="tgl_lahir" class="form-control" value="{{$student->tgl_lahir}}">
                        </div>
                        <div class="form-group">
                            <label for="alamat">{{__('Alamat')}}</label>
                            <input type="text" name="alamat" class="form-control" value="{{$student->alamat}}" >
                        </div>
                        <div class="form-group">
                            <label for="image">{{__('Image') }}</label>
                            <input type="file" name="image" class="form-control" required>
                            <img src="{{ asset('images/' . $student->image) }}" class="img-fluid rounded-start" alt="..." width="50">
                            
                        </div>
                        <div class="mt-4">
                             <button type="submit" class="btn btn-primary" href=""> {{ __('Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
   </div>
@endsection