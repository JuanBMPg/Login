<?php
session_start();


$host = 'localhost';
$usuario = 'root';
$password = '';
$BDusuarios = 'MiBasedeDatos';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$edad = $_POST['edad'];
$contraseña = $_POST['contraseña'];
$emailenuso=false;
foreach($usuarios as $user){
    
    if($email==$user['email']){
        $emailenuso=true;

    }
}

if($emailenuso==false){

$sql = "INSERT INTO usuarios (edad, nombre, password,email) VALUES ('$edad','$nombre','$contraseña','$email')";
mysqli_query($conexion, $sql);
echo "registro exitoso";
}else{
    echo "El email ya existe";
}

$conexion->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" type="text/css" href="estilosgeneral.css">
</head>
<body>
    <h1>Registro de Usuario</h1>
    <form action="register.php" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="contraseña">Contraseña:</label>
        <input type="password" id="contraseña" name="contraseña" required><br><br>

        <label for="edad">Edad:</label>
        <input type="number" id="number" name="edad" required><br><br>
        
        <button type="submit">Enviar</button> <br>

        <a href="login.php">Iniciar sesión</a>
    </form>
</body>
</html>