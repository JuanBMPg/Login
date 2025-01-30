<?php
session_start();
session_unset();
session_destroy();
header("Location: login.php");
exit();
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="estiloslogout.css">
        <link rel="stylesheet" type="text/css" href="estilosgeneral.css">
    </head>
</html>