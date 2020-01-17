<?php

class TaskQuerties {

    function listTasks($conn){
        $stmt = $conn->prepare("SELECT * FROM Task WHERE state = 'activo' ORDER BY taskID DESC");
        $stmt->execute();
        $result = $stmt->get_result();
        $tasks = [];
        while ($row = $result->fetch_assoc()) {
            $tasks[] = $row;
        }
        return $tasks;
    }

    function getTask($conn, $taskID){
        $stmt = $conn->prepare("SELECT * FROM Task WHERE taskID = ?");
        $stmt->bind_param("i", $taskID);
        $stmt->execute();
        $result = $stmt->get_result();
        $donacion = [];
        while ($row = $result->fetch_assoc()) {
            $donacion = $row;
        }
        return $donacion;
    }

    function insertTask($conn, $title, $description, $color) {
        $stmt = $conn->prepare("INSERT INTO Task (title, description, color) VALUES (?, ?, ?);");
        if (
            $stmt &&
            $stmt->bind_param("ssi",  $title, $description, $color) &&
            $stmt->execute()
        ) {
            echo "New Task created successfully<br>";
            return true;
        } else {
            echo "Error: $conn->error";
            return false;
        }
    }

    function updateTask($conn, $title, $description, $color, $taskID) {
        $stmt = $conn->prepare("UPDATE task SET title = ?, description = ?, color = ? WHERE taskID = ?;");
        if (
            $stmt &&
            $stmt->bind_param("ssii", $title, $description, $color, $taskID) &&
            $stmt->execute()
        ) {
            echo "Task updated successfully<br>";
            return true;
        } else {
            echo "Error: $conn->error";
            return false;
        }
    }

    function checkTask($conn, $taskID) {
        $stmt = $conn->prepare("UPDATE task SET state = 'finalizado' WHERE taskID = ?;");
        if (
            $stmt &&
            $stmt->bind_param("i", $taskID) &&
            $stmt->execute()
        ) {
            echo "Task updated successfully<br>";
            return true;
        } else {
            echo "Error: $conn->error";
            return false;
        }
    }

    function deleteTask($conn, $taskID) {
        $stmt = $conn->prepare("DELETE FROM Task WHERE taskID = ?;");
        if (
            $stmt &&
            $stmt->bind_param("i", $taskID) &&
            $stmt->execute()
        ) {
            echo "Task Deleted successfully<br>";
            return true;
        } else {
            echo "Error: $conn->error";
            return false;
        }
    }

}

?>