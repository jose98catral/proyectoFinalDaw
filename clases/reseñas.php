<?php

class Reseñas {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function insertarReseñas($nombre, $resena, $calificacion, $usuario) {
        $fecha = date('Y-m-d');
        $sql = "INSERT INTO reseñas (usuario, nombre, reseña, calificacion,fecha) VALUES ('$usuario', '$nombre', '$resena', '$calificacion','$fecha')";
        $result = mysqli_query($this->db, $sql);
        return $result;
    }


    public function contarReseñas() {
        // Realizar la consulta para contar el número total de reseñas en la base de datos
        $query = "SELECT COUNT(*) AS total FROM reseñas";
        $result = $this->db->query($query);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['total'];
        }

        return 0;
    }

    public function obtenerUltimasReseñas($inicio, $cantidad) {
        // Realizar la consulta para obtener las últimas reseñas
        $query = "SELECT * FROM reseñas ORDER BY fecha DESC LIMIT $inicio, $cantidad";
        $result = $this->db->query($query);

        return $result;
    }
}

?>