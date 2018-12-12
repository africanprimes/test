<?php

require('Task.class.php');

$post = file_get_contents('php://input');

if (isset($_POST['TaskName']) && isset($_POST['TaskDescription'])) {

    $Task = new Task();
    $Task->TaskId = $Task->getUniqueId(10);
    $Task->TaskName = $_POST['TaskName'];
    $Task->TaskDescription = $_POST['TaskDescription'];

    $current = file_get_contents('db.json');
    $tempArray = json_decode($current);

    array_push($tempArray, $Task);

    $jsonData = json_encode($tempArray);

    file_put_contents('db.json', $jsonData);

    print_r($Task);

} else {

    echo "Error creating new post, missing name or description";

}

?>                                                                                                                                                                                                                                                                                                                                                                                                                                             