<?php
require '../php/database.php';
require '../clases/gestorFotos.php';
require '../php/funciones.php';
// comprueba que hay ina sesion iniciada
if(!isset($_SESSION)){
  session_start();
}
//compueba que se este autentificado
$auth = aunteticado();
if(!$auth){
  header( 'Location: /cortes360/index.php');
}
$rol = $_SESSION['rol'];

// comprueba que el rol sea el correcto
if($rol != "admin"){
  header( 'Location: /cortes360/index.php');
}
$usuario = $_SESSION['usuario'];

$db = conectarDB();
//se crea un objeto
$gestorFotos = new GestorFotos($db);
//inserta las fotos en la base de datos
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $resultado = $gestorFotos->insertarFotos();
    if ($resultado) {
        $_SESSION['alerta'] = "La imagen se ha enviado correctamente";
        header('Location: /cortes360/php/confirmacionFoto.php');
        exit;
    }
}
//muestra las fotos
$result = $gestorFotos->mostrarFotos();
//borra las fotos
$gestorFotos->borrarFotos();
//cierre de conexion con la bd
mysqli_close($db);
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/CORTES360/css/normalize.css">
    <link rel="stylesheet" href="/CORTES360/css/fotos.css">
    <link rel="stylesheet" href="/CORTES360/css/index.css">
    <title>fotos</title>
</head>
<body>
    <header class="headerAdmin">
        <div class="contenedor contenido-header">
            <div class="barra">
            <h1><?php echo $usuario ?></h1>

                <nav class="navegacion">
                    <a href="index.php">Calendario</a>
                    <a href="fotos.php">Subir foto</a>
                    <!--  cierre de sesion -->
                    <?php if ($auth): ?>
                    <a href="/CORTES360/php/cerrarSesion.php">cerrar sesion</a>
                <?php endif; ?>
              
                </nav>
            </div>
        </div>
    </header>
<!--  formulario para la subida de una foto -->
    <div class="formulario">
        <form action="fotos.php" method="post" enctype="multipart/form-data">
            <input type="file" name="imagen" required>
            <input type="submit" name="submit" value="Subir imagen">
        </form>
    </div>
<!--  tabla para mostrar y borrar las fotos -->
    <div class="tabla">
        <table>
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($imagenes = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><img class="fotos" src="/cortes360/imagenes/<?php echo $imagenes['nombre']; ?>" alt="Imagen"></td>
                        <td class="acciones">
                            <form method="post" action="fotos.php">
                                <input type="hidden" name="id" value="<?php echo $imagenes['id']; ?>">
                                <input type="submit" name="borrar" value="Borrar">
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</table>
<!--  alerta de que se ha realizado correctamente -->
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

