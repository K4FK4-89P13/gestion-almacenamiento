
import { apiRequest } from "./modules/api.js";
import { domUpdates } from "./modules/domUpdates.js";


$(document).ready(function() {
    // Mostrar/ocultar el formulario al hacer clic en el botón
    $('.toggle-form').on('click', function() {
        var targetForm = $(this).data('target');
        $(targetForm).toggle();
    });
});


//Peticiones AJAX
const dropdown = `<div class='dropdown'>
                    <button class='btn btn-secondary dropdown-toggle' type='button' data-bs-toggle='dropdown'>⋮</button>
                    <div class='dropdown-menu'>
                        <a href="" class='dropdown-item'>Editar</a>
                        <a href="" class='eliminar dropdown-item'>Eliminar</a>
                        <input type="hidden" name="producto" value="producto" class="hidden">
                    </div>
                </div>`;


function actualizar(modelo) {
    apiRequest(`http://product.test/Home/show/${modelo}`, 'GET')
        .then(data => {
            const tbody = document.getElementById(`tabla_${modelo}`).querySelector('tbody');
            tbody.innerHTML = "";
            const id_tabla = 'id_' + modelo;

            data.forEach(item => {
                let row = `<tr>
                            <td class="id-cell">${item[id_tabla]}</td>
                            <td>${item.nombre}</td>
                            <td>${dropdown}</td>
                            </tr>`;
                tbody.innerHTML += row;
            });
            asignarEventosEliminar(modelo);
        })
        .catch(err => console.error(`Error al obtener ${modelo}`, err));
}

function registrar(etiqueta, modelo) {
    const modelo_firstMayus = modelo.charAt(0).toUpperCase() + modelo.slice(1);
    const nombre_tabla = document.getElementById(`nombre_${modelo}`).value;
    let data = { nameValue: nombre_tabla };
    apiRequest(`http://product.test/Home/create${modelo_firstMayus}`, 'POST', data)
        .then( (response) => {
            console.log('Success: ', response);
            domUpdates(etiqueta, response.message, 'success');

            actualizar(modelo);
        })
        .catch( (err) => {
            console.error("Error: ", err);
            domUpdates(etiqueta, err, 'danger');
        })
}


/* Nuevos Registros */
const botones = document.querySelectorAll(".guardar");
const forms = document.getElementsByTagName('form');
for (let i = 0; i < botones.length; i++) {
    forms[i].addEventListener('submit', (e) => {e.preventDefault()}); // Evitar el envio predeterminado del formulario
}
botones[0].addEventListener('click', () => registrar('mensaje_categoria', 'categoria'));
botones[1].addEventListener('click', () => registrar('mensaje_proveedor', 'proveedor'));
botones[2].addEventListener('click', () => registrar('mensaje_producto', 'producto'));


/* Eliminar registros */
asignarEventosEliminar();
function asignarEventosEliminar(modelo = null) {
    const botonesEliminar = document.querySelectorAll('.eliminar');
    const modelos = document.getElementsByClassName('hidden');

    for (let i = 0; i < botonesEliminar.length; i++) {
        botonesEliminar[i].addEventListener('click', (e) => {
            const row = botonesEliminar[i].closest('tr');
            const idCampo = row.querySelector('.id-cell').textContent.trim();
            const data = { 'id_campo': idCampo };
            const tablaUrl = modelo ? modelo : modelos[i].value;
            
            if(confirm('¿Esta seguro de eliminar este registro?')) {
                apiRequest(`http://product.test/Home/deshabilitar/${tablaUrl}`, 'POST', data)
                    .then( (res) => {
                        console.log("Success: ", res);
                        actualizar(tablaUrl);
                        domUpdates(`mensaje_${modelos[i].value}`, res.message, 'success');
                    })
                    .catch( (err) => {
                        console.error("Error: ", err);
                        domUpdates(`mensaje_${modelos[i].value}`, err.message, 'danger');
                    })
            }
        }); 
    }
}