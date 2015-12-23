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
	<div class="col-lg-offset-6 col-lg-6">
		<div id="progress-sync" class="progress" style="height: 3px !important; display: none;">
			<div id="progress-bar-sync" class="progress-bar" style="width: 0%;"></div>
			{{-- <div class="percent">0%</div > --}}
		</div>
	</div>
</div>
<hr>
<div class="row">
	<div class="col-md-7">
		<div>
			<div id="progress-connect" class="progress" style="height: 3px !important; display: none;">
				<div id="progress-bar-connect" class="progress-bar" style="width: 0%;"></div>
{{-- 				<div class="percent">0%</div > --}}
			</div>
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

			if($connected_device->connected == 1)
			{
				$tadf = app()->make('TADF',[['ip'=>$connected_device->ip_address]]);
				$tad = $tadf->get_instance();
				$all_user_info = $tad->get_all_user_info()->to_array();
				// dd(isset($all_user_info['Row']));
				if(isset($all_user_info['Row']))
				{
					foreach ($all_user_info['Row'] as $red) { ?>
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
    .modal .modal-dialog { width: 35%; }

    #overlay {
		background-color: rgba(0, 0, 0, 0.8);
	    z-index: 500;
	    position: absolute;
	    left: 0;
	    top: 0;
	    width: 100%;
	    height: 100%;
	    display: none;
		}
	#progress-connect #progress-sync {z-index: 9999;}

</style>

@endsection

@section('scripts')

<script type="text/javascript">


$(window).load(function(){
	NProgress.done();
});

$(document).ready(function(){
	NProgress.configure({ parent: '#nprogress-global' });
	NProgress.start();

	// tooltips
	$('[data-toggle="tooltip"]').tooltip();
	// progress bar hide
	// $('#progress-connect').hide();
	// $('#progress-sync').hide();

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

		$('#device_status').removeClass('alert-danger alert-success').addClass('alert-default').html("<strong>&nbsp;Connecting...&nbsp;</strong>");
		$('#progress-connect').show();
		$('#progress-connect').removeClass("progress-striped");
		$('#progress-bar-connect').css('width', 0 + '%');
		var url_send = "/connect/" + $('.deviceList:checked').val();
		console.log(url_send)
		var i=1;
		var wait_process = setInterval(function(){
			$('#progress-bar-connect').css('width', '' + i + '%');
			i= i + Math.floor(Math.random() * 3) + 1;
		}, 50)
	    $.ajax({
	        type: 'GET',
	        url: url_send,
	        beforeSend: function() {
	        	NProgress.start();
	        },
	        complete: function () {
	        	NProgress.done();
	        },
	        success: function(data) {
	            // console.log(data[0]);
	            clearInterval(wait_process);
	            $('#progress-connect').addClass("progress-striped");
	            $('#progress-bar-connect').toggleClass("progress-striped").css('width', 100 + '%');
	            if(data[0] === true) {
	            	$('#device_status').removeClass('alert-danger').addClass('alert-success').html("<strong>&nbsp;Online&nbsp;</strong>");
	            	$('.deviceList:checked').closest('tr').find('td:eq(5)').html("connected");
	            } else {
	            	$('#device_status').addClass('alert-danger').removeClass('alert-success').html("<strong>&nbsp;Offline&nbsp;</strong>");
	            }
	            setTimeout(function() {
					$('#progress-connect').hide();
			    },500)
	        }
	    });
	});

	/**
	 * Helper functions for animating the progress bar
	 */
	 function setAnimate() {
		$('#progress-sync').removeClass("progress-striped");
	 	$('#progress-sync').show();
		// add spin animation
		$('#btn_sync_all i').removeClass('glyphicon-save').addClass('glyphicon-refresh gly-spin');
		$('#progress-bar-sync').css('width', 0 + '%');
	 }

	 function finishBar() {
		$('#progress-bar-sync').toggleClass("progress-striped").css('width', 100 + '%');
	 }

	 function barAnimate(duration) {
	 	$("#progress-bar-sync").animate({ width:"100%" }, duration)
	 }

	 function clearAnimate() {
	 	$('#btn_sync_all i').addClass('glyphicon-save').removeClass('glyphicon-refresh gly-spin');
	    $('#progress-sync').addClass("progress-striped");
	 }

	 function wait_process(time, counter) {
 		setInterval(function(){
		$('#progress-bar-sync').css('width', '' + counter + '%');
		// counter= counter + Math.floor(Math.random() * 5) + 1;
		counter = counter + 5;
		}, time);
	}

	$('#btn_sync_all').click(function() {

		logs = [];

		setAnimate();
		barAnimate(400);

	    $.ajax({

	        type: 'GET',
	        url: 'api/get/record/bigdata',
	        beforeSend: function(){
	        	$('#overlay').show();
	        },
	        success: function(data) {
	            logs = data;

	            finishBar(function(){
	            	clearAnimate();
	            	setAnimate();
	            	barAnimate(Math.round(data/350));
	            });

	            // hide the progress-bar after 500ms

			    $.ajax({
			    	type: 'POST',
			    	url: '/db/store/logs/all',
			    	data: {logs:logs},
			    	complete: function() {
			    		$('#overlay').hide();
			    	},
			    	success: function(data) {
			    		finishBar();
			    		console.log(data);
	            		clearAnimate();

		      			setTimeout(function() {
							$('#progress-sync').hide();
					    },500);
			    	}
			    });
	        }
	    });


		// $('#progress-sync').hide();
	})


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


