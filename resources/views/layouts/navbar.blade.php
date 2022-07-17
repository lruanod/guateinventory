<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">guateinventory.com</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Home</a>
                </li>
                @if(empty(session('usuario')))
                <li class="nav-item">
                    <a class="nav-link" href="/formlogin">Ingresar</a>
                </li>
                @endif
                @if(!empty(session('usuario')))
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-bs-toggle="dropdown" aria-expanded="true" >Productos</a>
                        <ul class="dropdown-menu" aria-labelledby="dropdown01">
                            <li><a class="dropdown-item" href="{{url('/form_categoria')}}">Registrar categorías</a></li>
                            <li><a class="dropdown-item" href="{{url('/list_categoria')}}">Listar categorías</a></li>
                            <li><a class="dropdown-item" href="{{url('/form_medida')}}">Registrar medidas</a></li>
                            <li><a class="dropdown-item" href="{{url('/list_medida')}}">Listar medidas</a></li>
                            <li><a class="dropdown-item" href="{{url('/list_producto')}}">Listar productos</a></li>
                            <li><a class="dropdown-item" href="{{url('/form_producto')}}">Registrar productos</a></li>
                            <li><a class="dropdown-item" href="{{url('/form_entrada')}}">Registrar entradas</a></li>
                            <li><a class="dropdown-item" href="{{url('/list_entrada')}}">Listar entradas</a></li>
                        </ul>
                    </li>
                @endif
                @if(!empty(session('usuario')))
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-bs-toggle="dropdown" aria-expanded="true" >{{session('usuario')}}</a>
                        <ul class="dropdown-menu" aria-labelledby="dropdown01">
                            <li><a class="dropdown-item" href="{{url('/form_updatepass')}}">Cambiar contraseña</a></li>
                            <li><a class="dropdown-item" href="{{url('/logout')}}">Cerrar sesión</a></li>
                        </ul>
                    </li>
                @endif
                @if(!empty(session('usuario')))
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-bs-toggle="dropdown" aria-expanded="true" >Clientes</a>
                        <ul class="dropdown-menu" aria-labelledby="dropdown01">
                            <li><a class="dropdown-item" href="{{url('/form_cliente')}}">Registrar cliente</a></li>
                            <li><a class="dropdown-item" href="{{url('/list_cliente')}}">Listar cliente</a></li>
                        </ul>
                    </li>
                @endif
                @if(!empty(session('usuario')))
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-bs-toggle="dropdown" aria-expanded="true" >Reportes</a>
                        <ul class="dropdown-menu" aria-labelledby="dropdown01">
                            <li><a class="dropdown-item" href="{{url('/form_reporte')}}">Reportes de ventas</a></li>
                            <li><a class="dropdown-item" href="{{url('/form_reportestock')}}">Reportes de stock actual</a></li>
                            <li><a class="dropdown-item" href="{{url('/form_reporte_entrada')}}">Reportes de entradas</a></li>

                        </ul>
                    </li>
                @endif

                @if(!empty(session('usuario')))
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-bs-toggle="dropdown" aria-expanded="true" >Proveedores</a>
                        <ul class="dropdown-menu" aria-labelledby="dropdown01">
                            <li><a class="dropdown-item" href="{{url('/form_proveedore')}}">Registrar Proveedores</a></li>
                            <li><a class="dropdown-item" href="{{url('/list_proveedore')}}">Listar provedores</a></li>
                        </ul>
                    </li>
                @endif
                @if(!empty(session('usuario')))
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-bs-toggle="dropdown" aria-expanded="true" >Facturas</a>
                        <ul class="dropdown-menu" aria-labelledby="dropdown01">
                            <li><a class="dropdown-item" href="{{url('/form_factura')}}">Registrar factura</a></li>
                            <li><a class="dropdown-item" href="{{url('/list_factura')}}">Listar factura</a></li>
                        </ul>
                    </li>
                @endif
                @if(!empty(session('usuario')))
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-bs-toggle="dropdown" aria-expanded="true" >Formas de pago</a>
                        <ul class="dropdown-menu" aria-labelledby="dropdown01">
                            <li><a class="dropdown-item" href="{{url('/form_fpago')}}">Registrar forma de pago</a></li>
                            <li><a class="dropdown-item" href="{{url('/list_fpago')}}">Listar formas de pago</a></li>
                        </ul>
                    </li>
                @endif
                @if(!empty(session('usuario')&&session('rol')=='Administrador'))
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-bs-toggle="dropdown" aria-expanded="true" >Usuarios</a>
                        <ul class="dropdown-menu" aria-labelledby="dropdown01">
                            <li><a class="dropdown-item" href="{{url('/form_usuario')}}">Registrar usuarios</a></li>
                            <li><a class="dropdown-item" href="{{url('/list_usuario')}}">Listar usuarios</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
