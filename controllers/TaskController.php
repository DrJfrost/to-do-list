<?php

require $_SERVER['DOCUMENT_ROOT'].'/models/Task.php';

class TaskController{

    private $conn;
    private $task;

    public function __construct($conn){
        $this->conn = $conn;
        $this->task = new Task($this->conn);
    }

    public function listTasks(){
        return $this->task->listTasks();
    }

    public function show($taskID){
        $this->task->show($taskID);
        return $this->task;
    }

    public function create($title, $description, $color){
        return $this->task->create($title, $description, $color);
    }

    public function update($title, $description, $color, $taskID){
        return $this->task->update($title, $description, $color, $taskID);
    }

    public function check($taskID){
        return $this->task->check($taskID);
    }

    public function delete($taskID){
        return $this->task->delete($taskID);
    }
}

?>