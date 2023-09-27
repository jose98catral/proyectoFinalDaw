<?php
//Clase para enviar un correo
class Correo {
    private $to ;
    private $subject;
    private $body;
    private $headers;

    public function __construct($to, $subject, $body, $headers) {
        $this->to = "cortes360.franquicias@gmail.com";
        $this->subject = $subject;
        $this->body = $body;
        $this->headers = $headers;
    }

    public function enviar() {
        var_dump($this->to);
        return mail($this->to, $this->subject, $this->body, $this->headers);
    }
// funcion para enviar un correo de contacto
    public function enviarCorreoContacto($nombre, $correo, $asunto, $mensaje) {
        $this->subject = 'Nuevo formulario de Contacto';
        $this->body = "Nombre: $nombre\n";
        $this->body .= "Correo: $correo\n";
        $this->body .= "Asunto: $asunto\n";
        $this->body .= "Mensaje: $mensaje\n";

        $this->headers = "From: $correo\r\n";
        $this->headers .= "Reply-To: $correo\r\n";

        return $this->enviar();
    }
// funcion para enviar un correo de franquicia
    public function enviarCorreoFranquicia($nombre, $correo, $ciudad, $telefono, $conocer, $mensaje) {
        $this->subject = 'Nuevo formulario de franquicias';
        $this->body = "Nombre: $nombre\n";
        $this->body .= "Correo: $correo\n";
        $this->body .= "Ciudad: $ciudad\n";
        $this->body .= "Teléfono: $telefono\n";
        $this->body .= "¿Cómo nos has conocido?: $conocer\n";
        $this->body .= "Mensaje: $mensaje\n";

        $this->headers = "From: $correo\r\n";
        $this->headers .= "Reply-To: $correo\r\n";

        return $this->enviar();
    }
}


?>