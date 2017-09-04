<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    {{--<link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}

    {{--font awesome--}}
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    {{--my style--}}
    <link href="{{asset('frontend/styles.css')}}" rel="stylesheet" />

    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.css')}}" />
    @yield('css')

</head>
<body>
<div id="app">
    <div class="wrap">
        @yield('content')
    </div>
</div>

<!-- Scripts -->

{{--jquery--}}
<script src="{{ asset('jquery/jquery.min.js') }}"></script>

{{--popper--}}
<script src="{{ asset('frontend/js/popper.js') }}"></script>

<script src="{{asset('frontend/js/Bootstrap.js')}}"></script>

@yield('js')

</body>
</html>
