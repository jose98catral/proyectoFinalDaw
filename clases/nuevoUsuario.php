<?php

class nuevoUsuario {
    private $db;
    private $errores;

    public function __construct($database) {
        $this->db = $database;
        $this->errores = [];
    }
//inserta el registro en la base de datos si cumple con las validaciones y pasa el email, mombre y usuario a minusculas
    public function registrarUsuario($datos) {
        $usuario = strtolower($datos['usuario']);
        $nombre = strtolower($datos['nombre']);
        $email = strtolower($datos['email']);
        $contraseña = $datos['contraseña'];
        $telefono = $datos['telefono'];
        $passwordHash = password_hash($contraseña, PASSWORD_DEFAULT);

        $this->validarContraseña($contraseña);
        $this->validarTelefono($telefono);
        $this->validarUsuario($usuario);
        $this->validarEmail($email);

        if (empty($this->errores)) {
            $query = "INSERT INTO cuenta (usuario, nombre, email, telefono, contraseña) 
                      VALUES ('$usuario', '$nombre', '$email', '$telefono', '$passwordHash')";
            $resultado = mysqli_query($this->db, $query);

            if ($resultado) {
                return true;
            }
        }

        return false;
    }
//comprueba que la contraseña tenga mas de 6 caaracteres, de lo contrario muestra un error
    private function validarContraseña($contraseña) {
        if (strlen($contraseña) < 6) {
            $this->errores[] = 'La contraseña debe tener al menos 6 caracteres';
        }
    }
//comprueba que el telefono tenga nueve numeros, de lo contrario muestra un error
    private function validarTelefono($telefono) {
        if (strlen($telefono) !== 9) {
            $this->errores[] = 'El número de teléfono no es válido';
        }
    }
//comprueba el nombre de usuario solo contenga numero y letras sin espacios y que no este repetido, de lo contrario muestra un error
    private function validarUsuario($usuario) {
        if (!preg_match('/^[a-zA-Z0-9]+$/', $usuario)) {
            $this->errores[] = 'El usuario solo puede contener letras y números sin espacios';
        }

        if ($this->buscaUsuarioRepetido($usuario)) {
            $this->errores[] = 'El usuario está repetido';
        }
    }
//comprueba qu eel email tenga un formato valido y que no este repetido, de lo contrario muestra un error
    private function validarEmail($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errores[] = 'El email no es válido';
        }

        if ($this->buscaEmailRepetido($email)) {
            $this->errores[] = 'El email está repetido';
        }
    }
// busca en la base de datos si hay un usuario igual
    private function buscaUsuarioRepetido($usuario) {
        $sql = "SELECT * FROM cuenta WHERE usuario = '$usuario'";
        $result = mysqli_query($this->db, $sql);
    
        if ($result && mysqli_num_rows($result) > 0) {
            return true;
        }
    
        return false;
    }
    // busca en la base de datos si hay un email igual
    private function buscaEmailRepetido($email) {
        $sql = "SELECT * FROM cuenta WHERE email = '$email'";
        $result = mysqli_query($this->db, $sql);
    
        if ($result && mysqli_num_rows($result) > 0) {
            return true;
        }
    
        return false;
    }

    public function getErrores() {
        return $this->errores;
    }
}
