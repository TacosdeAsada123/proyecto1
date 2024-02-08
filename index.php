<?php
    require_once realpath('./vendor/autoload.php');
    $dotenv = Dotenv\Dotenv::createImmutable('./');
    $dotenv->load();

    $servidor = $_ENV['HOST'];
    $conexion; 
    $puerto = $_ENV['PUERTO'];
    $bd = $_ENV['DB'];
    $usuario = $_ENV['USUARIO'];
    $password = $_ENV['PASSWORD'];

    $conexion = new mysqli($servidor, $usuario, $password, $bd, $puerto);

    if($conexion -> connect_error){
        echo("error");
    }else{
        echo("exito!!");
    }

    
?>