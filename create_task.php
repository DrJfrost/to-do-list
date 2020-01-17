<?php
require $_SERVER['DOCUMENT_ROOT'] . '/db/DBConn.php';
require $_SERVER['DOCUMENT_ROOT'] . '/controllers/TaskController.php';
$conn = create_connection();

$taskController = new TaskController($conn);

$title = $_POST['title'];
$desc = $_POST['desc'];
$color = $_POST['color'];

if ($taskController->create($title, $desc, $color)) {
    echo "Creado correctamente";
    Header("Location: index.php");
} else {
    echo "Fallo al crear donante";
    //Header("Location: ../ceduladonante.html");
}

?>