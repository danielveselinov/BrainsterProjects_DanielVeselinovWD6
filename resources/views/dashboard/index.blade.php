@extends('layouts.app')

@section('background', 'dashboard')

@section('content')
<div class="container">
    <div class="row py-4">
        <div class="col-12 col-lg-4 mt-3 p-4">
            <p class="fs-5 fw-semibold">In what field can you be amazing?</p>
            <div class="row g-3 filters">
                <div class="col-md-6">
                    <button id="allAcademies" class="btn btn-active text-white fw-semibold w-100">All</button>
                </div>
                @foreach ($academies as $academy)
                <div class="col-md-6">
                    <button id="a{{ $academy->id }}" data-academy="{{ $academy->id }}" class="btn btn-light text-dark fw-semibold shadow-sm w-100">{{ $academy->name }}</button>
                </div>
                @endforeach
            </div>
        </div>

        <div class="col-12 col-lg-8 mt-3">
            <div class="d-flex justify-content-end align-items-start">
                <img src="{{ asset('images/icons/3.png') }}" width="40" height="40" alt="...">
                <p class="fs-5 fw-semibold">Checkout the latest projects</p>
            </div>

            
            <div class="row g-2" id="projects">
                @forelse ($projects as $project)
                @php
                $korisnik = [];
                foreach ($project->applications as $profil) { 
                    array_push($korisnik, $profil->id); 
                }
                @endphp
                <div class="card mt-5 mb-4 position-relative">
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
                                        <span id="short_bio{{ $project->id }}">{{ Str::limit($project->description, 120) }}</span>
                                        <span id="long_bio{{ $project->id }}" style="display: none;">{{ $project->description }}</span>
                                        <a id="show_more" data-id="{{ $project->id }}" href="#" class="text-orange small text-end">show more</a>
                                        @else
                                        {{ $project->description }}
                                        @endif
                                    </div>
                                    <button data-project="{{ $project->id }}" {{ in_array(Auth::id(), $korisnik) ? 'disabled' : '' }} {{ (Auth::id() == $project->user->id) ? 'disabled' : '' }} {{ (Auth::user()->completed) ? '' : 'disabled' }} class="btn bg-green text-light text-uppercase mt-4 w-50 ms-md-auto imInBtn">I'm in</button>
                                </div>
                            </div>
                            <div class="position-absolute card-circle bg-green text-white fw-semibold">{{ $project->applications->count() }}<br>Applicants</div>
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-gray">Nothing found!</p>
                @endforelse

                {!! $projects->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(function() {

        $('body').on('click', '.pagination a', function(e) {
            e.preventDefault()

            let url = $(this).attr('href')

            $.get(url, function(data) {
                $('#projects').html(data)
            })
        })

        $('body').on('click', '#show_more', function(e) {
            e.preventDefault()

            let id = $(this).attr('data-id')

            $(`#short_bio${id}`).fadeOut()
            $(`#long_bio${id}`).fadeIn()
        })

        $('body').on('click', '.imInBtn', function(e) {
            e.preventDefault()

            let id = $(this).attr('data-project')
            
            Swal.fire({
                title: 'Apply for a project',
                html: `
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Why do you want to apply?" id="description" name="description" style="height: 220px; resize:none;">{{ old('description') }}</textarea>
                        <label for="description" class="text-start">Why do you want to apply?</label>
                        @error('description')
                        <div class="small text-red mb-0">{{ $message }}</div>
                        @enderror
                    </div>
                    `,
                showCancelButton: true,
                confirmButtonText: 'Apply',
            }).then((result) => {
                if (result.isConfirmed) {

                    let project_id = id
                    let description = $('#description').val()

                    $.ajax({
                        method: 'POST',
                        url: 'applications',
                        data: {
                            '_token': $('meta[name="csrf-token"]').attr('content'),
                            project_id, description
                        },
                        success: (response) => {
                            if (response === 'success') {
                                Swal.fire('Successfully applied for this project', '', 'info').then((result) => {
                                    if (result.isConfirmed) {
                                        // $('#projects > div').fadeIn();
                                    }
                                })
                            }
                        },
                        error: (error) => {
                            let errors = error.responseJSON
                            Swal.fire('Error', errors.message, 'error')
                        }
                    })
                }
            })
        })
    })
</script>
@endsection