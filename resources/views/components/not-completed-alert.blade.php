@if (!Auth::user()->completed && ! request()->routeIs('profile.index'))
<div class="col-10 offset-1 col-lg-8 offset-lg-2">
    <div class="bg-white shadow rounded-4 px-4 py-2">
        <p class="fs-5 fw-semibold text-center mb-0">Welcome!</p>
        <div class="text-center fw-semibold">Please finish up your profile on the following <a href="{{ route('profile.index') }}" class="text-orange">link</a>, so that you can enjoy all our features.</div>
    </div>
</div>
@endif