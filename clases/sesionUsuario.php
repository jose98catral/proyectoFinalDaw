<?php

class sesionUsuario {
    private $db;
    private $errores;

    public function __construct($database) {
        $this->db = $database;
        $this->errores = [];
    }

    //inicia sesion si el usuario y la contraseña son correctos

    public function iniciarSesion($datos) {
        $usuario = strtolower($datos['usuario']);
        $contraseña = $datos['contraseña'];

        if (!$usuario) {
            $this->errores[] = "El usuario es obligatorio";
        }

        if (!$contraseña) {
            $this->errores[] = "La contraseña es obligatoria";
        }

        if (empty($this->errores)) {
            if ($this->buscaUsuario($usuario)) {
                if ($this->comprobarContraseña($usuario, $contraseña)) {
                    
                    return true;
                } else {
                    $this->errores[] = "La contraseña es incorrecta";
                }
            } else {
                $this->errores[] = "El usuario es incorrecto";
            }
        }

        return false;
    }
//comprueba que el usuario existe
    private function buscaUsuario($usuario) {
        $sql = "SELECT * FROM cuenta WHERE usuario = '$usuario'";
        $result = mysqli_query($this->db, $sql);
    
        if ($result && mysqli_num_rows($result) > 0) {
            return true;
        }
    
        return false;
    }
// compruba que el usuario exista y si existe comprueba que su copntraseña es correcta, por ultimo mira el rol del usuario y lo redirecciona segun su rol
    private function comprobarContraseña($usuario, $contraseña) {
        $sql = "SELECT * FROM cuenta WHERE usuario = '$usuario'";
        $result = mysqli_query($this->db, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            $auth = password_verify($contraseña, $user['contraseña']);
           
            
            if ($auth) {
                session_start();
                $_SESSION['usuario'] = $user['usuario'];
                $_SESSION['nombre'] = $user['nombre'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['telefono'] = $user['telefono'];
                $_SESSION['login'] = true;
                
                $rol = $user['rol'];
                 $_SESSION['rol'] = $rol;
                switch ($rol) {
                    case "user":
                        header('Location: /cortes360/users/index.php');
                        exit;
                    case "admin":
                        header('Location: /cortes360/admin/index.php');
                        exit;
                }
            }
        }
        
        return false;
    }

    public function getErrores() {
        return $this->errores;
    }
}
?>