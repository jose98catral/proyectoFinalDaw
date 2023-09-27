<?php
require '../clases/reseñas.php';
require '../php/database.php';
$db = conectarDB();

$reseñas = new Reseñas($db);
$totalReseñas = $reseñas->contarReseñas();
$resenasPorPagina = 4;
$totalPaginas = ceil($totalReseñas / $resenasPorPagina);

// Obtener el número de página actual
$paginaActual = isset($_GET['pagina']) ? intval($_GET['pagina']) : 1;
$inicio = ($paginaActual - 1) * $resenasPorPagina;

$result = $reseñas->obtenerUltimasReseñas($inicio, $resenasPorPagina);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/CORTES360/css/normalize.css">
    <link rel="stylesheet" href="/CORTES360/css/index.css">
    <link rel="stylesheet" href="/CORTES360/css/reseñaPublico.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Reseñas</title>
</head>
<body>
    <header class="header">
        <div class="contenedor contenido-header">
            
            <div class="barra">
                
                <a href="/CORTES360/index.php">
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
        
    

    <div class="container">
        <h1>Reseñas</h1>

        <?php
        function printStars($numStars) {
            $html = '';
            for ($i = 1; $i <= 5; $i++) {
                if ($i <= $numStars) {
                    $html .= '<span class="fa fa-star"></span>';
                } else {
                    $html .= '<span class="fa fa-star-o"></span>';
                }
            }
            return $html;
        }

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $nombre = $row["nombre"];
                $resena = $row["reseña"];
                $calificacion = $row["calificacion"];

                echo '<div class="box">';
                echo '<h3>' . $nombre . '</h3>';
                echo '<p>Reseña: ' . $resena . '</p>';
                echo '<p>Calificación: <span class="rating">' . printStars($calificacion) . '</span></p>';
                echo '</div>';
            }
        } else {
            echo "No se encontraron reseñas.";
        }

       // Paginador
       echo '<div class="paginador">';
       if ($paginaActual > 1) {
           echo '<a href="?pagina=' . ($paginaActual - 1) . '">Anterior</a>';
       }
       for ($i = 1; $i <= $totalPaginas; $i++) {
           echo '<a href="?pagina=' . $i . '"';
           if ($i === $paginaActual) {
               echo ' class="active"';
           }
           echo '>' . $i . '</a>';
       }
       if ($paginaActual < $totalPaginas) {
           echo '<a href="?pagina=' . ($paginaActual + 1) . '">Siguiente</a>';
       }
       echo '</div>';
      
        ?>

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
    
</body>
</html>