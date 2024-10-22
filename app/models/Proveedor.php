<?php

class Proveedor extends Model {

    public function getAllProveedor() {
        $sql = "SELECT id_proveedor, nombre FROM proveedor WHERE estado = 1";
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

    public function eliminar($id) {
        $sql = "UPDATE proveedor SET estado = 0 WHERE id_proveedor = ?";
        $stmt = $this->db->prepare($sql);
        if( $stmt->execute([$id]) ) {
            return "Proveedor eliminada correctamente";
        }else {
            return "Error al eliminar la proveedor";
        }
    }
}