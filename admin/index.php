<?php
require '../php/database.php';
require '../clases/calendarioCitas.php';
require '../php/funciones.php';
// comprueba que hay una sesion iniciada
if(!isset($_SESSION)){
  session_start();
}
//compueba que se este autentificado
$auth = aunteticado();
if(!$auth){
  header( 'Location: /cortes360/index.php');
}
// comprueba que el rol sea el correcto
$rol = $_SESSION['rol'];

if($rol != "admin"){
  header( 'Location: /cortes360/index.php');
}
$usuario = $_SESSION['usuario'];


$db = conectarDB();

//se crea un objeto
$calendario = new calendarioCitas($db);
//borra la cita
if (isset($_POST["borrar"]) && isset($_POST["cita_id"])) {
    $cita_id = $_POST["cita_id"];
    $calendario->borrarCita($cita_id);
    header('Location: /cortes360/admin/index.php');
}

 
  
?>



<!DOCTYPE html>
<html>
<head>
  <title>Calendario</title>
  <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/CORTES360/css/normalize.css">
    <link rel="stylesheet" href="/CORTES360/css/indexAdmin.css">
    <link rel="stylesheet" href="/CORTES360/css/index.css">
</head>
<body>
<header class="headerAdmin">
        <div class="contenedor contenido-header">
            <div class="barra">
               <h1><?php echo $usuario ?></h1>
                <nav class="navegacion">
                  
                    <a href="index.php">Calendario</a>
                    <a href="fotos.php">Subir foto</a>
                    <?php if ($auth): ?>
                    <a href="/CORTES360/php/cerrarSesion.php">cerrar sesion</a>
                <?php endif; ?>
                </nav>
            </div>
        </div>
    </header>
  <h1>Calendario</h1>

  <table>
    <tr>
      
      <th>Lunes</th>
      <th>Martes</th>
      <th>Miércoles</th>
      <th>Jueves</th>
      <th>Viernes</th>
      <th>Sábado</th>
      <th>Domingo</th>
    </tr>
    <!-- genera el calendario -->
    <?php
      
      $calendario->generarCalendario();
    ?>
  </table>

</body>
</html>