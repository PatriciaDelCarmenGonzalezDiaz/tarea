<?php
    session_start();
    //limpiar el valor de las variables de sesion
    session_destroy();
    //Regresar a index
    header('Location: index.php');
?>