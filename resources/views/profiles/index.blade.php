@extends('layouts.app')

@section('background', 'profile')

@section('content')
<div class="container">
    @if (session()->has('status'))
    <div class="alert alert-info">{{ session()->get('message') }}</div>
    @endif
    <p class="fs-4 fw-semibold">My Profile</p>
    <form method="POST" action="{{ route('profile.update', Auth::id()) }}" class="row" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="col-12 col-lg-4">
            <div class="d-flex">
                <input type="file" name="profile_picture" id="profile_picture" class="d-none">
                <label for="profile_picture" class="d-flex justify-content-end" style="flex-direction: column-reverse;">
                    @error('profile_picture')
                    <div class="text-red small">{{ $message }}</div>
                    @enderror
                    <p class="mb-0 small">Click to upload an image</p>
                    <img src="{{ Auth::user()->setAvatar() }}" width="120" height="120" class="me-2" alt="...">
                </label>
                <div class="row g-2">
                    <div class="form-floating mb-2">
                        <input type="name" class="form-control form-control-sm" id="name" name="name" value="{{ Auth::user()->name }}" placeholder="John">
                        <label for="name">Name</label>
                        @error('name')
                        <div class="text-red small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-floating mb-2">
                        <input type="surname" class="form-control form-control-sm" id="surname" name="surname" value="{{ Auth::user()->surname }}" placeholder="Doe">
                        <label for="surname">Surname</label>
                        @error('surname')
                        <div class="text-red small">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-floating mb-2">
                        <input type="email" class="form-control form-control-sm" disabled id="email" name="email" value="{{ Auth::user()->email }}" placeholder="name@example.com">
                        <label for="email">Email address</label>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mb-2">
                <div class="form-floating">
                    <textarea class="form-control form-control-sm" placeholder="Biography" id="biography" name="biography" style="height: 220px; resize:none;">{{ Auth::user()->biography }}</textarea>
                    <label for="biography">Biography</label>
                    @error('biography')
                    <div class="text-red small">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-8">
            <div class="row flex-column justify-content-center pb-5">
                <div class="col-12 ms-lg-5">
                    <p class="fs-4 fw-semibold mb-0">Skills</p>
                    <div class="row g-0" style="overflow-y: scroll; height: 220px;">
                        @php
                        $vestini = [];
                        foreach (Auth::user()->skills as $skill) {
                        array_push($vestini, $skill->id);
                        }
                        @endphp
                        @foreach ($skills as $skill)
                        <div class="col-4 col-sm-2">
                            <input type="checkbox" class="form-check-input d-none" name="skill[]" value="{{ $skill->id }}" id="skill{{ $skill->id }}" {{ (in_array($skill->id, $vestini)) ? 'checked' : '' }}>
                            <label id="skill{{ $skill->id }}" class="form-check-box d-flex flex-column align-items-center justify-content-center {{ (in_array($skill->id, $vestini)) ? 'bg-green text-white' : 'bg-light' }} shadow-sm small border rounded-2 m-1" for="skill{{ $skill->id }}">
                                {{ $skill->name }}
                            </label>
                        </div>
                        @endforeach
                    </div>
                    @error('skill')
                    <div class="text-red small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 ms-lg-5 mt-5">
                    <p class="fs-4 fw-semibold mb-0">Academies</p>
                    <div class="d-flex academies" style="overflow-x: auto;">
                        @foreach ($academies as $academy)
                        <div class="d-inline-flex">
                            <input type="radio" class="form-check-input d-none" name="academy" value="{{ $academy->id }}" id="academy{{ $academy->id }}" {{ (Auth::user()->academy_id == $academy->id) ? 'checked' : '' }}>
                            <label id="academy{{ $academy->id }}" class="form-check-box d-flex flex-column align-items-center justify-content-center {{ (Auth::user()->academy_id == $academy->id) ? 'bg-green text-white' : 'bg-light' }} shadow-sm small border rounded-2 m-1" for="academy{{ $academy->id }}">
                                {{ $academy->name }}
                            </label>
                        </div>
                        @endforeach
                    </div>
                    @error('academy')
                    <div class="text-red small">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="col-12 text-end">
            <button type="submit" class="btn text-white text-uppercase fw-semibold bg-green btn-xl mb-3 mb-lg-0">EDIT / UPDATE</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    $(function() {

        $("input[type='checkbox']").on('click', function() {
            let select = $(this).val()

            if ($(`input[type='checkbox']:checked`) && $(`label#skill${select}`).hasClass('selected')) {
                $(`label#skill${select}`).removeClass('bg-green text-white selected')
            } else {
                $(`label#skill${select}`).addClass('bg-green text-white selected')
            }
        })

        $('input[name="academy"]').on('change', function() {
            let select = $('input[name="academy"]:checked').val()

            if ($('input[name="academy"]:checked') && $(`label#academy${select}`).hasClass('selected')) {
                $(`label#academy${select}`).removeClass('bg-green text-white selected')
            } else {
                $(`label#academy${select}`).addClass('bg-green text-white selected')
            }
        })
    })
</script>
@endsection