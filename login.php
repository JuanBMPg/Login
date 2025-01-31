<?php
$mensaje="";
if(isset($_GET['mensaje'])){

    $mensaje=$_GET['mensaje'];
}
?>

<!DOCTYPE html>
<head>
 <link rel="stylesheet" type="text/css" href="estiloslogin.css">
 <link rel="stylesheet" type="text/css" href="estilosgeneral.css">
</head>
<body>
    <header>
    <h2>Iniciar Sesión</h2>
    </header>
    <div class="container">
    <form action="service.php" method="post" enctype="multipart/form-data">
        <label for="usuario">Usuario:</label>
        <input type="text" id="usuario" name="usuario" required><br><br>
        
        <label for="password">Contraseña:</label>
        <input type="password" id="contrasena" name="password" required><br><br>
        
        <button type="submit">Enviar</button>
    </div>
        <div class="error-mensaje">
            <?php echo $mensaje ?>
        </div>
    </form>
    <a href="register.php">Crear nueva cuenta</a>
</body>
</html>