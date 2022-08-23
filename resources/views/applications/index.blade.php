@extends('layouts.app')

@section('background', 'application')

@section('content')
<div class="container">
    @if (session()->has('status'))
    <div class="alert alert-info">{{ session()->get('message') }}</div>
    @endif
    <div class="row py-4">
        <!-- if accepted = null then status in progress, if not status declined , if yes okey :) -->
        <div class="col-12 col-md-8 offset-md-2 mt-4">
            @forelse ($projects as $project)
            <div class="card mt-5 mb-4 position-relative">
                @if (!$project->assembled)
                <a href="{{ route('projects.edit', $project->id) }}" class="position-absolute options">
                    <img src="{{ asset('images/icons/8.png') }}" width="40" height="40" alt="...">
                </a>
                <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="position-absolute options">
                    @csrf
                    @method('DELETE')
                    <a href="{{ route('projects.destroy', $project->id) }}" class="position-absolute options" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                        <img src="{{ asset('images/icons/7.png') }}" width="40" height="40" alt="...">
                    </a>
                </form>
                @endif
                <div class="row g-0">
                    <div class="col-md-3 pt-3">
                        <img src="{{ $project->user->setAvatar() }}" class="position-absolute rounded-circle bg-body shadow-sm card-image" width="100" height="100" alt="...">

                        <div class="mt-5 text-center">
                            <p class="fw-semibold">{{ $project->user->name }} {{ $project->user->surname }}</p>
                            <p class="fw-semibold text-orange small">I'm {{ $project->user->academy->display }}</p>
                        </div>

                        <p class="small-xl fw-semibold text-center pt-3">I'm looking for:</p>

                        <div class="d-flex">
                            @foreach ($project->profiles as $aprofile)
                            <div class="small-xl mx-1 bg-green text-white shadow-sm rounded-5 p-1 d-flex flex-column align-items-center justify-content-center text-center">{{ $aprofile->display }}</div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card-body">
                            <div class="d-flex flex-column">
                                <p class="fs-5 fw-semibold">{{ $project->name }}</p>
                                <div class="card-text">
                                    @if (strlen($project->description) > 120)
                                    <span id="short_bio">{{ Str::limit($project->description, 120) }}</span>
                                    <span id="long_bio" style="display: none;">{{ $project->description }}</span>
                                    <a id="show_more" href="#" class="text-orange small text-end">show more</a>
                                    @else
                                    {{ $project->description }}
                                    @endif
                                </div>
                            </div>
                        </div>
                        <a href="#" class="position-absolute card-circle bg-green text-white text-decoration-none pointer fw-semibold">10<br>Applicants</a>
                    </div>
                </div>
                @if ($project->assembled)
                <img src="{{ asset('images/icons/badge.png') }}" class="position-absolute badge-pos" width="40" height="40" alt="...">
                @endif
            </div>
            @empty
            <p class="text-gray">Nothing found!</p>
            @endforelse
        </div>
    </div>
    @endsection