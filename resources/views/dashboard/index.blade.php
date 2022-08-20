@extends('layouts.app')

@section('background', 'dashboard')

@section('content')
@if (!Auth::user()->completed)
<div class="col-10 offset-1 col-md-8 offset-md-2">
    <div class="bg-white shadow rounded-4 px-4 py-2">
        <p class="fs-5 fw-semibold text-center mb-0">Welcome!</p>
        <div class="text-center fw-semibold">Please finish up your profile on the following <a href="#" class="text-orange">link</a>, so that you can enjoy all our features.</div>
    </div>
</div>
@endif

<div class="container">
    <div class="row py-4">
        <div class="col-12 col-md-4 mt-3">
            <p class="fs-5 fw-semibold">In what field can you be amazing?</p>

            <div class="row g-3">
                <div class="col-md-6">
                    <button class="btn btn-active fw-semibold text-white w-100">All</button>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-light fw-semibold text-dark shadow-sm w-100">Marketing</button>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-light fw-semibold text-dark shadow-sm w-100">Frontend Development</button>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-light fw-semibold text-dark shadow-sm w-100">Backend Development</button>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-light fw-semibold text-dark shadow-sm w-100">Data Science</button>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-light fw-semibold text-dark shadow-sm w-100">Design</button>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-light fw-semibold text-dark shadow-sm w-100">Qa</button>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-light fw-semibold text-dark shadow-sm w-100">UX/UI</button>
                </div>
            </div>

        </div>

        <div class="col-12 col-md-8 mt-3">
            <div class="d-flex justify-content-end align-items-start">
                <img src="{{ asset('images/icons/3.png') }}" width="40" height="40" alt="...">
                <p class="fs-5 fw-semibold">Checkout the latest projects</p>
            </div>

            <div class="row g-2">
                <div class="card mt-5 mb-4 position-relative">
                    <div class="row g-0">
                        <div class="col-md-3 pt-3">
                            <img src="{{ asset('images/default_avatar.png') }}" class="position-absolute rounded-circle bg-body shadow-sm card-image" width="100" height="100" alt="...">

                            <div class="mt-5 text-center">
                                <p class="fw-semibold">John Doe</p>
                                <p class="fw-semibold text-orange">I'm Marketer</p>
                            </div>

                            <p class="small-xl fw-semibold text-center pt-3">I'm looking for:</p>

                            <div class="d-flex">
                                <div class="small-xl mx-1 bg-green text-white shadow-sm rounded-5 p-1 d-flex flex-column align-items-center justify-content-center text-center">Marketer</div>
                                <div class="small-xl mx-1 bg-green text-white shadow-sm rounded-5 p-1 d-flex flex-column align-items-center justify-content-center text-center">Designer</div>
                                <div class="small-xl mx-1 bg-green text-white shadow-sm rounded-5 p-1 d-flex flex-column align-items-center justify-content-center text-center">Backend dev</div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="card-body">
                                <div class="d-flex flex-column">
                                    <p class="fs-5 fw-semibold">Name of the project</p>
                                    <div class="card-text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sint nam impedit praesentium enim, eos, beatae nisi officiis voluptatibus aperiam quo ratione obcaecati quod amet voluptatem!</div>
                                    <a href="#" class="text-orange small text-end">show more</a>
                                    <button class="btn bg-green text-light text-uppercase mt-4 w-50 ms-md-auto">I'm in</button>
                                </div>
                            </div>
                            <div class="position-absolute card-circle bg-green text-white fw-semibold">10<br>Applicants</div>
                        </div>
                    </div>
                </div>

                <div class="card mt-5 mb-4 position-relative">
                    <div class="row g-0">
                        <div class="col-md-3 pt-3">
                            <img src="{{ asset('images/default_avatar.png') }}" class="position-absolute rounded-circle bg-body shadow-sm card-image" width="100" height="100" alt="...">

                            <div class="mt-5 text-center">
                                <p class="fw-semibold">John Doe</p>
                                <p class="fw-semibold text-orange">I'm Marketer</p>
                            </div>

                            <p class="small-xl fw-semibold text-center pt-3">I'm looking for:</p>

                            <div class="d-flex">
                                <div class="small-xl mx-1 bg-green text-white shadow-sm rounded-5 p-1 d-flex flex-column align-items-center justify-content-center text-center">Marketer</div>
                                <div class="small-xl mx-1 bg-green text-white shadow-sm rounded-5 p-1 d-flex flex-column align-items-center justify-content-center text-center">Designer</div>
                                <div class="small-xl mx-1 bg-green text-white shadow-sm rounded-5 p-1 d-flex flex-column align-items-center justify-content-center text-center">Backend dev</div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="card-body">
                                <div class="d-flex flex-column">
                                    <p class="fs-5 fw-semibold">Name of the project</p>
                                    <div class="card-text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sint nam impedit praesentium enim, eos, beatae nisi officiis voluptatibus aperiam quo ratione obcaecati quod amet voluptatem!</div>
                                    <a href="#" class="text-orange small text-end">show more</a>
                                    <button class="btn bg-green text-light text-uppercase mt-4 w-50 ms-md-auto">I'm in</button>
                                </div>
                            </div>
                            <div class="position-absolute card-circle bg-green text-white fw-semibold">10<br>Applicants</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection