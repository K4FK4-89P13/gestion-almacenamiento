
// Mostrar/Ocultar las opciones de edición y eliminación
$(document).ready(function () {
    $('.dropdown-toggle').on('click', function () {
        $(this).next('.dropdown-options').toggle();
    });

    // Ocultar el menú cuando se hace clic fuera de él
    $(document).on('click', function (e) {
        if (!$(e.target).closest('.dropdown').length) {
            $('.dropdown-options').hide();
        }
    });
});

$(document).ready(function() {
    // Mostrar/ocultar el formulario al hacer clic en el botón
    $('.toggle-form').on('click', function() {
        var targetForm = $(this).data('target');
        $(targetForm).toggle();
    });
});


//Peticiones AJAX
const botones = document.getElementsByClassName("guardar");
const forms = document.getElementsByTagName('form');
const dropdown = `<div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button">⋮</button>
                    <div class="dropdown-options">
                        <a href="#">Editar</a><br>
                        <a href="#">Eliminar</a>
                    </div>
                </div>`;

function actualizarCategorias() {
    fetch('http://product.test/Home/show/categoria')
        .then(res => res.json())
        .then(data => {
            const tbody = document.getElementById('tabla_categorias').querySelector('tbody');
            tbody.innerHTML = "";

            data.forEach(categoria => {
                let row = `<tr>
                            <td>${categoria.id_categoria}</td>
                            <td>${categoria.nombre}</td>
                            <td>${dropdown}</td>
                            </tr>`;
                tbody.innerHTML += row;
            });
        })
        .catch(err => console.error("Error al obtener categorias", err));
}
function actualizarProveedores() {
    fetch('http://product.test/Home/show/proveedor')
        .then(res => res.json())
        .then(data => {
            const tbody = document.getElementById('tabla_proveedores').querySelector('tbody');
            tbody.innerHTML = "";

            data.forEach(proveedor => {
                let row = `<tr>
                            <td>${proveedor.id_proveedor}</td>
                            <td>${proveedor.nombre}</td>
                            <td>${dropdown}</td>
                        </tr>`;
                tbody.innerHTML += row;
            });
        })
        .catch(err => console.error("Error al obtener proveedores", err));
}

// Evitar el envio predeterminado del formulario
for (let i = 0; i < botones.length; i++) {
    forms[i].addEventListener('submit', (e) => {e.preventDefault()});
}

botones[0].addEventListener("click", () => {

    //Insertar datos a la tabla 'Categorias'
    const nombre_categoria = document.getElementById('nombre_categoria').value;
    let data = {
        nameCategoria: nombre_categoria
    }
    fetch('http://product.test/Home/createCategoria', {
        method: 'POST',
        body: JSON.stringify(data),
        headers: { "Content-Type": "application/json" }
    })
        .then( (res) => res.json() )
        .then( (response) => {
            console.log("Succes: ", response);
            document.getElementById('mensaje').innerHTML = `<p class="alert alert-success">${response.message}</p>`;

            actualizarCategorias();
        })
        .catch( (err) => {
            console.error("Error: ", err);
            document.getElementById('mensaje').innerHTML = `<p class="alert alert-danger">Error: ${err}</p>`;
        });

});

botones[1].addEventListener('click', () => {
    // Nuevos registros
    const nombre_proveedor = document.getElementById('nombre_proveedor').value;
    let data = { nameProveedor: nombre_proveedor };
    fetch('http://product.test/Home/createProveedor', {
        method: 'POST',
        body: JSON.stringify(data),
        headers: { "Content-Type": "application/json" }
    })
        .then( (res) => res.json() )
        .then( (response) => {
            console.log('Success: ', response);
            document.getElementById('mensaje_proveedor').innerHTML = `<p class="alert alert-success alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>${response.message}</p>`;

            actualizarProveedores();
        })
        .catch( (err) => {
            console.error("Error: ", err);
            document.getElementById('mensaje_proveedor').innerHTML = `<div class="alert alert-danger alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>${err}</div>`;
        })
});
