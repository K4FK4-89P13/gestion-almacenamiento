<?php

class Producto extends Model {

    public function getAllProducto() {
        $sql = "SELECT productos.*, categorias.nombre AS categoria, proveedor.nombre AS proveedor 
                FROM productos
                JOIN categorias ON productos.fk_categoria = categorias.id_categoria
                JOIN proveedor ON productos.fk_proveedor = proveedor.id_proveedor";
        $stmt = $this->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Métodos adicionales para agregar, editar o eliminar productos

    public function insertProducto() {
        $sql = "";
    }
}