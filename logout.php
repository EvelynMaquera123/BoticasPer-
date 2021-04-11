
<?php 
//crea una sesión o reanuda la actual basada en un identificador de sesión
// pasado mediante una petición GET o POST
session_start();
//libera todas las variables de sesión actualmente registradas
session_unset();
//destruye toda la información registrada de una sesión
session_destroy();
//me redirecciona al index.php
header("Location: index.php");