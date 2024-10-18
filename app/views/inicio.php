<?php require_once  '../app/views/inc/header.php' ?>
    
<div class="container mt-5">
    <h1 class="text-center">Gestión de Almacenamiento</h1>

    <!-- Menú de navegación -->
    <ul class="nav nav-tabs mt-4" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="categorias-tab" data-toggle="tab" href="#categorias" role="tab">Categorías</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="proveedores-tab" data-toggle="tab" href="#proveedores" role="tab">Proveedores</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="productos-tab" data-toggle="tab" href="#productos" role="tab">Productos</a>
        </li>
    </ul>

    <!-- Contenido de cada pestaña -->
    <div class="tab-content mt-4" id="myTabContent">

    <!-- Categorías -->
    <div class="tab-pane fade show active" id="categorias" role="tabpanel">
        <h3>Categorías</h3>
        <table class="table table-bordered table-hover" id="tabla_categorias">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['categorias'] as $categoria): ?>
                    <tr>
                        <td class="id-campo"><?= $categoria['id_categoria'] ?></td>
                        <td><?= $categoria['nombre'] ?></td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button">
                                    ⋮
                                </button>
                                <div class="dropdown-options">
                                    <a href="#">Editar</a><br>
                                    <a href="#">Eliminar</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Botón para agregar nueva categoría -->
        <button class="btn btn-primary toggle-form" data-target="#categoriaForm">Agregar Nueva Categoría</button>

        <!-- Formulario oculto para agregar nueva categoría -->
        <div class="form-container" id="categoriaForm">
            <form id="categoriaForm">
                <input type="hidden" name="categoria" value="categoria">
                <div class="form-group">
                    <label for="nombre_categoria">Nombre de la Categoría:</label>
                    <input type="text" class="form-control" id="nombre_categoria" name="nombre_categoria" required>
                </div>
                <button type="submit" class="btn btn-success guardar">Guardar</button>
            </form>
        <div id="mensaje"></div>
    </div>
</div>

<!-- Proveedores -->
<div class="tab-pane fade" id="proveedores" role="tabpanel">
    <h3>Proveedores</h3>
    <table class="table table-bordered table-hover" id="tabla_proveedores">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['proveedores'] as $proveedor): ?>
                <tr>
                    <td class="id-campo"><?= $proveedor['id_proveedor'] ?></td>
                    <td><?= $proveedor['nombre'] ?></td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button">
                                ⋮
                            </button>
                            <div class="dropdown-options">
                                <a href="#">Editar</a><br>
                                <a href="#">Eliminar</a>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Botón para agregar nuevo proveedor -->
    <button class="btn btn-primary toggle-form" data-target="#proveedorForm">Agregar Nuevo Proveedor</button>

    <!-- Formulario oculto para agregar nuevo proveedor -->
    <div class="form-container" id="proveedorForm">
        <form>
            <input type="hidden" name="proveedor" value="proveedor">
            <div class="form-group">
                <label for="nombre_proveedor">Nombre del Proveedor:</label>
                <input type="text" class="form-control" id="nombre_proveedor" name="nombre_proveedor" required>
            </div>
            <button type="submit" class="btn btn-success guardar">Guardar</button>
        </form>
        <div id="mensaje_proveedor"></div>
    </div>
</div>

<!-- Productos -->
<div class="tab-pane fade" id="productos" role="tabpanel">
    <h3>Productos</h3>
    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Proveedor</th>
                <th>Cantidad</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['productos'] as $producto): ?>
                <tr>
                    <td class="id-campo"><?= $producto['id_producto'] ?></td>
                    <td><?= $producto['nombre'] ?></td>
                    <td><?= $producto['categoria'] ?></td>
                    <td><?= $producto['proveedor'] ?></td>
                    <td><?= $producto['cantidad'] ?></td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button">
                                ⋮
                            </button>
                            <div class="dropdown-options">
                                <a href="#">Editar</a><br>
                                <a href="#">Eliminar</a>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Botón para agregar nuevo producto -->
    <button class="btn btn-primary toggle-form" data-target="#productoForm">Agregar Nuevo Producto</button>

    <!-- Formulario oculto para agregar nuevo producto -->
    <div class="form-container" id="productoForm">
        <form>
            <input type="hidden" name="producto" value="producto">
            <div class="form-group">
                <label for="nombre_producto">Nombre del Producto:</label>
                <input type="text" class="form-control" id="nombre_producto" name="nombre_producto" required>
            </div>
            <div class="form-group">
                <label for="categoria_producto">Categoría:</label>
                <select class="form-control" id="categoria_producto" name="categoria_producto">
                    <?php foreach ($data['categorias'] as $categoria): ?>
                        <option value="<?= $categoria['id_categoria'] ?>"><?= $categoria['nombre'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="proveedor_producto">Proveedor:</label>
                <select class="form-control" id="proveedor_producto" name="proveedor_producto">
                    <?php foreach ($data['proveedores'] as $proveedor): ?>
                        <option value="<?= $proveedor['id_proveedor'] ?>"><?= $proveedor['nombre'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="cantidad_producto">Cantidad:</label>
                <input type="number" class="form-control" id="cantidad_producto" name="cantidad_producto" required>
            </div>
            <button type="submit" class="btn btn-success guardar">Guardar</button>
        </form>
    </div>
</div>


<?php require_once  '../app/views/inc/footer.php' ?>