<?php
require $_SERVER['DOCUMENT_ROOT'] . '/db/DBConn.php';
require $_SERVER['DOCUMENT_ROOT'] . '/controllers/TaskController.php';
$conn = create_connection();

$taskController = new TaskController($conn);

$taskID = $_GET['taskID'];

if ($taskController->check($taskID)) {
    echo "finalizada correctamente";
    //Header("Location: ../ceduladonante.html");
} else {
    echo "Fallo al crear donante";
    //Header("Location: ../ceduladonante.html");
}

?>