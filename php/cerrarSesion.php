

<?php
//cierra la sesion eliminando los datos de esta
if(!isset($_SESSION)){
    session_start();
}
$_SESSION = [];

header( 'Location: /CORTES360/index.php');
exit;
?>