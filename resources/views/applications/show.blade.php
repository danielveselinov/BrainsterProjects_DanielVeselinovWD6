@extends('layouts.app')

@section('content')
<div class="container">
    @if (session()->has('status'))
    <div class="alert alert-info">{{ session()->get('message') }}</div>
    @endif
    <div class="row justify-content-between py-4">
        <div class="col-6">
            <p class="fs-3 fw-semibold mb-0">{{ $projects->name }} - Applicants</p>
            <p class="fs-6 text-decoration-none text-dark fw-semibold">Choose your teammates
                <img src="{{ asset('images/icons/4.png') }}" class="ms-3 pt-2" width="30" height="30" alt="...">
            </p>
        </div>
        <div class="col-6 d-flex justify-content-end">
            <div class="text-center">
                <p class="small-xl text-gray">Ready to start?<br>Click on the button below.</p>
                <button id="assembleTeam" data-application="{{ $projects->id }}" class="btn bg-orange text-white text-uppercase fw-semibold small">TEAM assembled
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                        <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="col-12 col-md-8 offset-md-2 mt-4">
            <div class="row justify-content-center py-4">
                @forelse ($projects->applications as $aplikant)
                <div class="col-12 col-md-4">
                    <div class="card rounded-4 border-0 shadow-sm" id="card{{ $aplikant->user->id }}">
                        <div class="card-body text-center">
                            <img src="{{ $aplikant->user->setAvatar() }}" class="rounded-circle bg-body p-2 shadow-sm card-image" width="130" height="130" alt="...">
                            <a href="{{ route('profile.show', $aplikant->user->id) }}" target="_blank" class="fw-semibold fs-5 text-dark text-decoration-none d-block mt-3 mb-0">{{ $aplikant->user->name }} {{ $aplikant->user->surname }}</a>
                            <p class="mb-0 fw-semibold text-orange mt-2">{{ $aplikant->user->academy->display }}</p>
                            <a href="mailto:{{ $aplikant->user->email }}" class="small-xl text-gray fw-semibold text-decoration-none">{{ $aplikant->user->email }}</a>
                            <p class="small mt-2 mb-0">{{ Str::limit($aplikant->description, 80) }}</p>

                            <input type="checkbox" class="btn-check m-2 filter-checkbox" id="applicantFilter{{ $aplikant->user->id }}" name="applicantFilter" data-user="{{ $aplikant->user->id }}" autocomplete="off">
                            <label class="btn mt-2" for="applicantFilter{{ $aplikant->user->id }}"><img src="{{ asset('images/icons/1.png') }}" width="30" height="30" alt="..."></label>
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-gray">Nothing found!</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(() => {
        let applicantArr = []

        $("[name='applicantFilter']").bind('click', function() {
            let filter = $(this).attr('data-user')

            if ($(this).is(':checked')) {
                $(`#card${filter}`).addClass('bg-active')
                applicantArr.push(filter)
            } else {
                let index = applicantArr.indexOf(filter);
                if ((index = applicantArr.indexOf(filter)) !== -1) {
                    $(`#card${filter}`).removeClass('bg-active')
                    applicantArr.splice(index, 1)
                }
            }

            if (isNaN(filter)) {
                return
            }
        })

        $('#assembleTeam').on('click', function(e) {
            e.preventDefault()
            
            let application = $(this).attr('data-application')

            if (isNaN(application)) {
                return
            }

            if (applicantArr.length === 0) {
                Swal.fire('Error', 'You need to select at least one candidate', 'error')
                return
            }

            $.ajax({
                method: 'PUT',
                url: `${application}`,
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    application, applicantArr
                },
                success: (response) => {
                    if (response.auth) {
                        Swal.fire('Team assembling', `${response.message}`, 'info').then((result) => {
                        if (result.isConfirmed) {
                                window.location.href = '/projects'
                            }
                        })
                    }
                },
                error: (error) => {
                    let errors = error.responseJSON
                    Swal.fire('Error', errors.message, 'error')
                }
            })
        })
    })
</script>
@endsection