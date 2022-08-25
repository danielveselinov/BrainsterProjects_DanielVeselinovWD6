@extends('layouts.app')

@section('background', 'application')

@section('content')
<div class="container">
    @if (session()->has('status'))
    <div class="alert alert-info">{{ session()->get('message') }}</div>
    @endif
    <div class="row py-4">
        <div class="col-12">
            <p class="fs-3 fw-semibold mb-0">Name of project - Applicants</p>
            <p class="fs-6 text-decoration-none text-dark fw-semibold">Choose your teammates
                <img src="{{ asset('images/icons/4.png') }}" class="ms-3 pt-2" width="30" height="30" alt="...">
            </p>
        </div>


        <div class="col-12 col-md-8 offset-md-2 mt-4">
            <!-- if accepted = null then status in progress, if not status declined , if yes okey :) -->   
        </div>
    </div>
</div>
@endsection