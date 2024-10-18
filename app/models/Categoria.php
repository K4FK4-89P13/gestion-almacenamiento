<?php
class Categoria extends Model {

    public function getAllCategoria() {
        $sql = "SELECT * FROM categorias";
        $stmt = $this->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function guardar($nombre) {

        $sql = "INSERT INTO categorias (nombre) VALUES (?)";
        $stmt = $this->db->prepare($sql);
        if ($stmt->execute([$nombre])) {
            return "Categoría guardada exitosamente.";
        } else {
            return "Error al guardar la categoría.";
        }
        $stmt->close();
    }
}