<?php
require $_SERVER['DOCUMENT_ROOT'] . '/db/DBConn.php';
require $_SERVER['DOCUMENT_ROOT'] . '/controllers/TaskController.php';
$conn = create_connection();

$taskController = new TaskController($conn);

$tasks = $taskController->listTasks();

$colors = array("bg-primary", "bg-success", "bg-info", "bg-warning", "bg-danger", "bg-secondary", "bg-dark", "bg-light");

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Prueba To Do List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
    <link rel="stylesheet" href="styles/todo_styles.css">
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'></script>
</head>

<body>
    <div class="row d-flex justify-content-center container">
        <div class="col-md-8">
            <div class="card-hover-shadow-2x mb-3 card">
                <div class="card-header-tab card-header">
                    <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i class="fa fa-tasks"></i>&nbsp;Lista de Tareas</div>
                </div>
                <div class="scroll-area-sm">
                    <perfect-scrollbar class="ps-show-limits">
                        <div style="position: static;" class="ps ps--active-y">
                            <div class="ps-content">
                                <ul class=" list-group list-group-flush">
                                    <?php
                                    for ($i = 0; $i < count($tasks); $i++) {
                                        echo '<li class="list-group-item">
                                        <div class="todo-indicator ' . $colors[$tasks[$i]->getColor()] . '"></div>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left mr-2">
                                                    <div class="custom-checkbox custom-control"> <input class="custom-control-input" id="exampleCustomCheckbox12" type="checkbox"><label class="custom-control-label" for="exampleCustomCheckbox12">&nbsp;</label> </div>
                                                </div>
                                                <div class="widget-content-left">
                                                    <div class="widget-heading">' . $tasks[$i]->getTitle() . '
                                                    </div>
                                                    <div class="widget-subheading"><i>' . $tasks[$i]->getDescription() . '</i></div>
                                                </div>
                                                <div class="widget-content-right"> <a class="border-0 btn-transition btn btn-outline-success" href="check_task.php?taskID=' . $tasks[$i]->getTaskID() . '"> <i class="fa fa-check"></i></a> <a class="border-0 btn-transition btn btn-outline-danger" role="button" href="delete_task.php?taskID=' . $tasks[$i]->getTaskID() . '"> <i class="fa fa-trash"></i> </a> </div>
                                            </div>
                                        </div>
                                    </li>';
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </perfect-scrollbar>
                </div>
                <div class="d-block text-right card-footer">
                    <button class="mr-2 btn btn-link btn-sm" id="task_cancel">Cancelar</button><button class="btn btn-primary" id="task_add">Agregar Tarea</button>
                </div>
                <div class="card-footer task-insertion">
                    <form action="create_task.php" method="POST">
                        <div class="form-group">
                            <label for="task_title">
                                <h5>Titulo</h5>
                            </label>
                            <input type="text" class="form-control" id="task_title" name="title" aria-describedby="task_title" placeholder="ingrese el título">
                            <small id="emailHelp" class="form-text text-muted">Puedes usar un titulo llamativo para que no se te olvide!</small>
                        </div>
                        <div class="form-group">
                            <label for="task_desk">
                                <h5>Descripcion</h5>
                            </label>
                            <input type="text" class="form-control" id="task_desc" name="desc" placeholder="Los detalles siempre importan...">
                        </div>
                        <div class="form-group">
                            <label class="task_color" for="inlineFormCustomSelect">Color de la tarea</label>
                            <select class="custom-select task_color" id="inlineFormCustomSelect" name="color">
                                <option value="0" style="background:#007bff">principal</option>
                                <option value="1" style="background:#28a745">afirmativo</option>
                                <option value="2" style="background:#17a2b8">informacion</option>
                                <option value="3" style="background:#ffc107">atencion</option>
                                <option value="4" style="background:#dc3545">emergencia</option>
                                <option value="5" style="background:#6c757d">gris</option>
                                <option value="6" style="background:#343a40">gris oscuro</option>
                                <option value="7" style="background:#f8f9fa">ninguno</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    $(".task-insertion").hide();

    $("#task_add").click(function() {
        $(".task-insertion").show("slow");
    });

    $("#task_cancel").click(function() {
        $(".task-insertion").hide("slow");
    });
</script>

</html>