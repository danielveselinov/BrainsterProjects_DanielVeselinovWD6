@extends('layouts.app')

@section('background', 'project')

@section('content')
<div class="container">
    <div class="row py-4">
        @if (Auth::user()->completed)
        <div class="col-12">
            <p class="fs-6 fw-semibold mb-0">Have a new idea to make the world better?</p>
            <a href="{{ route('projects.create') }}" class="fs-3 text-decoration-none text-dark fw-semibold">Create new project
                <img src="{{ asset('images/icons/1.png') }}" width="30" height="30" alt="...">
            </a>
        </div>

        <div class="col-12 col-md-8 offset-md-2 mt-4">
            @forelse (Auth::user()->projects as $project)
            <div class="card mt-5 mb-4 position-relative">
                <div class="row g-0">
                    <div class="col-md-3 pt-3">
                        <img src="{{ $project->user->setAvatar() }}" class="position-absolute rounded-circle bg-body shadow-sm card-image" width="100" height="100" alt="...">

                        <div class="mt-5 text-center">
                            <p class="fw-semibold">{{ $project->user->name }} {{ $project->user->surname }}</p>
                            <p class="fw-semibold text-orange">I'm Marketer(DYNM)</p>
                        </div>

                        <p class="small-xl fw-semibold text-center pt-3">I'm looking for:</p>

                        <div class="d-flex">
                            @foreach ($project->profiles as $aprofile)
                            <div class="small-xl mx-1 bg-green text-white shadow-sm rounded-5 p-1 d-flex flex-column align-items-center justify-content-center text-center">{{ $aprofile->name }}</div>
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
                        <div class="position-absolute card-circle bg-green text-white fw-semibold">10<br>Applicants</div>
                    </div>
                </div>
                <!-- if team assembled then show badge -->
                <!-- <img src="{{ asset('images/icons/badge.png') }}" class="position-absolute badge-pos" width="40" height="40" alt="..."> -->
            </div>
            @empty
            <p class="text-gray">Nothing found!</p>
            @endforelse
        </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $(function() {
            $('#show_more').on('click', function(e) {
                e.preventDefault()
                $('#short_bio').fadeOut()
                $('#show_more').fadeOut()
                $('#long_bio').fadeIn()
            })
        })
    </script>
@endsection