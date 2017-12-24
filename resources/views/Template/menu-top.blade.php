<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<a class="navbar-brand" href="#">Pegaza</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarNavDropdown">
	    <ul class="navbar-nav">
	      <li class="nav-item dropdown">
	        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	          <span class="icon icon-books"></span>	Catalogos
	        </a>
	        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
	          <a class="dropdown-item" href="{{route('cuentas')}}"><span class="icon icon-credit-card"></span> Cuentas</a>
	          <a class="dropdown-item" href="{{route('empleado')}}"><span class="icon icon-users"></span> Empleado</a>
	          <a class="dropdown-item" href="{{route('cliente')}}"><span class="icon icon-user"></span> Cliente</a>
	          <a class="dropdown-item" href="{{route('proveedor')}}"><span class="icon icon-user-tie"></span> Proveedor</a>
	          <a class="dropdown-item" href="{{route('vehiculo')}}"><span class="icon icon-truck"></span> Vehiculo</a>
	          <a class="dropdown-item" href="{{route('mat_prima')}}"><span class="icon icon-droplet"></span> Materia Prima</a>
	          <a class="dropdown-item" href="{{route('producto')}}"><span class="icon icon-briefcase"></span> Produto</a>
	        </div>
	      </li>
	    </ul>
	    <ul class="navbar-nav">
	      <li class="nav-item dropdown">
	        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	          <span class="icon icon-drawer"></span>	Modulos
	        </a>
	        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
	          <a class="dropdown-item" href="{{route('caja')}}"><span class="icon icon-users"></span> Caja</a>
	      </li>
	    </ul>
	    <ul class="navbar-nav ml-auto">
	      <li class="nav-item dropdown">
	        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	          <span class="icon icon-user"></span>	<?php echo Auth::user()->usuario ?>
	        </a>
	        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
	          <a class="dropdown-item" href="{{route('logout')}}"><span class="icon icon-exit"></span> Salir</a>
	        </div>
	      </li>
	    </ul>
	</div>
</nav>