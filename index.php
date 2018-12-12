<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Basic Task Manager</title>
    <meta name="description"
          content="This exercise evaluates a basic understanding of PHP, jQuery, HTML & CSS. It makes use of the bootstrap UI framework.">
    <meta name="author" content="Zeal Murapa">
    <!----- ICONS ---->
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="apple-touch-icon image_src" href="/assets/img/apple-icon.png">
    <meta name="msapplication-TileImage" content="/assets/img/ms-icon.png">
    <meta name="theme-color" content="#004ae3">
    <!-- inject:css -->
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- endinject -->
</head>
<body class="app">

<header class="text-center">
    <img class="logo" src="assets/img/logo.svg" />
</header>
<main>

    <ul class="task_list">

    </ul>

    <button class="btn btn-primary btn-lg create-new-button" data-toggle="modal" data-target="#task_modal">Create a New Task</button>

</main>
<footer>

</footer>

<div class="modal fade" id="task_modal" tabindex="-1" role="dialog" aria-labelledby="task_modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="taskForm">
                    <input type="hidden" class="form-control form-control-lg TaskId">
                    <div class="form-group">
                        <label for="task-name" class="col-form-label">Name:</label>
                        <input type="text" class="form-control form-control-lg TaskName" id="task-name" placeholder="Task Name">
                    </div>
                    <div class="form-group">
                        <label for="task-description" class="col-form-label">Description:</label>
                        <textarea class="form-control form-control-lg TaskDescription" id="task-description"  placeholder="Task Description"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-lg" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-lg" id="saveTask">Save Task</button>
            </div>
        </div>
    </div>
</div>
<!-- inject:js -->
<script src="node_modules/jquery/dist/jquery.min.js"></script>
<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/api.js"></script>
<script src="assets/js/app.js"></script>
<!-- endinject -->
</body>
</html>