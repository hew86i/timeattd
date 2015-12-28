<!DOCTYPE html>
<html lang="en">

<head>
    {{-- <meta charset="UTF-8"> --}}
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="_token" content="{!! csrf_token() !!}" />
    <title>ZK TAtt</title>

    {{-- pace.min.js --}}
    <script data-pace-options='{ "ajax": false }' src="{{ URL::asset('js/pace.min.js')}}"></script>
    {{-- Bootstrap Core CSS --}}
    <link href="{{ URL::asset('css/bootstrap-cosmo.min.css') }}" rel="stylesheet"> {{-- Custom google fonts --}}
    <link href="{{ URL::asset('css/bootstrap-cosmo-fonts.css') }}" rel="stylesheet"> {{-- FormValidation v.0.6.1 CSS file --}} {{--
    <link rel="stylesheet" href="{{ URL::asset('css/formvalidation/formValidation-0.6.1.min.css') }}"> --}} {{-- FormValidation v.0.6.1 CSS file --}}
    <link rel="stylesheet" href="{{ URL::asset('css/formvalidation/formValidation.min-0.7.1-dev.css') }}"> {{-- Custom glyph spin animated css --}}
    <link rel="stylesheet" href="{{ URL::asset('css/formvalidation/glyph-spin.css') }}"> {{-- nprogress.css --}}
    <link rel="stylesheet" href="{{ URL::asset('css/nprogress/nprogress.css') }}"> {{-- footable.css --}} {{--
    <link rel="stylesheet" href="{{ URL::asset('css/footable/footable.bootstrap.min.css') }}"> --}} {{-- bootstrap-table.css --}}
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap-table/bootstrap-table.min.css') }}"> {{-- bootstrap-datepicker --}}
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap-datepicker/bootstrap-datetimepicker.css') }}"> {{--
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap-datepicker/bootstrap-datepicker.min.css') }}"> --}} {{-- master.css --}}
    <link rel="stylesheet" href="{{ URL::asset('css/master.css') }}">

</head>

<body>
	<div id="wrapper">
	    @include('layouts.partials._navigation')
	    @include('layouts.partials._header')

	   @yield('content')

	   @include('layouts.partials._footer')

	   @yield('scripts')
	   @yield('styles')
	</div>
</body>

</html>
