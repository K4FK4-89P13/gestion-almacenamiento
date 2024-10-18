<?php

class HomeController extends Controller {

    public function index() {
        $categoriaModel = $this->load_model('Categoria');
        $categorias = $categoriaModel->getAllCategoria();

        $proveedorModel = $this->load_model('Proveedor');
        $proveedores = $proveedorModel->getAllProveedor();

        $productoModel = $this->load_model('Producto');
        $productos = $productoModel->getAllProducto();

        $data = [
            'title' => 'Gestión de Almacenamiento',
            'categorias' => $categorias,
            'proveedores' => $proveedores,
            'productos' => $productos
        ];
        $this->load_view('inicio', $data);
    }


    /* 
    ** Consulta de todos los registros
    */
    public function show($modelo) {
        $modeloModel = $this->load_model(ucfirst($modelo));
        $metodoSelect = "getAll" . ucfirst(strtolower($modelo));
        $resultQuery = $modeloModel->$metodoSelect();
        header('Content-Type: application/json');
        echo json_encode($resultQuery);
    }


    /* 
    ** Insertar uevos registros 
    */
    public function createCategoria() {

        //Obtiene los datos en formato JSON enviados por AJAX
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        //Validacion si se recibio correctamente el dato
        if ( isset($data['nameCategoria']) ) {
            $categoriaModel = $this->load_model('Categoria');
            $resultado = $categoriaModel->guardar($data['nameCategoria']);
            echo json_encode(['message' => $resultado]);
        }else{
            echo json_encode(['message' => 'Datos imcompletos']);
        }
    }
    public function createProveedor() {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if( isset($data['nameProveedor']) ) {
            $proveedorModel = $this->load_model('Proveedor');
            $resultado = $proveedorModel->guardarProveedor($data['nameProveedor']);
            echo json_encode(['message' => $resultado]);
        }else{
            echo json_encode(['message' => 'Datos imcompletos']);
        }
    }


    /* 
    ** Deshabilitar registros
    */
    public function deshabilitarCategoria($id) {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if( isset($data['id_categoria']) ) {
            $categoriaModel = $this->load_model('Categoria');
            $resultado = $categoriaModel->deshabilitar($data['id_categoria']);
            echo json_encode(['message' => $resultado]);
        }else{
            echo json_encode(['message' => 'Datos imcompletos']);
        }
    }
    public function deshabilitar($tabla) {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        $id_campo = "id_" . strtolower($tabla);
        if( isset($data[$id_campo]) ) {
            $tablaModel = $this->load_model( ucfirst($tabla) );
            $resultado = $tablaModel->deshabilitar($data[$id_campo]);
            echo json_encode(['message' => $resultado]);
        }else{
            echo json_encode(['message' => 'Datos imcompletos']);
        }
    }
}