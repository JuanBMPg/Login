<?php

$host = 'localhost';
$usuario = 'root';
$password = '';
$BDusuarios = 'wellcome15';


try {
    $conexion = mysqli_connect($host, $usuario, $password, $BDusuarios);
    $sql = "SELECT id,creadorUsuario,asignadoUsuario,fechaCreacion,salida,estado FROM peticiones";
    $query = mysqli_query($conexion, $sql);
    //Como lo quiere Noemi
    while ($fila = $query->fetch_assoc()) {

        $peticiones[] = $fila;
    }
    //Forma Andres
    //$usuarios=$query->fetch_all(MYSQLI_ASSOC);

} catch (Exception $e) {

    echo $e->getMessage();
}



if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $_POST['id'];
    $asignado = $_POST['editarAsignado'];
    $editarFechaCreacion = $_POST['editarFechaCreacion'];
    $cambios = intval(htmlspecialchars($_POST['cambios']));



    try {
        $conexion = mysqli_connect($host, $usuario, $password, $BDusuarios);
        $sql = "UPDATE peticiones
        SET asignadoUsuario='$asignado',
        fechaCreacion='$editarFechaCreacion',
        cambios=cambios+1
        where id=$id";
        $query = mysqli_query($conexion, $sql);
        echo $query;
        //Como lo quiere Noemi

        //Forma Andres
        //$usuarios=$query->fetch_all(MYSQLI_ASSOC);

    } catch (Exception $e) {

        echo $e->getMessage();
    }


    header("Location: listadoPeticiones.php");
    exit();
} else {

    $id = intval(htmlspecialchars($_GET['id']));
    try {
        $conexion = mysqli_connect($host, $usuario, $password, $BDusuarios);
        $sql = "SELECT id,creadorUsuario,asignadoUsuario,fechaCreacion,salida,estado FROM peticiones
        WHERE id = $id";
        $query = mysqli_query($conexion, $sql);
        //Como lo quiere Noemi
        while ($fila = $query->fetch_assoc()) {

            $peticion[] = $fila;
        }
        //Forma Andres
        //$usuarios=$query->fetch_all(MYSQLI_ASSOC);

    } catch (Exception $e) {

        echo $e->getMessage();
    }
}

?>

<html>

<head>
    <link rel="stylesheet" type="text/css" href="wellcome.css">
</head>

<body>

    <header>
        <h2>Editar peticion</h2>
    </header>
    <form action="editarPeticion.php" method="post">

        <input type="hidden" name="id" value="<?php echo $id ?>">

        <label for="editarAsignado">Asignado:</label>
        <input type="number" id="editarAsignado" name="editarAsignado" value="<?php echo $peticion[0]['asignadoUsuario'] ?>"> <br><br>

        <label for="editarid">Fecha creacion:</label>
        <input type="date" id="editarFechaCreacion" name="editarFechaCreacion" value="<?php echo date('Y-m-d', strtotime($peticion[0]['fechaCreacion'])) ?>"> <br><br>
        

        <embed src="pdfs/<?php echo $id?>.pdf" type="application/pdf"  width="800" height="500"> <br><br>



        <button type="submit">Editar</button>
        
    </form>

    <form action="eliminarPeticion.php" method="post">
        <button type="submit">Eliminar peticion</button>
    </form>


</body>



</html>