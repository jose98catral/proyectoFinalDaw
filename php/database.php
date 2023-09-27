<?php

//conexion con la base de datos


function conectarDB() : mysqli {
$db = new mysqli("localhost","root", "123456","cortes360");
if(!$db){
    echo("No se pudo realixar la conexión");
    exit;
}
return $db;
} 


?>