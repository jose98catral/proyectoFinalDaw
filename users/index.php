<?php 
require '../php/database.php';
 require '../php/funciones.php';
require '../clases/gestorFotos.php';
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
//crea un nuevo objeto
$gestorFotos = new GestorFotos($db);
//llamada a la funcion y se almacena el resultado en una variable
$result = $gestorFotos->mostrarFotos();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/CORTES360/css/normalize.css">
    <link rel="stylesheet" href="/CORTES360/css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Cortes360</title>
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
        

       <h1>Nuestros últimos cortes</h1>
       <!-- muestra las fotos -->
       <div class="pelados">
       <?php while ($imagenes = mysqli_fetch_assoc($result)): ?>
            
            <img class="fotos" src="/cortes360/imagenes/<?php echo $imagenes['nombre']; ?>" alt="Cortes">
            <?php endwhile; ?>
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