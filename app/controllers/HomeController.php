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
    ** Insertar nuevos registros 
    */
    public function createCategoria() {

        //Obtiene los datos en formato JSON enviados por AJAX
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        //Validacion si se recibio correctamente el dato
        header('Content-Type: application/json');
        if ( isset($data['nameValue']) ) {
            $categoriaModel = $this->load_model('Categoria');
            $resultado = $categoriaModel->guardar($data['nameValue']);
            echo json_encode(['message' => $resultado]);
        }else{
            echo json_encode(['message' => 'Datos incompletos']);
        }
    }
    public function createProveedor() {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        header('Content-Type: application/json');
        if( !empty($data['nameValue']) ) {
            $proveedorModel = $this->load_model('Proveedor');
            $resultado = $proveedorModel->guardarProveedor($data['nameValue']);
            echo json_encode(['message' => $resultado]);
        }else{
            echo json_encode(['message' => 'Datos incompletos']);
        }
    }

    public function deshabilitar($tabla) {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        header('Content-Type: application/json');
        if( isset($data['id_campo']) ) {
            $tablaModel = $this->load_model( ucfirst($tabla) );
            $resultado = $tablaModel->eliminar($data['id_campo']);
            echo json_encode(['message' => $resultado]);
        }else{
            echo json_encode(['message' => 'Datos imcompletos']);
        }
    }

}