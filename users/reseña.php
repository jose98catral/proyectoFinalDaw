<?php 
require '../php/database.php';
require '../clases/reseñas.php';
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
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST["nombre"];
    $resena = $_POST["resena"];
    $calificacion = $_POST["calificacion"];
    $usuario = $_SESSION['usuario'];
// crear objeto
    $reseñas = new Reseñas($db);
    //llamada a la funcion y se almacena el resultado en una variable
    $resultado = $reseñas->insertarReseñas($nombre, $resena, $calificacion, $usuario);


// si la  variable es true muestra una alerta y te redirecciona a la misma pagina

    if($resultado){
        $_SESSION['alerta'] = "Tu reseña ha sido enviada";
        header("Location: /cortes360/users/reseña.php");
        exit();
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
    <link rel="stylesheet" href="/CORTES360/css/reseña.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Reseña</title>
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
    <div class="header-image">
    <img src="/cortes360/fotos/peluquero2.jpg" alt="Imagen de encabezado">
</div>
    <main class="contenedor"> 
        <h1 class="message">¡Nos encantaría conocer tu opinión!</h1>
         <p class="message"> Por favor, comparte tu experiencia y déjanos tu reseña. Tu feedback es muy valioso para nosotros.</p>

       
    <form method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" required>

            <label for="resena">Reseña:</label>
            <textarea name="resena" required></textarea>
            
            <div class="rating">
        <input type="radio" id="star5" name="calificacion" value="5" required/>
        <label for="star5"><i class="fas fa-star"></i></label>
        <input type="radio" id="star4" name="calificacion" value="4" required/>
        <label for="star4"><i class="fas fa-star"></i></label>
        <input type="radio" id="star3" name="calificacion" value="3" required/>
        <label for="star3"><i class="fas fa-star"></i></label>
        <input type="radio" id="star2" name="calificacion" value="2" required/>
        <label for="star2"><i class="fas fa-star"></i></label>
        <input type="radio" id="star1" name="calificacion" value="1" required/>
        <label for="star1"><i class="fas fa-star"></i></label>
    </div>
   

            <input type="submit" value="Agregar reseña">
        

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
    <script>
        window.onload = function() {
            <?php if (isset($_SESSION['alerta'])): ?>
                var alerta = "<?php echo $_SESSION['alerta']; ?>";
                alert(alerta);
                <?php unset($_SESSION['alerta']); ?>
            <?php endif; ?>
        }
    </script>
</body>
</html>