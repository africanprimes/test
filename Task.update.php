<?php

require('Task.class.php');

$post = file_get_contents('php://input');


if( isset($_POST['TaskName']) && isset($_POST['TaskDescription'])) {

    $task = new Task();
    $task->TaskId = $_POST['TaskId'];
    $task->TaskName = $_POST['TaskName'];
    $task->TaskDescription = $_POST['TaskDescription'];

    $data[] = $task;

    $inp = file_get_contents('db.json');

    $tempArray = json_decode($inp);

    array_push($tempArray, $data);

    $jsonData = json_encode($tempArray);

    file_put_contents('db.json', $jsonData);

} else {

    echo "No post set for update";

}

?>                                                                                                                                                                                                                                                                                                                                                                                                                                             