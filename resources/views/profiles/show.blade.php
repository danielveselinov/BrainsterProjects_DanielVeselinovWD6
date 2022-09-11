@extends('layouts.app')

@section('background', 'profile')

@section('content')
<div class="container">
    <p class="fs-4 fw-semibold">{{ $user->name }} {{ $user->surname }}'s Profile</p>
    <div class="row">
        <div class="col-12 col-lg-4 mt-3 mt-lg-0">
            <div class="d-flex align-items-center">
                <img src="{{ $user->setAvatar() }}" class="w-25 me-5" alt="...">
                <div>
                    <span class="fs-5 fw-semibold text-gray">Name:</span>
                    <p class="fs-3 fw-semibold text-dark">{{ $user->name }} {{ $user->surname }}</p>

                    <span class="fs-5 fw-semibold text-gray">Contact:</span>
                    <a href="mailto:{{ $user->email }}" class="text-link text-dark fs-5 fw-semibold">{{ $user->email }}</a>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-8 mt-3 mt-lg-0 ps-5">
            <span class="fs-5 fw-semibold text-gray">Biography:</span>

            <div class="fs-5 text-gray">
                @if (strlen($user->biography) > 280)
                    <span id="short_bio">{{ Str::limit($user->biography, 280) }}</span>
                    <span id="long_bio" style="display: none;">{{ $user->biography }}</span>
                    <a id="show_more" href="#" class="text-orange small text-end">show more</a>
                @else
                    {{ $user->biography }}
                @endif
            </div>

            <p class="fs-4 text-gray fw-semibold mt-5 mb-0">Skills:</p>
            <div class="row g-0" style="overflow-y: auto;">
                @foreach ($user->skills as $skill)
                <div class="col-4 col-sm-2">
                    <label class="form-check-box d-flex flex-column align-items-center justify-content-center bg-light bg-light shadow-sm small border rounded-2 m-1">
                        {{ $skill->name }}
                    </label>
                </div>
                @endforeach
            </div>
        </div>

        <div class="col-12 py-4">
            <a href="{{ URL::previous() }}" class="btn text-white text-uppercase fw-semibold bg-green btn-xl fs-5 mb-3 mb-lg-0">BACK</a>
        </div>
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