<?php 
require '../clases/enviarCorreo.php';
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
$errores=[];
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST["nombre"];
    $correo = $_POST["email"];;
    $asunto = $_POST["asunto"];
    $mensaje = $_POST["mensaje"];

    $correoEnviar = new Correo($nombre, $correo ,$asunto ,  $mensaje);
   

    $mailSent = $correoEnviar->enviarCorreoContacto($nombre, $correo, $asunto, $mensaje);

    if ($mailSent) {
        $_SESSION['alerta'] = "El formulario se ha enviado correctamente";
        header("Location: /cortes360/users/contacto.php");
        exit();
    } else {
        $errores = [];
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
    <link rel="stylesheet" href="/CORTES360/css/contacto.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Comtacto</title>
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
    <h1>Contacto</h1>
        <?php foreach ($errores as $error): ?>
                <div class= "alerta error">
               
             <?php echo $error; ?>
             </div>
            <?php endforeach; ?>
        <div class="formulario">
        <form  action="#" method="post">
          
             
                <div class="form-group">
            <label for="nombre">
            <span>Nombre </span> 
            <input type="text"   name="nombre" id="nombre" required>
        </label><br>
        <div class="form-group">
            <label for="email"><span>Email</span>
            <input type="email"  name="email" id="email" required><br></label>
        </div><br>
        <div class="form-group">
            <label for="asunto"><span>Asunto</span>
            <input type="text"  name="asunto" id="asunto" required><br></label>
        </div><br>
        </div>
        <div class="form-group">
            <label for="mensaje"><span>Mensaje</span>
                <textarea name="mensaje"   id="mensaje" rows="5" required></textarea></label><br>
        </div>

        <button> Enviar</button>

        

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