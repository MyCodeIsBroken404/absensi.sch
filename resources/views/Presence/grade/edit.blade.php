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
                      <h3>Form Edit Grade</h3>
                    </div>
                    
                    <form action="{{ route('grade.update', $grade->id)}}" method="POST"  enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="name">{{__('Name') }}</label>
                            <input type="text" name="name" class="form-control" value="{{ $grade->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="grade">{{__('Grade') }}</label>
                            <input type="text" name="grade" class="form-control" value="{{ $grade->grade }}" required>
                        </div>
                        </div>
                        <div class="mt-2">
                             <button type="submit" class="btn btn-primary" href=""> {{ __('Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
   </div>
@endsection