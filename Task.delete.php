<?php

require('Task.class.php');

$post = file_get_contents('php://input');

if (isset($_POST['TaskId'])) {

    $TaskId = $_POST['TaskId'];

    $raw = file_get_contents('db.json');

    $tasks = json_decode($raw, true);

    foreach($tasks as $k=>$v) {
        foreach ($tasks[$k] as $key=>$value) {
            if ($key === "TaskId" && $value === $TaskId) { //If Value of 2D is equal to user and cat

                unset($tasks[$k]);
            }
        }
    }

    $Tasks = json_encode($tasks );

    file_put_contents('db.json', $Tasks);

    echo 'Successfully deleted';

} else {

    echo "No post set for delete";

}

?>                                                                                                                                                                                                                                                                                                                                                                                                                                             