@extends('layouts.app')

@section('background', 'project')

@section('content')
<div class="container">
    <form method="POST" action="{{ route('projects.update', $project->id) }}" class="row">
        @csrf
        @method('PUT')
        <div class="col-12 col-lg-4">
            <p class="fs-4 fw-semibold">Edit project</p>
            <div class="row g-2">
                <div class="col-md-12 mb-3">
                    <div class="form-floating">
                        <input type="name" class="form-control" id="name" name="name" value="{{ $project->name }}" placeholder="Name of project">
                        <label for="name">Name of project</label>
                        @error('name')
                        <div class="small text-red mb-0">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Description of project" id="description" name="description" value="{{ old('description') }}" style="height: 220px; resize:none;">{{ $project->description }}</textarea>
                        <label for="description">Description of project</label>
                        @error('description')
                        <div class="small text-red mb-0">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-8">
            <p class="fs-4 fw-semibold">What I need</p>
            <div class="row g-3" style="overflow-y: auto;">
                @php
                $akademii = [];
                    foreach ($project->profiles as $profil) { array_push($akademii, $profil->id); }
                @endphp
                @foreach ($academies as $academy)
                <div class="col-2">
                    <input type="checkbox" class="form-check-input d-none" name="academy[]" value="{{ $academy->id }}" id="academy{{ $academy->id }}">
                    <label id="academy{{ $academy->id }}" class="form-check-box d-flex flex-column align-items-center justify-content-center {{ (in_array($academy->id, $akademii)) ? 'bg-green text-white' : 'bg-light' }} shadow-sm small border rounded-2 m-1" for="academy{{ $academy->id }}">
                        {{ $academy->name }}
                    </label>
                </div>
                @endforeach
            </div>
            @error('academy')
            <div class="text-red small">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-12 text-end">
            <button type="submit" class="btn text-white text-uppercase fw-semibold bg-green btn-xl mb-3 mb-lg-0">EDIT</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    $(function() {

        $("input[type='checkbox']").on('click', function() {
            let select = $(this).val()

            if ($(`input[type='checkbox']:checked`) && $(`label#academy${select}`).hasClass('selected')) {
                $(`label#academy${select}`).removeClass('bg-green text-white selected')
            } else {
                $(`label#academy${select}`).addClass('bg-green text-white selected')
            }
        })

    })
</script>
@endsection