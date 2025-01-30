<?php
session_start();

$host = 'localhost';
$usuario = 'root';
$password = '';
$BDusuarios = 'MiBasedeDatos';
$usuarios = [];

//Establecer la conexion con la base de datos
try {
    $conexion = mysqli_connect($host, $usuario, $password, $BDusuarios);
    $sql = "SELECT password,email FROM usuarios";
    $query = mysqli_query($conexion, $sql);
    //Como lo quiere Noemi
    while ($fila = $query->fetch_assoc()) {

        $usuarios[] = $fila;
    }
    //Forma Andres
    //$usuarios=$query->fetch_all(MYSQLI_ASSOC);

} catch (Exception $e) {

    echo $e->getMessage();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['usuario'];
    $password = $_POST['password'];

    for ($i = 0; $i < count($usuarios); $i++) {

        if ($user == $usuarios[$i]['email'] && $password == $usuarios[$i]['password']) {
            $_SESSION['usuario'] = $user;
            header("Location: index.php");
            exit();
        }
    }


    $mensaje = "Credenciales incorrectas.";
    header("Location: login.php?mensaje=$mensaje");
    exit();
}

?>

<html>

<head>
    <link rel="stylesheet" type="text/css" href="estilosgeneral.css">
</head>

</html>