@foreach ($projects as $project)
    @foreach ($project->projects as $proekt)
        {{ $proekt->name }}
    @endforeach
@endforeach