@forelse ($projects as $project)
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
                        <span id="short_bio">{{ Str::limit($project->description, 120) }}</span>
                        <span id="long_bio" style="display: none;">{{ $project->description }}</span>
                        <a id="show_more" href="#" class="text-orange small text-end">show more</a>
                        @else
                        {{ $project->description }}
                        @endif
                    </div>
                    <button {{ (Auth::id() == $project->user->id) ? 'disabled' : '' }} {{ (Auth::user()->completed) ? '' : 'disabled' }} class="btn bg-green text-light text-uppercase mt-4 w-50 ms-md-auto">I'm in</button>
                </div>
            </div>
            <div class="position-absolute card-circle bg-green text-white fw-semibold">10<br>Applicants</div>
        </div>
    </div>
</div>
@empty
<p class="text-gray">Nothing found!</p>
@endforelse

{!! $projects->links() !!}