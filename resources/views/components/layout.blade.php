<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <title>The Sea Wolf</title>
</head>
<body>
    @include('nav')
    @if(session()->has('success'))
    <div>
        <p>{{session('success')}}</p>
    </div>
    @endif
    {{$slot}}
</body>
</html>