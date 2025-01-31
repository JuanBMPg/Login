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
    <form action="enviaremail.php" method="post" enctype="multipart/form-data">
        <div class="container">
            <h3>Mensaje nuevo</h3>
            <label for="remitente">Remitente:</label>
            <input type="text" id="remitente" name="remitente" required><br><br>

            <label for="asunto">Asunto:</label>
            <input type="text" id="asunto" name="asunto" required><br><br>

            <label for="texto">Texto:</label>
            <input type="text" id="texto" name="texto" required><br><br>


            <button type="submit">Enviar</button>
        </div>
</body>

</html>