<?php

class Model {

    protected $db;

    public function __construct() {

        $this->db = new PDO('mysql:host=localhost;dbname=dbalmacen', 'root', '');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // Método genérico para ejecutar consultas
    protected function query($sql, $params = []) {
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            echo "Error en la consulta: " . $e->getMessage();
        }
    }
}