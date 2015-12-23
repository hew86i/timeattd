@extends('layouts.master')

@section('content')

<div class="container">
	<h1>Информации за корисниците</h1>
	<hr>

	<div class="row">
		<div class="col-md-7">
			<h3>Листа на корисници</h3>
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
				@foreach($all_users as $red)
				<tr>
					<td> {{$red['pin']}}</td>
					<td> {{$red['name']}}</td>
					<td> {{$red['password']}}</td>
					<td> {{$red['group']}}</td>
					<td> {{$red['card']}}</td>
					<td> {{$red['privilege']}}</td>
				</tr>
				@endforeach
			</tbody>
			</table>
			<hr>
		</div>
		<div class="col-md-5">
			<h3>Внеси / Измени корисник</h3>
			<hr>
			<form class="form-horizontal" id="add-employee-form" method="post">
			<legend>Внеси нов корисник</legend>
			  <div class="form-group form-group-sm">
			    <label for="inputName" class="col-sm-4 control-label">Име</label>
			    <div class="col-sm-8">
			      <input name="name" type="text" class="form-control" id="inputName" placeholder="Корисничко име">
			    </div>
			  </div>
			  <div class="form-group form-group-sm">
			    <label for="inputPassword3" class="col-sm-4 control-label">PIN Број</label>
			    <div class="col-sm-8">
			      <input name="password" type="password" class="form-control" id="inputPassword3" placeholder="PIN Број">
			    </div>
			  </div>
			  <div class="form-group form-group-sm">
			    <label for="inputCard" class="col-sm-4 control-label">Картичка</label>
			    <div class="col-sm-8">
			      <input name="card" type="text" class="form-control" id="inputCard" placeholder="Внесете валиде број на картичка">
			    </div>
			  </div>
			  <div class="form-group form-group-sm">
			    <div class="col-sm-offset-6 col-sm-6">
			      <div class="btn-toolbar pull-right">
			        <button type="submit" id="btn_save_employee" form="add-employee-form" class="btn btn-default btn-sm">Внеси</button>
			  	    <input type="hidden" name="_token" value="{{ csrf_token() }}">
			      </div>
			    </div>
			  </div>
			</form>
		</div>
	</div>

</div>

@endsection

@section('scripts')

<script>

$(document).ready(function(){

	/**
	 * FORM Validation using jQuery plugin
	 */

	$('#add-employee-form').formValidation({
        framework: 'bootstrap',
        excluded: ':disabled',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: 'Ова поле е задолжително'
                    },
                    stringLength: {
                        min: 3,
                        max: 7,
                        message: 'Името мора да биде најмалку 3 а намјмногу 7 карактери долго'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_]+$/,
                        message: 'Името мора да содржи само алфанумерички карактери или долна црта'
                    }
                }
            },
            password: {
                validators: {
                    digits: {
                        message: 'Лозинката мора да содржи само броеви'
                    },
                    stringLength: {
                        min: 1,
                        max: 5,
                        message: 'Лозинката може да содржи најмногу до 5 броеви'
                    }
                }
            },
            card: {
                validators: {
                    digits: {
                        message: 'Ова поле мора да содржи само броеви'
                    },
                    stringLength: {
                        min: 8,
                        max: 10,
                        message: 'Лозинката може да содржи најмногу до 10 броеви'
                    }
                }
	        }
	    }
    }).on('success.form.fv', function(e, data) {
            // Prevent form submission
            // e.preventDefault();
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

});


</script>

@endsection
