@extends('layouts.master')

@section('content')
{{-- {{dd($logs->all())}} --}}
<div class="container">

	<div class="row">
		{{$zk->init()}}
		<div class="col-xs-3">
			<form class="form-horizontal">
		            <div class="form-group form-group-sm">
			 			<label for="dt_1" class="col-sm-3 control-label">од: </label>
		                <div class='col-sm-8 input-group date' id='dt_1'>
		                    <input type='text' class="form-control" />
		                    <span class="input-group-addon input-sm">
		                        <span class="glyphicon glyphicon-calendar"></span>
		                    </span>
		                </div>
		            </div>
		            <div class="form-group form-group-sm">
		            	<label for="dt_2" class="col-sm-3 control-label">до: </label>
		                <div class='col-sm-8 input-group date' id='dt_2'>
		                    <input type='text' class="form-control" />
		                    <span class="input-group-addon input-sm">
		                        <span class="glyphicon glyphicon-calendar"></span>
		                    </span>
		                </div>
		            </div>
			</form>
		</div>
		<div class="col-xs-1">
			<div class="btn-toolbar pull-right">
                  <button type="button" id="btn_get_logs" class="btn btn-default btn-sm">Пребарај</button>
            </div>
		</div>

	</div>

	<div class="row">
		<div class="col-md-12">

			<div class="tabbable" >
				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active">
						<a href="#home" aria-controls="home" role="tab" data-toggle="tab">Влез/Излез</a>
					</li>
					<li role="presentation">
						<a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile</a>
					</li>
					<li role="presentation">
						<a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Messages</a>
					</li>
					<li role="presentation">
						<a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a>
					</li>
				</ul>

				<div class="tab-content">

					<div role="tabpanel" class="tab-pane active" id="home">

						<table id="table_t1" class="table table-condensed"

								data-classes="table-no-bordered"
								data-search="true"
								data-locale="mk-MK"
								style="display: none">
							<thead>
								<tr>
									<th data-field="id">#</th>
									<th data-field="datetime">Датум/Време</th>
									<th data-field="name">Вработен</th>
									<th data-field="status">Статус код</th>
									<th data-field="workcode">Работен код</th>
									<th data-field="device_name">Уред</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
						<hr>
					</div>

					<div role="tabpanel" class="tab-pane" id="profile">...</div>
					<div role="tabpanel" class="tab-pane" id="messages">...</div>
					<div role="tabpanel" class="tab-pane" id="settings">...</div>

				</div>

			</div>
			<!--/Tabbable-->

		</div>
	</div>

</div>
@endsection

@section('styles')
<style></style>
@endsection

@section('scripts')
<script type="text/javascript">

function getHeight() {
    return $(window).height() - 250;
}

$(document).ready(function(){

    var dtp_1 = "";
    var dtp_2 = "";
    var $table = $('#table_t1');

    $('#dt_1').datetimepicker({
        locale: 'mk',

    });
    $('#dt_2').datetimepicker({
        useCurrent: false,
        locale: 'mk',
    });
    $("#dt_1").on("dp.change", function (e) {
        $('#dt_2').data("DateTimePicker").minDate(e.date);
        $('#dt_2').data("DateTimePicker").maxDate(moment());
    	$('#dt_1').data("DateTimePicker").format("YYYY-MM-DD HH:mm:ss");
    	dtp_1 = $('#dt_1 input').val();
    	$('#dt_1').data("DateTimePicker").format(false);
    });
    $("#dt_2").on("dp.change", function (e) {
        $('#dt_1').data("DateTimePicker").maxDate(e.date);
    	$('#dt_2').data("DateTimePicker").format("YYYY-MM-DD HH:mm:ss");
    	dtp_2 = $('#dt_2 input').val();
    	$('#dt_2').data("DateTimePicker").format(false);
    });

    $("#btn_get_logs").on('click', function() {

	    var get_url = '/db/date/' + dtp_1 + '/' + dtp_2;

    	$table.show();
		$table.bootstrapTable('destroy');

	    $table.bootstrapTable({
	    	height: getHeight(),
	    	method: 'get',
	    	url : get_url
	    });

		$('.bootstrap-table input').addClass('input-sm')
    	console.log(dtp_1 + " * " + dtp_2);
    });



});

</script>
@endsection
