<?php

class AuthController extends Controller {

    public function index() {
        if( isset($_SESSION['admin']) ) {
            $adminModel = $this->load_model('Administrador');
            $admin = $adminModel->getAllAdministrador();
            //cargar la vista inicio
            $this->load_view('admin/lista', [
                'title' => 'Administradores',
                'administradores' => $admin
            ]);
        }else {
            $this->load_view('auth/login', ['title' => 'Login']);
        }
    }

    public function login() {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        $adminModel = $this->load_model('Administrador');
        $admin = $adminModel->autenticacion($data['dni'], $data['contrasenia']);

        header('Content-Type: application/json');
        if($admin) {
            $_SESSION['admin'] = $admin['nombres'];
            echo json_encode([
                'success' => true,
                'message' => 'Login exitoso'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Dni o contraseña incorrectos'
            ]);
        }
    }

    public function logout() {
        session_destroy();
        header("Location: http://product.test");
    }
}