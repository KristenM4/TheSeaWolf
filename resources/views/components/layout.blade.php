<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <title>The Sea Wolf</title>
</head>
<body>
    <div class="page-content">
        @include('nav')
        <div class="page-content-main">
            @if(session()->has('success'))
            <div class="success-message">
                <p>{{session('success')}}</p>
            </div>
            @elseif(session()->has('error'))
            <div class="error-message">
                <p>{{session('error')}}</p>
            </div>
            @endif
            {{$slot}}
        </div>
        @include('footer')
    </div>
</body>
    <script src="{{ asset('main.js') }}"></script>
</html>