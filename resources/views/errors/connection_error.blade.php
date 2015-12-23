<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<!-- Bootstrap Core CSS -->
    <link href="css/bootstrap-cosmo.min.css" rel="stylesheet">
</head>
<body>
@include('layouts.partials._navigation')
@include('layouts.partials._header')

<div class="container">
	<h3>Грешка</h3>
	<p>Не е возможно да се воспостави комуникација со уредот со IP адреса:<span class="text-danger"> {{$ip}}</span></p>
	<p>Статус на уредот: <span class="text-danger" >{{$status}}</span></p>
</div>

@include('layouts.partials._footer')

</body>
</html>
