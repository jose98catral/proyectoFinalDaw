<?php
//verifica que el usuario este autentificado

function aunteticado() : bool{
    $auth = $_SESSION['login'] ;
    if($auth){
    return true;
}
    else return false;
}
function checkSessionTimeout($expireTime = 1200, $redirectUrl = '/cortes360/index.php') {
    session_start();

    // Verifica si el tiempo de inactividad ha superado el tiempo de expiración
    if (isset($_SESSION['last_activity']) && time() - $_SESSION['last_activity'] > $expireTime) {
        // Cierra la sesión y redirige al usuario a la página de inicio
        session_unset();
        session_destroy();
        header('Location: ' . $redirectUrl);
        exit();
    }

    // Actualiza el tiempo de actividad de la sesión
    $_SESSION['last_activity'] = time();
}

// muestra la cita
function verCita($db){
    $query = "SELECT * FROM cita ORDER BY id DESC LIMIT 1";
$result = mysqli_query($db,$query);
$user = mysqli_fetch_assoc($result);
return $user;
}

