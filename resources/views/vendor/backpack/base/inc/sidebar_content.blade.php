<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="las la-stream nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<!-- Marcas, Categorias, Etiquetas, Productos -->
<li class="nav-item nav-dropdown">
	<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon las la-cogs"></i> Gestion Productos</a>
	<ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('tag') }}'><i class='nav-icon las la-tag'></i>Etiquetas</a></li>
	   <li class='nav-item'><a class='nav-link' href='{{ backpack_url('brand') }}'><i class='nav-icon las la-random'></i>Marcas</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('category') }}'><i class='nav-icon las la-align-justify'></i> Categorias</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('empaque') }}'><i class='nav-icon las la-boxes'></i> Empaques</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('productrestriction') }}'><i class='nav-icon las la-lock'></i>Restricciones </a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('product') }}'><i class='nav-icon las la-cog'></i> Productos</a></li>
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('productrequest') }}'><i class='nav-icon las la-store'></i> Productos solicitados</a></li>
	</ul>
</li>




<!-- Users, Roles, Permissions -->
<li class="nav-item nav-dropdown">
	<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon las la-users"></i> Gestion Usuarios</a>
	<ul class="nav-dropdown-items">
	  <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon las la-user-alt"></i> <span>Usuarios</span></a></li>
	  <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-group"></i> <span>Roles</span></a></li>
	  <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i class="nav-icon las la-key"></i> <span>Permisos</span></a></li>
	</ul>
</li>

<li class='nav-item'><a class='nav-link' href='{{ backpack_url('slider') }}'><i class='nav-icon las la-images'></i> Sliders</a></li>





<li class="nav-item nav-dropdown">
	<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon las la-cogs"></i> Gestion Admin</a>
	<ul class="nav-dropdown-items">
        <li class='nav-item'><a class='nav-link' href='{{ backpack_url('log') }}'><i class='nav-icon las la-terminal'></i> Logs</a></li>
	</ul>
</li>


