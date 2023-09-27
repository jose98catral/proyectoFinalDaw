<?php 
require '../clases/enviarCorreo.php';
require '../php/funciones.php';
$errores=[];
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

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $ciudad = $_POST["ciudad"];
    $telefono = $_POST["telefono"];
    $conocer = $_POST["conocer"];
    $mensaje = $_POST["mensaje"];

    $correoEnviar = new Correo($nombre, $correo, $ciudad, $telefono, $conocer, $mensaje);
   

    $mailSent = $correoEnviar->enviarCorreoFranquicia($nombre, $correo, $ciudad, $telefono, $conocer, $mensaje);

    if ($mailSent) {
        $_SESSION['alerta'] = "El formulario se ha enviado correctamente";
        header("Location: /cortes360/users/franquicias.php");
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
    <link rel="stylesheet" href="/CORTES360/css/franquicias.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Franquicias</title>
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
    <?php foreach ($errores as $error): ?>
                <div class= "alerta error">
               
             <?php echo $error; ?>
             </div>
            <?php endforeach; ?>
        <h2>Franquicias</h2>
		<p>Cortes 360 es una peluquería que ofrece servicios de calidad a precios accesibles. Nos enorgullecemos de ofrecer una experiencia excepcional a cada uno de nuestros clientes, y ahora estamos expandiendo nuestra presencia a través de franquicias en todo el país.</p>

		<section>
			<h3>¿Por qué unirse a nuestra red de franquicias?</h3>
			<ul>
				<li>Una marca reconocida y establecida en la industria de la peluquería</li>
				<li>Soporte y capacitación continuos para el propietario y el personal de la franquicia</li>
				<li>Un modelo de negocio probado y rentable</li>
				<li>Acceso a tecnología y herramientas de marketing avanzadas</li>
				<li>Un equipo de apoyo dedicado para ayudar a los propietarios de la franquicia a alcanzar el éxito</li>
			</ul>
            <div class="contenido-fotos">
            <img class="foto" src="/CORTES360/fotos/peluquero4.jpg" alt="">
            <img class="foto" src="/CORTES360/fotos/peluquero3.jpg" alt="">
        </div>
		</section>

		<section>
			<h3>Requisitos para ser propietario de una franquicia</h3>
			<p>Para unirse a nuestra red de franquicias, necesitará cumplir con los siguientes requisitos:</p>
			<ul>
				<li>Capacidad financiera para invertir en la franquicia</li>
				<li>Compromiso de tiempo y recursos para administrar la franquicia</li>
				<li>Pasión por la industria de la peluquería y la satisfacción del cliente</li>
			</ul>
			<p>Si cumple con estos requisitos y está interesado en ser propietario de una franquicia de Cortes 360, complete el formulario a continuación para obtener más información:</p>

			<form class="formulario" action="franquicias.php" method="post">
                <fieldset>
                    <div class="form-grid">
                    <div class="form-group">
				<label for="nombre">
                <span>Nombre</span> 
				<input type="text"   name="nombre" id="nombre" required>
            </label><br>
            </div>
            <div class="form-group">
                <label for="correo"><span>Email</span>
				<input type="email"  name="correo" id="correo" required><br></label>
            </div>

            <div class="form-group">
                <label for="ciudad"> <span>ciudad</span>
				<input type="text"  name="ciudad" id="ciudad" required><br></label>
            </div>
            <div class="form-group">
				<label for="telefono"><span>Teléfono</span>
				<input type="tel"  name="telefono" id="telefono" required></label><br>
            </div>
        </div>
            <div class="form-conocidio">
                <label for="conocer">¿Como nos has conocido?</label>
                <select name="conocer" id="conocer" required>
                    <option value="" disabled selected>--seleccione--</option>
                    <option value="Amigos">Amigos</option>
                    <option value="redes">Redes sociales</option>
                    <option value="Barbería">Barbería</option>
                    <option value="Otros">Otros</option>
                </select>
            </div><br>

				<div class="form-mensaje">
                <label for="mensaje"><span>Mensaje</span>
                <textarea name="mensaje"   id="mensaje" rows="5" required></textarea></label><br>
            
        </div>
				<input class="enviar" type="submit" value="Enviar">
            </fieldset>
            <script src="/CORTES360/js/placeholder.js"></script>
			</form>
		</section>

        

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

                
                <a href=""><i class="fab fa-twitter"></i> </a>
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