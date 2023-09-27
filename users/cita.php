<?php

require '../php/database.php';
require '../php/funciones.php';
require '../clases/gestorCitas.php';
// comprueba que no haya inacividad durante 20 minutos o cierra la sesion
checkSessionTimeout(1200, '/CORTES360/index.php');
//comprieba que haya usa sesion iniciada o la inicia
if(!isset($_SESSION)){
    session_start();
}
//comprueba que el usuario esté autentificado
$auth = aunteticado();
if(!$auth){
    header( 'Location: /CORTES360/index.php');
}
$rol = $_SESSION['rol'];
// comprueba que el usuario tenga el rol correcto
if($rol != "user"){
  header( 'Location: /CORTES360/index.php');
}
$db = conectarDB();

//crea un nuevo objeto
$gestorCitas = new GestorCitas($db);
//llamada a la funcion y se almacena el resultado en una variable
$resultado = $gestorCitas->importarDatos();
//llamada a la funcion y se almacena el resultado en una variable
$listaHoras = $gestorCitas->buscarHoras();
$errores = [];
//recoge los datos del formulario y de la sesion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_SESSION['usuario'];
    $email = $_SESSION['email'];
    $telefono = $_SESSION['telefono'];
    $nombre = $_SESSION['nombre'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $checkboxes = isset($_POST['checkbox']) ? $_POST['checkbox'] : [0,0];
    
// si hay un checkbox seleccionado comprueba que la fecha y hora no se repita
    if (count($checkboxes) === 1) {
        $checkbox = $checkboxes[0];
        if ($gestorCitas->comprobarFechaHora($fecha, $hora) == 1) {
            // si la fecha y hora no se repit einserta los datos en la base de datos mediante la funcion insertar datos
            $gestorCitas->insertarCitas($usuario, $nombre, $email, $telefono, $fecha, $hora, $checkbox);
        } else {
            $errores[] = 'La fecha y hora ya están ocupadas, seleccione otra';
        }
    }  elseif ($checkboxes==[0,0]){
        $errores[] = 'Seleccione el corte que desee';
    }
     elseif (count($checkboxes) > 1) {
        $errores[] = 'Solo se puede seleccionar un corte';
   
}
}




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/CORTES360/css/normalize.css">
    <link rel="stylesheet" href="/CORTES360/css/index.css">
    <link rel="stylesheet" href="/CORTES360/css/cita.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
    <title>Cita</title>
</head>
<body>
    <header class="header">
        <div class="contenedor contenido-header">
            
            <div class="barra">
                
                <a href="index.php">
                    <img class="logo" src="/CORTES360/fotos/logo3.png" alt="Logotipo">
                </a>
               
                <nav class="navegacion">
                    <a href="reseña.php">Reseñas</a>
                    <a href="nosotros.php">Nosotros</a>
                    
                    <a href="franquicias.php">Franquicias</a>
                    <a href="cita.php">Reserva cita</a>
                </nav>

            </div>

        </div>
    </header>
    <main class="contenedor">
    
        
        <form action="cita.php" method="POST">

<fieldset>  
<h1>Lista de Cortes de Peluquería</h1>
<?php foreach ($errores as $error): ?>
                <div class= "alerta error">
               
             <?php echo $error; ?>
             </div>
            <?php endforeach; ?>
     
        <table class="cortes"> 
            <thead>
                
            </thead>
            <tbody> 
                <!-- muestra los datos de la base de datos de los cortes y precio -->
            <?php while($propiedad = mysqli_fetch_assoc($resultado)):  ?>
                <tr class="columna">
                    
                    <td><input type="checkbox" name="checkbox[]" value="<?php echo $propiedad['id']?>"></td>
                    <td><?php echo $propiedad['id']?></td>
                    <td ><?php echo $propiedad['nombre']?></td>
                    <td ><?php echo $propiedad['precio']?> €</td>
                    
                </tr>
                <?php  endwhile; ?>
            </tbody>
        </table>
    
</fieldset>


<fieldset>  
<h1>Elige la hora y el dia</h1>
<label for="fecha">Elige fecha:</label>
<input type="date" min="" name="fecha" id="fecha" required>
<label for="hora">Elige la Hora:</label>
<select name="hora" id="hora" required>
<option value="" disabled selected>--seleccione--</option>
<?php  foreach($listaHoras as $opciones):?>
   
 <option value= <?php echo $opciones['hora'];  ?>>
 <?php echo $opciones['hora']; ?>
 <?php  endforeach;?>
 </option>
</select>
</fieldset>

<button class="enviar">Enviar</button>
</form>
    </main>
    <footer class="footer">
        <div class="barra2">
                

            <nav class="navegacion1">
            <a href="contacto.php">contacto</a>
                <?php if ($auth): ?>
                    <a href="/CORTES360/php/cerrarSesion.php">cerrar sesion</a>
                <?php endif; ?>
                <a >
                <?php 
                echo $_SESSION['usuario'];
                ?>
                </a>
            </nav>
            <nav class="navegacion2">

                
                <a href=""> <i class="fab fa-twitter"></i> </a>
                <a href=""><i class="fab fa-instagram"></i></a>
                <a href=""><i class="fab fa-facebook"></i></a>
            </nav>
    </footer>
    <script src="/CORTES360/js/fecha.js"></script>
    <script src="/CORTES360/js/dia.js"></script>
    <script src="/CORTES360/js/opcionCorte.js"></script>
    
</body>
</html>