
<?php
require 'php/database.php';
require 'php/funciones.php';
require 'clases/gestorFotos.php';

$db = conectarDB();
$gestorFotos = new GestorFotos($db);
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
                    <a href="/CORTES360/html/reseña.php">Reseñas</a>
                    <a href="/CORTES360/html/nosotros.php">Nosotros</a>
                    
                    <a href="/CORTES360/html/franquicias.php">Franquicias</a>
                    <a href="/CORTES360/html/cita.php">Reserva cita</a>
                </nav>

            </div>

        </div>
    </header>
    <main class="contenedor">
  

       <h1>Nuestros últimos cortes</h1>
<div class="pelados">
    <!-- muestra las fotos -->
<?php while ($imagenes = mysqli_fetch_assoc($result)): ?>
            
                <img class="fotos" src="/cortes360/imagenes/<?php echo $imagenes['nombre']; ?>" alt="Cortes">
                <?php endwhile; ?>

</div>
    </main>
    <footer class="footer">
        <div class="barra2">
                

            <nav class="navegacion1">
                <a href="/CORTES360/html/contacto.php">contacto</a>
                <a href="/CORTES360/html/cuenta.php">mi cuenta</a>
            </nav>
            <nav class="navegacion2">php

                
                <a href=""> <i class="fab fa-twitter"></i> </a>
                <a href=""><i class="fab fa-instagram"></i></a>
                <a href=""><i class="fab fa-facebook"></i></a>
            </nav>
    </footer>
    
</body>
</html>