<?php

class GestorFotos {
    private $carpetaImagenes;
    private $db;

    public function __construct($db) {
        $this->carpetaImagenes = '../imagenes/';
        $this->db = $db;
    }
//insertar las fotos en la base de datos
    public function insertarFotos() {
        if (!is_dir($this->carpetaImagenes)) {
            mkdir($this->carpetaImagenes);
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES['imagen'])) {
            $imagen = $_FILES['imagen'];
        
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpeg";
            move_uploaded_file($imagen['tmp_name'], $this->carpetaImagenes . $nombreImagen);

            $query = "INSERT INTO fotos (nombre) VALUES ('$nombreImagen')";
            $resultado = mysqli_query($this->db, $query);

            return $resultado;
        }
    }
//obtener las fotos de la base de datos
    public function mostrarFotos() {
        $consulta = "SELECT * FROM fotos";
        $result = mysqli_query($this->db, $consulta);
        return $result;
    }

    public function borrarFotos() {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["borrar"]) && isset($_POST["id"])) {
            $id = (int)$_POST['id'];
        
            // Obtener el nombre de la imagen para eliminarla del directorio
            $qpregunta = "SELECT nombre FRom fotos WHERE id = $id";
            $resultadoPregunta = mysqli_query($this->db, $qpregunta);
            $propiedad = mysqli_fetch_assoc($resultadoPregunta);
            $nombreImagenBorrar = $propiedad['nombre'];

            // Eliminar la imagen del directorio
            unlink($this->carpetaImagenes . $nombreImagenBorrar);

            // Eliminar la imagen de la base de datos
            $query = "DELETE FROM fotos WHERE id = $id";
            $resultado = mysqli_query($this->db, $query);

            if ($resultado) {
                header('Location: /cortes360/php/confirmacionFoto.php');
                exit;
            }
        }
    }
}
?>