 <?php
require '../php/database.php';
require '../clases/nuevoUsuario.php';


$db = conectarDB();
//crea un nuevo objeto
$registroUsuario = new nuevoUsuario($db);

$errores = [];
//Recoge los datos del formulario de registro,  llama a la funcion que almaceta su relustado en una variable
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $resultado = $registroUsuario->registrarUsuario($_POST);

    if ($resultado) {
        header('Location: /cortes360/html/cuenta.php');
        exit;
    }

    $errores = $registroUsuario->getErrores();
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
    <link rel="stylesheet" href="/CORTES360/css/registro.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Registro</title>
</head>
<body>
    <header class="header">
        <div class="contenido contenido-header">
            
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
        <h2>Registro</h2>
       
            <?php foreach ($errores as $error): ?>
                <div class= "alerta error">
               
             <?php echo $error; ?>
             </div>
            <?php endforeach; ?>
   
   

        <div class="formulario">
        <form  action="registro.php" method="POST">
          
             
                <div class="form-group">
            <label for="usuario">
            <span>Nombre usuario</span> 
            <input type="text"   name="usuario" id="usuario" required>
        </label><br>
        <div class="form-group">
            <label for="nombre"><span>Nombre</span>
            <input type="text"  name="nombre" id="nombre" required><br></label>
        </div><br>
        <div class="form-group">
            <label for="email"><span>Email</span>
            <input type="email"  name="email" id="email" required><br></label>
        </div><br>
        <div class="form-group">
            <label for="telefono"><span>Teléfono</span>
            <input type="tel"  name="telefono" id="telefono" required><br></label>
        </div><br>
        </div>
        <div class="form-group">
            <label for="contraseña"><span>Contraseña</span>
            <input type="password"  name="contraseña" id="contraseña" required><br></label>
        </div>
<button>Enviar</button>
        

       
        
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
 <script src="/CORTES360/js/placeholder.js"></script>
</body>
</html>