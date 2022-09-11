@extends('layouts.app')

@section('background', 'application')

@section('content')
<div class="container">
    @if (session()->has('status'))
    <div class="alert alert-info">{{ session()->get('message') }}</div>
    @endif
    <div class="row py-4">
        <div class="col-12">
            <p class="fs-3 fw-semibold mb-0">My applications</p>
        </div>

        @forelse ($applications as $application)
        <div class="col-12 col-lg-8 offset-lg-2 mt-4">
            <div class="card mt-5 mb-4 position-relative">
                @if (!$application->accepted)
                <form action="{{ route('applications.destroy', $application->id) }}" method="POST" class="position-absolute options" style="right: -40px !important">
                    @csrf
                    @method('DELETE')
                    <a href="{{ route('applications.destroy', $application->id) }}" class="position-absolute options text-center text-decoration-none text-gray small" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                        <img src="{{ asset('images/icons/2.png') }}" width="40" height="40" alt="...">
                        Cancel
                    </a>
                </form>
                @endif
                <div class="row g-0">
                    <div class="col-md-3 pt-3">
                        <img src="{{ $application->project->user->setAvatar() }}" class="position-absolute rounded-circle bg-body shadow-sm card-image" width="100" height="100" alt="...">

                        <div class="mt-5 text-center">
                            <p class="fw-semibold">{{ $application->project->user->name }} {{ $application->project->user->surname }}</p>
                            <p class="fw-semibold text-orange small">I'm {{ $application->project->user->academy->display }}</p>
                        </div>

                        <p class="small-xl fw-semibold text-center pt-3">I'm looking for:</p>

                        <div class="d-flex">
                            @foreach ($application->project->profiles as $aprofile)
                            <div class="small-xl mx-1 bg-green text-white shadow-sm rounded-5 p-1 d-flex flex-column align-items-center justify-content-center text-center">{{ $aprofile->display }}</div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card-body">
                            <div class="d-flex flex-column">
                                <p class="fs-5 fw-semibold">{{ $application->project->name }}</p>
                                <div class="card-text">
                                    @if (strlen($application->project->description) > 120)
                                    <span id="short_bio{{ $application->project->id }}">{{ Str::limit($application->project->description, 120) }}</span>
                                    <span id="long_bio{{ $application->project->id }}" style="display: none;">{{ $application->project->description }}</span>
                                    <a id="show_more" data-id="{{ $application->project->id }}" href="#" class="text-orange small text-end">show more</a>
                                    @else
                                    {{ $application->project->description }}
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if ($application->accepted === null)
                            <p class="mb-0 text-gray small fw-semibold">Application in progress</p>
                        @elseif ($application->accepted === 1)
                            <p class="mb-0 text-gray small fw-semibold">Application accepted</p>
                            <img src="{{ asset('images/icons/5.png') }}" width="20" height="20" alt="...">
                        @elseif ($application->accepted === 0)
                            <p class="mb-0 text-red small fw-semibold">Application declined</p>
                            <img src="{{ asset('images/icons/6.png') }}" width="20" height="20" alt="...">
                        @endif
                        <div class="position-absolute card-circle bg-green text-white text-decoration-none pointer fw-semibold">{{ $application->project->applications->count() }}<br>Applicants</div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <p class="text-gray">Nothing found!</p>
        @endforelse
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $(function() {
            $('body').on('click', '#show_more', function(e) {
                e.preventDefault()

                let id = $(this).attr('data-id')

                $(`#short_bio${id}`).fadeOut()
                $(`#long_bio${id}`).fadeIn()
            })
        })
    </script>
@endsection