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



if (isset($_POST['id'])) {
    $id = intval($_POST['id']); 
 
   
    $sql = "DELETE FROM peticiones WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $id = $stmt->insert_id;
        echo "Registro eliminado con éxito.";
    } else {
        echo "Error al eliminar el registro: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ID no proporcionado.";
}

$conexion->close();


header("Location: listadoPeticiones.php"); 
exit();
