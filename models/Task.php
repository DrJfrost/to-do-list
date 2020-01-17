<?php

require $_SERVER['DOCUMENT_ROOT'].'/db/TaskQuerties.php';

class Task {

    //Attributes
    private $taskID;
    private $title;
    private $description;
    private $color;
    private $state;

    
    private $tasks = [];

    //Connection DB
    private $conn;
    private $querties;

    //constructor definition
    public function __construct($conn){
        $this->conn = $conn;
        $this->querties = new TaskQuerties();
    }

    public function listTasks(){
        $res = $this->querties->listTasks($this->conn);
        for($i = 0; $i <count($res); $i++){
            $task = new Task($this->conn);
            $task->setTaskID($res[$i]['taskID']);
            $task->setTitle($res[$i]['title']);
            $task->setDescription($res[$i]['description']);
            $task->setColor($res[$i]['color']);
            $task->setState($res[$i]['state']);
            $this->tasks[] = $task;
        }
        return $this->tasks;
    }

    public function show($taskID){
        $this->setTaskID($taskID);
        $res = $this->querties->getTask($this->conn, $this->taskID);
        if(!empty($res)){
            $this->setTaskID($res['taskID']);
            $this->setTitle($res['title']);
            $this->setDescription($res['description']);
            $this->setColor($res['color']);
            $this->setState($res['state']);
        }else{
            echo "La tarea no existe";
        }
    }

    public function create($title, $description, $color){
        $this->setTitle($title);
        $this->setDescription($description);
        $this->setColor($color);
        return $this->querties->insertTask($this->conn, $this->title, $this->description, $this->color);
    }

    public function update($title, $description, $color, $taskID){
        $this->setTitle($title);
        $this->setDescription($description);
        $this->setColor($color);
        $this->setTaskID($taskID);
        return $this->querties->updateTask($this->conn, $this->title, $this->description, $this->color, $this->taskID);
    }

    public function check($taskID){
        $this->setTaskID($taskID);
        return $this->querties->checkTask($this->conn, $this->taskID);
    }

    public function delete($taskID){
        $this->setTaskID($taskID);
        return $this->querties->deleteTask($this->conn, $this->taskID);
    }

    //getters
    public function getTaskID(){
        return $this->taskID;
    }

    public function getTitle(){
        return $this->title;
    }

    public function getDescription(){
        return $this->description;
    }

    public function getColor(){
        return $this->color;
    }

    public function getState(){
        return $this->state;
    }

    //setters
    public function setTaskID($taskID){
        $this->taskID = $taskID;
    }

    public function setTitle($title){
        $this->title = $title;
    }

    public function setDescription($description){
        $this->description = $description;
    }

    public function setColor($color){
        $this->color = $color;
    }

    public function setState($state){
        $this->state = $state;
    }

} 

?>