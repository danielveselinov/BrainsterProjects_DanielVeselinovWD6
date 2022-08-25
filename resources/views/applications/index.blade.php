@extends('layouts.app')

@section('background', 'application')

@section('content')
<div class="container">
    @if (session()->has('status'))
    <div class="alert alert-info">{{ session()->get('message') }}</div>
    @endif
    <div class="row py-4">
        {{-- dd(Auth::user()->applications) --}}
        <div class="col-12 col-md-8 offset-md-2 mt-4">
            <!-- if accepted = null then status in progress, if not status declined , if yes okey :) -->   
        </div>
    </div>
</div>
@endsection