<?php

require '../php/database.php';
require '../clases/gestorCitas.php';
// importar conexion base de datos
$db = conectarDB();

//creacion de objeto

$gestorCitas = new GestorCitas($db);
//llamada a la funcion importar datos
$resultado = $gestorCitas->importarDatos();
//llamada a la funcion buscar horas
$listaHoras = $gestorCitas->buscarHoras();
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
    
        
        <form action="cita.php" method="POST"
>

<fieldset>  
<h1>Lista de Cortes de Peluquería</h1>
     
        <table class="cortes"> 
            <thead>
                
            </thead>
            <tbody> 
                <!-- Mostrar los pelados y el precio en una tabla -->
            <?php while($propiedad = mysqli_fetch_assoc($resultado)):  ?>
                <tr class="columna">
                    
                    <td><input type="checkbox" name="opcion"></td>
                    <td><?php echo $propiedad['id']?></td>
                    <td><?php echo $propiedad['nombre']?></td>
                    <td><?php echo $propiedad['precio']?> €</td>
                    
                </tr>
                <?php  endwhile; ?>
            </tbody>
        </table>
    
</fieldset>


<fieldset>  
<h1>Elige la hora y el dia</h1>
<!-- elegir fecha -->
<label for="fecha">Elige fecha:</label>
<input type="date" min="" name="fecha" id="fecha" required>
<!--elegir hora  -->
<label for="hora">Elige la Hora:</label>
<select name="hora" id="hora" required>
<option value="" disabled selected>--seleccione--</option>
<!-- se muestran las horas de la tabla hora -->
<?php  foreach($listaHoras as $opciones):?>
   
 <option value= <?php echo $opciones['hora'];  ?>>
 <?php echo $opciones['hora']; ?>
 <?php  endforeach;?>
 </option>
</select>
</fieldset>



<button id="boton1"class="enviar">Enviar</button>

</form>
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
    
    <script src="/CORTES360/js/fecha.js"></script>
    <script src="/CORTES360/js/dia.js"></script>
    <script src="/CORTES360/js/citaSesion.js"></script>
</body>
</html>