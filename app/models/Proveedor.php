<?php

class Proveedor extends Model {

    public function getAllProveedor() {
        $sql = "SELECT * FROM proveedor";
        $stmt = $this->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Métodos adicionales para agregar, editar o eliminar proveedores

    public function guardarProveedor($nombre) {
        $sql = "INSERT INTO proveedor (nombre) VALUES (?)";
        $stmt = $this->db->prepare($sql);
        if( $stmt->execute([$nombre]) ) {
            return "Proveedor guardado exitosamente";
        }else{
            return "Error al guardar el Proveedor";
        }
        $stmt->close();
    }
}