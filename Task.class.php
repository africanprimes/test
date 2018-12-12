<?php

class Task {
    public $TaskId;
    public $TaskName;
    public $TaskDescription;
    protected $TaskDataSource;

    public function __construct($Id = null) {

        $this->TaskDataSource = file_get_contents('db.json');

        if (strlen($this->TaskDataSource) > 0){

            $this->TaskDataSource = json_decode($this->TaskDataSource);

        } else {

            $this->TaskDataSource = array();

        }

        if (!$this->TaskDataSource){

            $this->TaskDataSource = array();

        }

        if (!$this->LoadFromId($Id)){

            $this->Create();

        }

    }

    protected function Create() {
        // This function needs to generate a new unique ID for the task
        // Assignment: Generate unique id for the new task
        $this->TaskId = $this->getUniqueId( 10 );
        $this->TaskName = 'New Task';
        $this->TaskDescription = 'New Description';

    }

    public function getUniqueId( $length ) {

        $Id = "";
        $alpha = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $max = strlen($alpha);

        for ($i=0; $i < $length; $i++) {

            $Id .= $alpha[random_int(0, $max-1)];

        }

        return  $Id;

    }

    protected function LoadFromId($Id = null) {

        if ($Id) {

            // Assignment: Code to load details here...

        } else {

            return null;

        }

    }

    public function Save() {

        //Assignment: Code to save task here

        $data[] = $_POST['data'];

        $inp = file_get_contents('results.json');

        $tempArray = json_decode($inp);

        array_push($tempArray, $data);

        $jsonData = json_encode($tempArray);

        file_put_contents('results.json', $jsonData);

    }

    public function Delete( $Id ) {

        $raw = file_get_contents('db.json');

        $Tasks = json_decode($raw , true);

        foreach ($Tasks as $key => $value) {

            if (in_array($Id, $value)) {

                unset($Tasks[$key]);

            }

        }

        $Tasks = json_encode($Tasks );

        file_put_contents('db.json', $Tasks);

        return 'Successfully deleted';

    }

}

?>