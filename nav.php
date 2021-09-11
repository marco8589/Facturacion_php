<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" style="font-size: 30px;" href="menu.php">Sistema De facturacion</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01"
        aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>


    <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav ml-auto">

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                    aria-expanded="false"> Usuarios</a>

                <div class="dropdown-menu">
                    <a class="dropdown-item" href="registro_usuario.php">Nuevo Usuario</a>
                    <a class="dropdown-item" href="lista_usuarios.php">Lista de Usuarios</a>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                    aria-expanded="false">Clientes</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="registro_cliente.php">Nuevo Cliente</a>
                    <a class="dropdown-item" href="lista_clientes.php">Lista de Clientes</a>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                    aria-expanded="false">Proveedores</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="facturacion.php">Nuevo Proveedor</a>
                    <a class="dropdown-item" href="reporte_factura.php">Lista de Proveedores</a>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                    aria-expanded="false">Productos</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="facturacion.php">Nuevo Producto</a>
                    <a class="dropdown-item" href="reporte_factura.php">Lista de Productos</a>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                    aria-expanded="false">Facturas</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="facturacion.php">Nuevo Factura</a>
                    <a class="dropdown-item" href="reporte_factura.php">Facturas</a>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="cerrar_sesion.php" role="button" aria-haspopup="true"
                    aria-expanded="false">Cerrar
                    Sesión</a>
            </li>
        </ul>

    </div>



</nav>