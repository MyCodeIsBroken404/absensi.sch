@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 text-center">
        <h1>Monitor</h1>
    </div>
</div>
<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        @livewire('main-monitor')
        <a href="{{ route('report.index', \Carbon\Carbon::today()->toDateString()) }}" class="btn btn-secondary">Print</a>
    </div>
</div>
@endsection
