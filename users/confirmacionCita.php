<?php
require '../php/database.php';
require '../php/funciones.php';
checkSessionTimeout(1200, '/CORTES360/index.php');
if(!isset($_SESSION)){
    session_start();
}
$auth = aunteticado();
if(!$auth){
    header( 'Location: /CORTES360/index.php');
}
$rol = $_SESSION['rol'];

if($rol != "user"){
  header( 'Location: /CORTES360/index.php');
}

$db = conectarDB();
 $user = verCita($db);

// cambia el formato de la fecha a dias/mes/año
$fecha_mostrar = date('d-m-Y', strtotime($user['fecha']));

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/CORTES360/css/normalize.css">
    <link rel="stylesheet" href="/CORTES360/css/confirmacionCita.css">
    <title>confirmacionCita</title>
</head>
<body>
                <!-- muestra los datos de la cita -->
<div class="container">
    <h1>¡Cita realizada correctamente!</h1>
    <p>Gracias por elegir nuestro servicio. <?php echo $user['nombre']?> tu cita ha sido agendada con éxito.</p>
    <p>Detalles de la cita:</p>
    <ul>
      <li>Fecha: <strong><?php echo $fecha_mostrar?></strong></li>
      <li>Hora: <strong><?php echo $user['hora']?></strong></li>
      <li>Corte seleccionado: <strong><?php echo $user['corte']?></strong></li>
      <li>Precio: <strong><?php echo $user['precio']?> €</strong></li>
      
    </ul>
    <p>Si tiene algun problema con la cita por favor escríbanos en el apartado contacto.</p>
    <a class="button" href="/cortes360/users/index.php">volver</a>
  </div>
</body>
</html>