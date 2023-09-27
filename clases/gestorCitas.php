<?php

// clase para crear citas
class GestorCitas {
    

    public function __construct($db) {
        $this->db = $db;
    }
// funcion para traer los datos de la tabla pelados
    public function importarDatos() {
        $consulta = 'SELECT * FROM pelados';
        $resultado = mysqli_query($this->db, $consulta);
        return $resultado;
    }
// funcion para traer los datos de la tabla horas
    public function buscarHoras() {
        $query = "SELECT * FROM horas";
        $listaHoras = mysqli_query($this->db, $query);
        return $listaHoras;
    }
// funcion para comprobar que la fecha y hora no se repite
    public function comprobarFechaHora($fecha, $hora) {
        $query = "SELECT * FROM cita WHERE fecha = '$fecha' AND hora = '$hora'";
        $fechahora = mysqli_query($this->db, $query);
        $row_cnt = mysqli_num_rows($fechahora);

        if ($row_cnt != 1) {
            return 1;
        } else {
            return 0;
        }
    }
// funcion para crear la fita e insertarla en la base de datos
    public function insertarCitas($usuario, $nombre, $email, $telefono, $fecha, $hora, $checkbox) {
        $consulta = "SELECT * FROM pelados WHERE id = '$checkbox'";
        $base = mysqli_query($this->db, $consulta);
        $user = mysqli_fetch_assoc($base);

        $precio = $user['precio'];
        $corte = $user['nombre'];

        $consulta = "INSERT INTO cita (usuario, nombre, email, telefono, corte, precio, fecha, hora) VALUES ('$usuario','$nombre','$email','$telefono','$corte','$precio','$fecha','$hora')";
        $final = mysqli_query($this->db, $consulta);

        header('Location: /cortes360/users/confirmacionCita.php');
        
    }

}
