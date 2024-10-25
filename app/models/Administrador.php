<?php

class Administrador extends Model {

    public function autenticacion($dni, $password) {
        $sql = "SELECT administrador.nombres FROM administrador WHERE dni = ? AND contrasenia = ?";
        $stmt = $this->db->prepare($sql);
        if( $stmt->execute([$dni, $password]) ) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }else{
            return 'No hubo coincidencias';
        }
    }

    public function getAllAdministrador() {
        $sql = "SELECT idAdm, nombres, dni, direccion, telefono FROM administrador WHERE habilitado = 1";
        $stmt = $this->db->prepare($sql);
        if($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return 'No se pudo obtener los administradores';
        }
    }
}