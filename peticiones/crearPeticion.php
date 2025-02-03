<?php
session_start();

$host = 'localhost';
$usuario = 'root';
$password = '';
$BDusuarios = 'MiBasedeDatos';
$usuarios = [];

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
  
    $consulta= "SELECT * FROM peticion";
    mysqli_query($conexion,$consulta);

    echo $consulta;

   


    
}
/*header('Location: listadoPeticiones.php');
exit;*/
?>

<!DOCTYPE html>
<head>
 <link rel="stylesheet" type="text/css" href="wellcome.css">

</head>
<body>
    <header>
    <h2>Crear peticion</h2>
    </header>
    <div class="container">
    <form action="crearPeticion.php" method="post" enctype="multipart/form-data">
        <label for="usuario">UsuarioCreador:</label>
        <input type="text" id="usuario" name="usuario" required><br><br>
        
        <label for="usuarioAsignado">Usuario Asignado:</label>
        <input type="text" id="usuarioAsignado" name="usuarioAsignado" required><br><br>

        <label for="peticion">Peticion:</label>
        <input type="text" id="peticion" name="peticion" required><br><br>

        <label for="email">Email:</label>
        <input type="text" id="email" name="email" required><br><br>

        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha" required><br><br>
        
        <button type="submit">Enviar</button>
    </div>
        
    </form>
   
</body>
</html>