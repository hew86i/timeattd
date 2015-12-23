<nav id="master_nav" class="navbar navbar-default" style="margin-bottom: 0px;">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
        <a class="navbar-brand" href="#"><i class="glyphicon glyphicon-time"></i> : SC403</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        @if (Auth::guest())
        <li><a href="/">Најава <span class="sr-only">(current)</span></a></li>
        @else
        <li><a href="/">Почетна <span class="sr-only">(current)</span></a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Уреди <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a id="a_add_new_device" href="#">Додади уред</a></li>
            <li><a href="#">Промени уред</a></li>
            <li><a href="#">Избриши уред</a></li>
            <li class="divider"></li>
            <li><a href="device/add">Статус на уредот</a></li>
          </ul>
        </li>
        <li><a href="/employess"><i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp;Корисници</a></li>
        <li><a href="/logs"><i class="glyphicon glyphicon-list alt"></i>&nbsp;&nbsp;Записи</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Мени <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul>
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Пребарај">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            {{ Auth::user()->name }} <span class="caret"></span>
          </a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#!"><i class="fa fa-btn fa-sign-out"></i>Инфо</a></li>
            <li><a href="#!"><i class="fa fa-btn fa-sign-out"></i>Промени</a></li>
            <li class="divider"></li>
            <li><a href="/logout"><i class="fa fa-btn fa-sign-out"></i>Одјава</a></li>
          </ul>
        </li>

      </ul>
      @endif
    </div>
  </div>
</nav>
<div id="nprogress-global" class="container-fluid">&nbsp;</div>
