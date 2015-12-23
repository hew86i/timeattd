<div class="row">
	<div class="col-lg-7">
	<div class="row">
		<div>
			<h3>
				<span>Информации за записи во уредот</span>
				<div class="btn-group pull-right">
					<button type="button" id="btn_get_all_logs" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="повеќе опции">Вчитај записи</button>
					<a href="#" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a id="a_get_today_logs" href="#!">Записи од денес</a></li>
						<li><a href="#!">Записи од изминатата недела</a></li>
						<li><a id="a_get_24h_logs" href="#!">Записи од последните 24 часа</a></li>
						<li class="divider"></li>
						<li><a href="#!">Друго</a></li>
					</ul>
				</div>
			</h3>
		</div>
	</div>
	<hr>
		<table id="get-all-data" class="table table-condensed">
		<thead>
			<tr>
				<th>#</th>
				<th>ID</th>
				<th>Датум/Време</th>
				<th>Верифициран</th>
				<th>Статус</th>
				<th>Работен Код</th>
			</tr>
		</thead>
		<tbody>
		<div></div>
		</tbody>
		</table>
	</div>
	<div class="col-lg-4 col-lg-offset-1">
		<h3>Информации за корисниците</h3>
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
			// $all_user_info = $user_info;
			// dd($user_info);
			foreach ($user_info as $red) { ?>
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
		?>
		</tbody>
		</table>
		<hr>

		<form class="form-horizontal" method="post">
		<legend>Внеси нов корисник</legend>
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-4 control-label">ID</label>
		    <div class="col-sm-8">
		      <input name="PIN" type="text" class="form-control" id="inputEmail3" value="{{$next_pin}}">
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