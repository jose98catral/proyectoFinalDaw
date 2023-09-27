
<?php 
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

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/CORTES360/css/normalize.css">
    <link rel="stylesheet" href="/CORTES360/css/index.css">
    <link rel="stylesheet" href="/CORTES360/css/nostros.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Nosotros</title>
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
        <div class="contenido-nosotros">
            
            <div class="texto-nosotros">
			<h2>Nosotros</h2>
			<p>En Cortes 360, nos dedicamos a ofrecer una experiencia de peluquería excepcional a nuestros clientes. Nuestros profesionales de la peluquería tienen años de experiencia en la industria y se mantienen actualizados con las últimas tendencias y técnicas. Creemos que una buena apariencia es esencial para la confianza y autoestima de una persona, por lo que nos esforzamos por brindar un servicio personalizado y de alta calidad a cada uno de nuestros clientes.</p>
           
</div>
      
			
			<div class="textos">
<div class="texto-historia">
            <h3>Nuestra Historia</h3>
			<p>Cortes 360 es una peluquería fundada en 2005 por Juan Pérez. Nuestro objetivo es brindar servicios de calidad a precios accesibles. Hemos crecido y contamos con múltiples sucursales en todo el país. Estamos en proceso de expansión mediante franquicias para llegar a más clientes en el mundo. Nuestra pasión es ayudar a las personas a lucir y sentirse bien consigo mismas. ¡Te esperamos en nuestras sedes para transformar tu estilo!¡Ven ahora!</p>
      <img class="foto" src="/CORTES360/fotos/peluquero1.jpg" alt="Peluquero1">
        </div>
        <div class="texto-mision">
			<h3>Nuestra Misión</h3>
			<p>Nuestra misión en Cortes 360 es brindar servicios de peluquería excepcionales a precios accesibles, y ayudar a nuestros clientes a sentirse seguros y confiados con su apariencia. Nos enfocamos en ofrecer un servicio personalizado y de alta calidad, y nos apasiona ayudar a las personas a verse y sentirse mejor. ¡Trabajamos arduamente para marcar una diferencia positiva en la vida de nuestros clientes a través de nuestros servicios de peluquería!</p>
            <img class="foto" src="/CORTES360/fotos/peluquero2.jpg" alt="Peluquero2">
        </div>
    </div>
</div>
   

	


        

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
    
</body>
</html>