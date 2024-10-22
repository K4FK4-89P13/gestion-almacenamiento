<?php
class Categoria extends Model {

    public function getAllCategoria() {
        $sql = "SELECT id_categoria, nombre FROM categoria WHERE estado = 1";
        $stmt = $this->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function guardar($nombre) {

        $sql = "INSERT INTO categoria (nombre) VALUES (?)";
        $stmt = $this->db->prepare($sql);
        if ($stmt->execute([$nombre])) {
            return "Categoría guardada exitosamente.";
        } else {
            return "Error al guardar la categoría.";
        }
        $stmt->close();
    }

    public function eliminar($id) {
        $sql = "UPDATE categoria SET estado = 0 WHERE id_categoria = ?";
        $stmt = $this->db->prepare($sql);
        if( $stmt->execute([$id]) ) {
            return "Categoria eliminada correctamente";
        }else {
            return "Error al eliminar la categoria";
        }
    }
}