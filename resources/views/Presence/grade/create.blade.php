@extends('layouts.app')

@section('content')
<div class="container mt-4 ">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex ">
                    <a class="btn btn-outline-black m-0 " href="{{ route('presence') }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                      </svg></a>
                      <h3>Create a new Grade</h3>
                    </div>
                    
                    <form action="{{ route('grade.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Grade</label>
                            <input type="text" name="grade" class="form-control">
                        </div>
                        <div class="mt-4">
                             <button class="btn btn-primary" href="">Add Grade</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
   </div>
@endsection