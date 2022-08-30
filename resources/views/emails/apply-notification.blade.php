<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    @php
        $proekt = [];
        foreach ($owner->projects as $project) {
            array_push($proekt, $project->name);
        }
    @endphp 
    <div>
        <p>User <strong>{{ $applicant->name }} {{ $applicant->surname }}</strong> has applied to your project <strong><i>{{ $proekt[0] }}</i></strong></p>
        <p>Skills:</p>
        <ul>
            @foreach ($applicant->skills as $skill)
            <li>{{ $skill->name }}</li>
            @endforeach
        </ul>
        <p>Message: {{ $description }}</p>
    </div>
</body>
</html>