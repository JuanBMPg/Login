<?php

use PhpOption\Option;

session_start();

$host = 'localhost';
$usuario = 'root';
$password = '';
$BDusuarios = 'wellcome15';
$usuarios = [];


try {
    $conexion = mysqli_connect($host, $usuario, $password, $BDusuarios);
    $sql = "SELECT id,nombre FROM usuarios";
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

    $creador = $_POST['usuarioCreador'];
    $asignado = $_POST['usuarioAsignado'];
    $para = $_POST['para'];
    $de = $_POST['de'];
    $fecha = $_POST['fecha'];

    $stmt = $conexion->prepare("INSERT INTO peticiones (para,de,fechaCreacion,creadorUsuario,asignadoUsuario) VALUES (?, ?,?,?,?)");
    $stmt->bind_param("sssss", $para, $de, $fecha, $creador, $asignado);

    $id = '';

    if ($stmt->execute()) {
        $id = $stmt->insert_id;
        echo "Nuevo registro creado exitosamente";
    } else {
        echo "Error: " . $stmt->error;
    }



    if (isset($_FILES['pdf']) && $_FILES['pdf']['error'] == UPLOAD_ERR_OK) {

        $fileTmpPath = $_FILES['pdf']['tmp_name'];
        $fileName = $_FILES['pdf']['name'];
        $fileSize = $_FILES['pdf']['size'];
        $fileType = $_FILES['pdf']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        echo $fileType;

        if ($fileType == 'application/pdf') {

            $dest_path = 'pdfs/' . $id . '.pdf';


            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                echo "El archivo se ha subido correctamente: " . $dest_path;
            } else {
                echo "Hubo un error al mover el archivo al directorio de destino.";
            }
        } else {
            echo "Por favor, sube un archivo PDF.";
        }
    }
    //header("Location: listadoPeticiones.php");
    //exit();
}


?>

<!DOCTYPE html>

<head>
    <link rel="stylesheet" type="text/css" href="wellcome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />

</head>

<body>
    <header>
        <h2>Crear peticion</h2>
    </header>
    <div class="container">
        <form action="crearPeticion.php" method="post" enctype="multipart/form-data" id="formularioPeticion">

            <label for="usuarioCreador">Creador:</label>
            <select name="usuarioCreador" id="usuarioCreador">
                <?php

                for ($i = 0; $i < count($usuarios); $i++) {

                    $idusuarios = $usuarios[$i]['id'];
                    $nombre = $usuarios[$i]['nombre'];
                    echo "<option value='$idusuarios'>$nombre</option>";
                }

                ?>
            </select>


            <label for="usuarioAsignado">Asignado:</label>
            <select name="usuarioAsignado" id="usuarioAsignado">
                <?php

                for ($i = 0; $i < count($usuarios); $i++) {

                    $idusuarios = $usuarios[$i]['id'];
                    $nombre = $usuarios[$i]['nombre'];
                    echo "<option value='$idusuarios'>$nombre</option>";
                }

                ?>
            </select>
            <label for="peticion">Peticion:</label>
            <input type="text" id="peticion" name="peticion" required><br><br>

            <label for="para">Para:</label>
            <input type="email" id="para" name="para" required><br><br>


            <label for="de">De:</label>
            <input type="email" id="de" name="de" required><br><br>

            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" required><br><br>

            <label for="pdf">Selecciona un archivo PDF:</label>
            <input type="file" name="pdf" id="pdf" accept="application/pdf">
            <br><br>

            <button type="submit">Enviar</button>


        </form>
    </div>
    <div id="ex1" class="modal">
        <p>Quieres enviar un mail a la peticion.</p>
        <button type="button" id="Si">Si</button>

        <button type="button" id="No">No</button>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
 
    <script src="script.js"></script>
</body>

</html>