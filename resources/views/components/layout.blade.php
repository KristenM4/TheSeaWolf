<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <title>
        @if($__env->yieldContent('title'))
            @yield('title') - The Sea Wolf Surf and Diving Shop
        @else
            The Sea Wolf Surf and Diving Shop
        @endif
    </title>
    <meta name="description" content="@yield('description')" />
    <meta property="og:description" content="@yield('description')" />
	<meta property="og:locale" content="en_GB" />
	<meta property="og:type" content="website" />
	<meta property="og:site_name" content="The Sea Wolf" />
    <meta property="og:url" content="<?php echo url()->current() ?>" />
    <link rel="canonical" href="<?php echo url()->current() ?>" />
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