<!DOCTYPE html>
<html lang="en">
<head>
{{-- 	<meta charset="UTF-8"> --}}
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="_token" content="{!! csrf_token() !!}"/>
	<title>ZK TAtt</title>

	{{-- pace.min.js --}}
	<script src="{{ URL::asset('js/pace.min.js')}}"></script>

	{{-- Bootstrap Core CSS --}}
    <link href="{{ URL::asset('css/bootstrap-cosmo.min.css') }}" rel="stylesheet">

    {{-- Custom google fonts --}}
    <link href="{{ URL::asset('css/bootstrap-cosmo-fonts.css') }}" rel="stylesheet">

    {{-- FormValidation v.0.6.1 CSS file --}}
	{{-- <link rel="stylesheet" href="{{ URL::asset('css/formvalidation/formValidation-0.6.1.min.css') }}"> --}}
	{{-- FormValidation v.0.6.1 CSS file --}}
	<link rel="stylesheet" href="{{ URL::asset('css/formvalidation/formValidation.min-0.7.1-dev.css') }}">

	{{-- Custom glyph spin animated css --}}
	<link rel="stylesheet" href="{{ URL::asset('css/formvalidation/glyph-spin.css') }}">
	{{-- nprogress.css --}}
	<link rel="stylesheet" href="{{ URL::asset('css/nprogress/nprogress.css') }}">
	{{-- footable.css --}}
	{{-- <link rel="stylesheet" href="{{ URL::asset('css/footable/footable.bootstrap.min.css') }}"> --}}
	{{-- bootstrap-table.css --}}
	<link rel="stylesheet" href="{{ URL::asset('css/bootstrap-table/bootstrap-table.min.css') }}">
	{{-- bootstrap-datepicker --}}
	<link rel="stylesheet" href="{{ URL::asset('css/bootstrap-datepicker/bootstrap-datetimepicker.css') }}">
	{{-- <link rel="stylesheet" href="{{ URL::asset('css/bootstrap-datepicker/bootstrap-datepicker.min.css') }}"> --}}
	{{-- master.css --}}
	<link rel="stylesheet" href="{{ URL::asset('css/master.css') }}">


</head>

<style>
#wrapper {
	visibility: hidden;
}
.pace {
  -webkit-pointer-events: none;
  pointer-events: none;

  -webkit-user-select: none;
  -moz-user-select: none;
  user-select: none;
}

.pace-inactive {
  display: none;
}

.pace .pace-progress {
  background: #29d;
  position: fixed;
  z-index: 2000;
  top: 0;
  right: 100%;
  width: 100%;
  height: 2px;
}
.pace-running #wrapper{
    zoom:1;
    filter:alpha(opacity=1);
    opacity:0.01;
}
.pace-done #wrapper{
	visibility: visible;
    zoom:1;
    filter:alpha(opacity=100);
    opacity:1;
    -webkit-transition:opacity 0.1s linear;
    -moz-transition:opacity 0.1s linear;
    -o-transition:opacity 0.1s linear;
    transition:opacity 0.1s linear;
}
</style>

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
