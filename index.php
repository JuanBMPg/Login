<?php
session_start();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Bienvenido</title>
    <link rel="stylesheet" type="text/css" href="estiloslogin.css">
    <link rel="stylesheet" type="text/css" href="estilosgeneral.css">
</head>

<body>
    <div class="container">
        <header>
            <h1 class="welcome-mensaje">Bienvenido, <?php echo $_SESSION['usuario']; ?>!</h1>
        </header>
        <main>
            <p>Has iniciado sesión correctamente.</p>
            <a href="logout.php" class="logout-link">Cerrar sesión</a>
        </main>
    </div>
</body>

</html>