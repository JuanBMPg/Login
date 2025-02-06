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


// Verificar si se ha enviado el ID
if (isset($_POST['id'])) {
    //$id = intval($_POST['id']); 
 
    // Preparar la consulta para eliminar el registro
    $sql = "DELETE FROM peticiones WHERE id = $id";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $id);

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

// Redirigir de vuelta a la página anterior (opcional)
//header("Location: listadoPeticiones.php"); // Cambia 'listado.php' por el nombre de tu archivo
//exit();
