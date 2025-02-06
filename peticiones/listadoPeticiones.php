<?php

$host = 'localhost';
$usuario = 'root';
$password = '';
$BDusuarios = 'wellcome15';

try {
    $conexion = mysqli_connect($host, $usuario, $password, $BDusuarios);
    $sql = "SELECT id,creadorUsuario,asignadoUsuario,fechaCreacion,salida,estado,cambios FROM peticiones";
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





?>

<html>

<head>
    <link rel="stylesheet" type="text/css" href="wellcome.css">
    
</head>

<body>
    <header>
        <h2>Listado de peticiones</h2>
    </header>
    <table class="myTable2">
        <tr>
            <th>ID</th>
            <th>Creador</th>
            <th>Asignado</th>
            <th>Fecha Creacion</th>
            <th>Salida</th>
            <th>Estado</th>
            <th>Cambios</th>

        </tr>


        <?php for ($i = 0; $i < count($peticiones); $i++):
            $id = $peticiones[$i]['id'];
            $creador = $peticiones[$i]['creadorUsuario'];
            $asignado = $peticiones[$i]['asignadoUsuario'];
            $fechaCreacion = $peticiones[$i]['fechaCreacion'];
            $Salida = $peticiones[$i]['salida'];
            $estado = $peticiones[$i]['estado'];
            $cambios = $peticiones[$i]['cambios'];


        ?>
            <tr id="<?php echo $id; ?>" onclick="editarPeticion(this.id)">
                <td>
                    <?php echo "$id"; ?>
                </td>
                <td>
                    <?php echo "$creador"; ?>
                </td>
                <td>
                    <?php echo "$asignado"; ?>
                </td>
                <td>
                    <?php echo "$fechaCreacion"; ?>
                </td>
                <td>
                    <?php echo "$Salida"; ?>
                </td>
                <td>
                    <?php echo "$estado"; ?>
                </td>
                <td>
                    <?php echo "$cambios"; ?>
                </td>

            </tr>

        <?php endfor;
        ?>

    </table>
    <script>
      //  document.addEventListener("click", editarPeticion);

        function editarPeticion(id) {
        window.location.href=`editarPeticion.php?id=${id}`;
        }
    </script>


</body>

</html>