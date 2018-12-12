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
    <link rel="stylesheet" href="assets/build/build.app.css">
    <!-- endinject -->
</head>
<body class="app">

<header class="text-center">
    <img class="logo" src="assets/img/logo.svg" />
</header>
<main>
    <ul class="task-list">
        <li class="task-list-item text-center">
            <div class="icon"><img src=""/></div>
            <h3 class="empty-title">No Tasks Available</h3>
            <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#task_form">Create New Task</button>
        </li>
    </ul>
</main>
<footer>

</footer>

<div class="modal fade" id="task_form" tabindex="-1" role="dialog" aria-labelledby="task_form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="task-name" class="col-form-label">Name:</label>
                        <input type="text" class="form-control form-control-lg" id="task-name" placeholder="Task Name">
                    </div>
                    <div class="form-group">
                        <label for="task-description" class="col-form-label">Description:</label>
                        <textarea class="form-control" id="task-description"  placeholder="Task Description"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="saveTask()">Save Task</button>
            </div>
        </div>
    </div>
</div>
<!-- inject:js -->
<script src="assets/build/build.app.js"></script>
<!-- endinject -->
</body>
</html>