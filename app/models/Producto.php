<?php

class Producto extends Model {

    public function getAllProducto() {
        $sql = "SELECT producto.*, categoria.nombre AS categoria, proveedor.nombre AS proveedor 
                FROM producto
                JOIN categoria ON producto.fk_categoria = categoria.id_categoria
                JOIN proveedor ON producto.fk_proveedor = proveedor.id_proveedor";
        $stmt = $this->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Métodos adicionales para agregar, editar o eliminar productos

    public function deshabilitar($id) {
        $sql = "UPDATE producto SET estado = 0 WHERE id_producto = ?";
        $stmt = $this->db->prepare($sql);
        if( $stmt->execute([$id]) ) {
            return "Producto eliminada correctamente";
        }else {
            return "Error al eliminar la producto";
        }
    }
}