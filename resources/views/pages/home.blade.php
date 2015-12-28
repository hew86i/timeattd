@extends('layouts.master')

@section('content')

<div class="container">

<h1>
	<span>Евиденција на работно време</span>
	<div class="btn-group pull-right">
		<button type="button" id="btn_sync_all" class="btn btn-default"><i class="glyphicon glyphicon-save"></i><span>&nbsp;&nbsp;</span>Синхронизирај</button>
		<a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></a>
		<ul class="dropdown-menu">
			<li><a id="a_get_today_logs" href="#!">Синхронизирај корсници</a></li>
			<li><a href="#!">Синхронизирај записи</a></li>
			<li class="divider"></li>
			<li><a href="#!">Друго</a></li>
		</ul>
	</div>
</h1>

<h4>
	<span>Статус на уредот: </span>
	<span id='device_status' class='alert-danger'> <strong>&nbsp;Offline&nbsp;</strong> </span>
</h4>

<div class="progress-container row">
	<div class="col-lg-6">
		<div id="progress-connect"><h4 class="pull-right">&nbsp;</h4></div>
	</div>
	<div class="col-lg-6">
		<div id="progress-sync"><h4 class="pull-right">&nbsp;</h4></div>
	</div>
</div>
<hr>
<div class="row">
	<div class="col-md-7">
		<div>
			{{-- <div id="progress-connect">&nbsp;sdfasdf</div> --}}
			<h3>
				<span>Информации за уредите</span>
				<div class="btn-group pull-right">
					<button type="button" id="btn_connect_device" class="btn btn-default btn-sm">Конектирај</button>
				</div>
			</h3>
		</div>
		<hr>
		<table id="get-devices" class="table table-condensed">
		<thead>
			<tr>
				<th>#</th>
				<th>ID</th>
				<th>Име</th>
				<th>IP Адреса</th>
				<th>Порта</th>
				<th>Статус</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($devices as $red)
			<tr>
				<td><input type="radio" name="availableDevices" class="deviceList" value="{{$red['ip_address']}}" checked=""></td>
				<td>{{$red['id']}}</td>
				<td>{{$red['device_name']}}</td>
				<td>{{$red['ip_address']}}</td>
				<td>{{$red['udp_port']}}</td>
				@if($connected_device->connected == 1 && $connected_device->ip_address == $red['ip_address'])
					<td connected="true">connected</td>
				@else
					<td>/</td>
				@endif
			</tr>
			@endforeach
		</tbody>
		</table>
	</div>

	<div class="col-md-5">
		<h3>Device info</h3>
		<hr>
		<table class="table table-condensed">
		<thead>
			<tr>
				<th>ID</th>
				<th>Име</th>
				<th>Лозинка</th>
				<th>Група</th>
				<th>Картичка</th>
				<th>Привилегија</th>
			</tr>
		</thead>
		<tbody>
		<?php
// dd($connected_device->connected);

if ($connected_device->connected == 1) {
    $tadf = app()->make('TADF', [['ip' => $connected_device->ip_address]]);
    $tad = $tadf->get_instance();
    $all_user_info = $tad->get_all_user_info()->to_array();
    // dd(isset($all_user_info['Row']));
    if (isset($all_user_info['Row'])) {
        foreach ($all_user_info['Row'] as $red) {
            ?>
					<tr>
						<td><?php echo $red['PIN'] ?></td>
						<td><?php echo (!is_array($red['Name'])) ? $red['Name'] : "/" ?></td>
						<td><?php echo (!is_array($red['Password'])) ? $red['Password'] : "/" ?></td>
						<td><?php echo $red['Group'] ?></td>
						<td><?php echo $red['Card'] ?></td>
						<td><?php echo $red['Privilege'] ?></td>
					</tr>

		<?php

        }
    }
}
?>
		</tbody>
		</table>
		<hr>

		<form class="form-horizontal" method="post">
		<legend>Внеси нов корисник</legend>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-4 control-label">ID</label>
		    <div class="col-sm-8">
		      <input name="PIN" type="text" class="form-control" id="inputEmail3">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputName" class="col-sm-4 control-label">Име</label>
		    <div class="col-sm-8">
		      <input name="name" type="text" class="form-control" id="inputName" placeholder="Корисничко име">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputPassword3" class="col-sm-4 control-label">PIN Број</label>
		    <div class="col-sm-8">
		      <input name="password" type="password" class="form-control" id="inputPassword3" placeholder="PIN Број">
		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputCard" class="col-sm-4 control-label">Картичка</label>
		    <div class="col-sm-8">
		      <input name="card" type="text" class="form-control" id="inputCard" placeholder="Внесете валиде број на картичка">
		    </div>
		  </div>
		  <div class="form-group">
		    <div class="col-sm-offset-9 col-sm-1">
		      <button type="submit" class="btn btn-default">Внеси</button>
		  	  <input type="hidden" name="_token" value="{{ csrf_token() }}">
		    </div>
		  </div>
		</form>
	</div>
</div>

</div>

{{-- DIALOGS --}}

{{-- @include('layouts.partials.dialogs.sync-all') --}}
@include('layouts.partials.dialogs.add-new-device')

<div id="overlay"></div>

@endsection

@section('styles')

	<style>

	html {
	    min-height: 100%;
	    /* make sure it is at least as tall as the viewport */
	    position: relative;
	}

	body {
	    height: 100%;
	    /* force the BODY element to match the height of the HTML element */
	}

	.modal .modal-dialog {
	    width: 35%;
	}

	#overlay {
	    background-color: rgba(0, 0, 0, 0.2);
	    z-index: 500;
	    position: absolute;
	    left: 0;
	    top: 0;
	    width: 100%;
	    height: 100%;
	    display: none;
	}
	</style>

@endsection

@section('scripts')

<script type="text/javascript">

$(document).ready(function(){


   $(document).ajaxStop(function () {
        console.log('ajax stop')
    });

    $(document).ajaxStart(function () {
        console.log('ajax start')
    });
	// tooltips
	$('[data-toggle="tooltip"]').tooltip();

	// check the correct device
	$('td[connected="true"]').closest('tr').find('.deviceList').prop("checked", true);

	$("#a_add_new_device").click(function(){
		$("#add-new-device").modal('toggle');
	});

	/**
	 * Inictialize connection to the selected device. Upon successfull connection
	 * status element changes its color
	 */
	$("#btn_connect_device").click(function(){

		NProgress.configure({ parent: '#progress-connect', easing: 'ease', speed: 200});
		NProgress.configure({ trickleRate: 0.09, trickleSpeed: 200 });
		NProgress.configure({ showSpinner: false });
		$('#progress-connect').show();

		$('#device_status').removeClass('alert-danger alert-success').addClass('alert-default').html("<strong>&nbsp;Connecting...&nbsp;</strong>");

		var url_send = "/connect/" + $('.deviceList:checked').val();

		NProgress.start(0.3);
	    $.ajax({
	        type: 'GET',
	        url: url_send,
	        complete: function () {	NProgress.done(); },
	        success: function(data) {

	            if(data[0] === true) {
	            	$('#device_status').removeClass('alert-danger').addClass('alert-success').html("<strong>&nbsp;Online&nbsp;</strong>");
	            	$('.deviceList:checked').closest('tr').find('td:eq(5)').html("connected");
	            } else {
	            	$('#device_status').addClass('alert-danger').removeClass('alert-success').html("<strong>&nbsp;Offline&nbsp;</strong>");
	            }
	        }
	    });
	});

	$('#btn_sync_all').click(function() {

		logs = [];

		NProgress.configure({ parent: '#progress-sync', easing: 'ease', speed: 50});
		NProgress.configure({ trickleRate: 0.15, trickleSpeed: 200 });
		NProgress.configure({ showSpinner: false });
		$('#progress-sync').show();
		$('#progress-sync h4').html(' Вчитување податоци од уредот ... ');
		NProgress.start();
	    $.ajax({
	        type: 'GET',
	        url: 'api/get/record/',
	        beforeSend: function() { $('#overlay').show(); $('#progress-sync').show(); },
	        success: function(data) {
	            logs = data;
	            // console.log(data.length/760);
	            time = (data.length/760)*1000;
	            setTackle = (0.01*(20000/time)).toFixed(2);
	            // console.log(setTackle);
			    $.ajax({
			    	type: 'POST',
			    	url: '/db/store/logs/all',
			    	data: {logs:logs},
			    	beforeSend: function() {
			    		$('#progress-sync').show();
			    		$('#progress-sync h4').html(' Запишување податоци во база ... ');
			    		NProgress.done(true);
			    		NProgress.start();
			    		NProgress.configure({ minimum: 0.01 });
	            		NProgress.configure({ trickleRate: 0.03, trickleSpeed: 320 });
	            	},
			    	complete: function() {
			    		// $('#overlay').hide();
			    		// $('#progress-sync h4').html('&nbsp;');
			    		NProgress.done(true);
			    	},
			    	success: function(data) {
			    		// get all employees
			    		$.ajax({
			    			type: 'GET',
			    			url: 'api/get/employees',
			    			beforeSend: function() {
			    				$('#progress-sync').show();
					    		$('#progress-sync h4').html(' Вчитување податоци за корисници од уредот ... ');
					    		NProgress.done(true);
					    		NProgress.start();
					    		NProgress.configure({ minimum: 0.01 });
			            		NProgress.configure({ trickleRate: 0.15, trickleSpeed: 180 });
			    			},
			    			complete: function() {
					    		// $('#overlay').hide();
					    		$('#progress-sync h4').html('&nbsp;');
					    		NProgress.done(true);
					    	},
					    	success: function(data) {
					    		// console.log(data);
					    		// store employess to db
					    		$.ajax({
					    			type: 'POST',
					    			url: 'db/store/employees/all',
					    			data: {emp:data},
					    			beforeSend: function() {
					    				$('#progress-sync').show();
							    		$('#progress-sync h4').html(' Запишување податоци во база ... ');
							    		NProgress.done(true);
							    		NProgress.start();
							    		NProgress.configure({ minimum: 0.01 });
					            		NProgress.configure({ trickleRate: setTackle, trickleSpeed: 180 });
									},
									complete: function() {
							    		$('#overlay').hide();
							    		$('#progress-sync h4').html('&nbsp;');
							    		// NProgress.done(true);
							    	},
							    	success: function(data) {
							    		console.log(data);
							    	}
					    		}); // end store emplyees to db
					    	}

			    		}); // end get all employees
			    	}
			    });
	        }
	    });


		// $('#progress-sync').hide();
	});

	/**
	 * FORM Validation using jQuery plugin
	 */

	$('#add-new-device-form').formValidation({
        framework: 'bootstrap',
        excluded: ':disabled',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            inputDeviceName: {
                validators: {
                    notEmpty: {
                        message: 'Ова поле е задолжително'
                    },
                    stringLength: {
                        min: 3,
                        max: 10,
                        message: 'Името мора да биде најмалку 3 а намјмногу 10 карактери долго'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_]+$/,
                        message: 'Името мора да содржи само алфанумерички карактери или долна црта'
                    }
                }
            },
            inputDeviceIP: {
                validators: {
                    notEmpty: {
                        message: 'Ова поле е задолжително'
                    },
                    regexp: {
                        regexp: /^(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/,
                        message: 'Мора да биде валиден формат на IP адресa. (пр. 192.168.1.150)'
                    },
                    callback: {
                            message: 'Веќе постои уред со таа IP адреса',
                            callback: function (value, validator, $field) {
                                return true;
                            }
                        }
                }
            },
            inputDeviceComPass: {
                validators: {
                    numeric: {
                        message: 'Ова поле мора да содржи само нумерички карактери'
                    }
                }
            }
        }
    }).on('success.form.fv', function(e, data) {
            // Prevent form submission
            e.preventDefault();
            var $form = $(e.target),
                fv    = $form.data('formValidation');
            // animate the refresh glyph
            $('i[data-fv-icon-for="inputDeviceIP"]').addClass('gly-spin');

           	fv.updateStatus('inputDeviceIP', 'VALIDATING');
            // Use Ajax to submit form data
            $.ajax({
                url: 'device/check-ip/' + $('#inputDeviceIP').val(),
                type: 'POST',
                data: $form.serialize(),
                success: function(result) {
                    // console.log(result);
                    $('i[data-fv-icon-for="inputDeviceIP"]').removeClass('gly-spin');
                    if(result == 1) {
	                    fv.updateStatus('inputDeviceIP', 'INVALID', 'callback').updateMessage('inputDeviceIP','Веќе постои уред со таква IP адреса');
                    } else {
                    	fv.updateStatus('inputDeviceIP', 'VALID');
                    	fv.defaultSubmit();
                    }
                }
            });
    });

	/*
	* Reset the modal form after closing event
	* clears the inputs and errors
	 */
	$('#add-new-device').on('hidden.bs.modal', function() {
		console.log("modal-reset");
	    $('#add-new-device-form').formValidation('resetForm', true);
	});

});

</script>

@endsection


