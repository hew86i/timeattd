<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="_token" content="{!! csrf_token() !!}"/>
	<title>ZK TAtt</title>
	{{-- Bootstrap Core CSS --}}
    <link href="{{ URL::asset('css/bootstrap-cosmo.min.css') }}" rel="stylesheet">

    {{-- Custom google fonts --}}
    <!-- <link href="{{ URL::asset('css/bootstrap-cosmo-fonts.css') }}" rel="stylesheet"> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>

	{{-- Custom glyph spin animated css --}}
	<link rel="stylesheet" href="{{ URL::asset('css/formvalidation/glyph-spin.css') }}">
	{{-- nprogress.css --}}
	<link rel="stylesheet" href="{{ URL::asset('css/nprogress/nprogress.css') }}">

	{{-- login.css --}}
	<link rel="stylesheet" href="{{ URL::asset('css/login.css') }}">


</head>
<body>

{{-- @include('layouts.partials._navigation') --}}
@include('layouts.partials._header')

@yield('content')

{{-- jQuery --}}
<script src="{{ URL::asset('js/jquery-2.1.4.min.js') }}"></script>

{{-- Bootstrap Core JavaScript --}}
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
{{-- nprogress.js --}}
<script src="{{ URL::asset('js/nprogress/nprogress.js')}}"></script>
{{-- moment.js --}}
<script src="{{ URL::asset('js/moment/moment.js')}}"></script>

{{-- pjax-jquery --}}
{{-- <script src="{{ URL::asset('js/jquery.pjax.js')}}"></script> --}}


{{-- setup meta token for ajax requests --}}
<script type="text/javascript">
$.ajaxSetup({
   headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
})

</script>

@yield('styles')
@yield('scripts')


</body>
</html>
