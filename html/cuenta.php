

<?php


require '../php/database.php';
require '../clases/sesionUsuario.php';


error_reporting(0);

$db = conectarDB();
$errores = [];
//Recoge los datos del formulario de inicio, crea un objeto y llama a la funcion que almaceta su relustado en una variable
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inicioSesion = new sesionUsuario($db);
    $exito = $inicioSesion->iniciarSesion($_POST);

    if ($exito) {
        
    } else {
        $errores = $inicioSesion->getErrores();
    }
}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/cortes360/css/normalize.css">
    <link rel="stylesheet" href="/cortes360/css/index.css">
    <link rel="stylesheet" href="/cortes360/css/cuenta.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>cuenta</title>
</head>
<body>
    <header class="header">
        <div class="contenido contenido-header">
            
            <div class="barra">
                
                <a href="/CORTES360/index.php">
                    <img class="logo" src="/cortes360/fotos/logo3.png" alt="Logotipo">
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
        <h1>Inicie sesión</h1>
        <?php foreach ($errores as $error): ?>
                <div class= "alerta error">
               
             <?php echo $error; ?>
             </div>
            <?php endforeach; ?>
        <div class="formulario">
        <form  action="#" method="post">
          
             
                <div class="form-group">
            <label for="usuario">
            <span>Uusario</span> 
            <input type="text"   name="usuario" id="usuario" >
        </label><br>
        </div>
        <div class="form-group">
            <label for="contraseña"><span>Contraseña</span>
            <input type="password"  name="contraseña" id="contraseña" required><br></label>
        </div>
        <button> Entrar</button>
        <button><a href="registro.php">Nuevo registro</a></button>

       
       
        </form>
    </div>

        

    </main>
    <footer class="footer">
        <div class="barra2">
                

            <nav class="navegacion1">
                <a href="contacto.php">contacto</a>
                <a href="cuenta.php">mi cuenta</a>
            </nav>
            <nav class="navegacion2">

                
                <a href=""> <i class="fab fa-twitter"></i> </a>
                <a href=""><i class="fab fa-instagram"></i></a>
                <a href=""><i class="fab fa-facebook"></i></a>
            </nav>
    </footer>
    <script src="/cortes360/js/placeholder.js"></script>
</body>
</html>