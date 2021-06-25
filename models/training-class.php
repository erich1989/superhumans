<?php

class BaseModel
{
    function __construct($connection)
    {
        $this->connection = $connection;
    }
}

class Training extends BaseModel
{
    public $title;
    public $objetive;
    public $type;
    public $questionOne;
    public $questionTwo;
    public $questionThree;
    public $questionFour;
    public $questionFive;

    public function newTraining()
    {

        $queryTraining = $this->connection->prepare("INSERT INTO competence (title, type) VALUES (?, ?) ");
        $queryTraining->bind_param('ss', $this->title, $this->type);

        $queryTraining->execute();
    }

    public function allTraining()
    {
        $json = array();
        $query = "SELECT * FROM competence ORDER BY title";
        $result = mysqli_query($this->connection, $query);

        if (!$result) {
            die("Query Failed all training" . mysqli_error($this->connection));
        }

        while ($row = mysqli_fetch_array($result)) {
            $json[] = array(
                'id' => $row['id'],
                'title' => $row['title'],
                'type' => $row['type']
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }

    public function selectTraining($title)
    {
        $json = array();
        $query = "SELECT * FROM competence WHERE title = '$title'";
        $result = mysqli_query($this->connection, $query);

        if (!$result) {
            die('Query Faild select training' . mysqli_error($this->connection));
        }

        while ($row = mysqli_fetch_array($result)) {
            $json[] = array(
                'id' => $row['id'],
                'title' => $row['title'],
                'type' => $row['type'],
            );
        }

        // $jsonstring = json_encode($json); 
        // return $jsonstring;

        return array_values($json);
    }
}

class Teacher extends BaseModel
{
    public $firstName;
    public $lastName;
    public $cc;
    public $profession;

    public function newTeacher()
    {
        $queryTeacher = $this->connection->prepare("INSERT INTO teacher (first_name, last_name, cc, profession ) VALUES (?, ?, ?, ?)");
        $queryTeacher->bind_param('ssss', $this->firstName, $this->lastName, $this->cc, $this->profession);
        $queryTeacher->execute();
    }

    public function allTeacher()
    {
        $json = array();
        $query = "SELECT * FROM teacher ORDER BY first_name";
        $result = mysqli_query($this->connection, $query);

        if (!$result) {
            die("Query Failed all teacher" . mysqli_error($this->connection));
        }

        while ($row = mysqli_fetch_array($result)) {
            $json[] = array(
                'id' => $row['id'],
                'first_name' => $row['first_name'],
                'last_name' => $row['last_name'],
                'cc' => $row['cc'],
                'profession' => $row['profession']
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }
}


class LearningMethod extends BaseModel
{
    public $nameTraining;
    public $objetive;
    public $nameTeacher;
    public $nameEmployee;
    public $start;
    public $end;

    public function newLearningMethod()
    {
        $queryLearningMethod = $this->connection->prepare("INSERT INTO training_teacher_employees (name_training, objetive, name_teacher, name_employee, start, end) VALUES (?, ?, ?, ?, ?, ?)");
        $queryLearningMethod->bind_param('ssssss', $this->nameTraining, $this->objetive, $this->nameTeacher, $this->nameEmployee, $this->start, $this->end);
        $queryLearningMethod->execute();
    }

    public function selectLearningMethodInformation($title, $start)
    {
        $training = array();
        $query = "SELECT * FROM training_teacher_employees WHERE name_training = '$title' AND start = '$start'";
        $result = mysqli_query($this->connection, $query);

        if (!$result) {
            return [];
        }

        while ($row =  mysqli_fetch_array($result)) {
            if (!isset($training[$row['name_training']])) {
                $training[$row['name_training']] = array(
                    'title' => $row['name_training'],
                    'objetive' => $row['objetive'],
                    'teacher' => $row['name_teacher'],
                    'start' => $row['start'],
                    'end' => $row['end'],
                    'employees' => [],
                );
            }

            $training[$row['name_training']]['employees'][] = [
                'employee' => $row['name_employee'],
            ];
        }

        return array_values($training);
    }


    public function selectLearningMethodInformationJson($title, $start)
    {
        $training = array();
        $query = "SELECT * FROM training_teacher_employees WHERE name_training = '$title' AND start = '$start'";
        $result = mysqli_query($this->connection, $query);

        if (!$result) {
            return [];
        }

        while ($row =  mysqli_fetch_array($result)) {
            if (!isset($training[$row['name_training']])) {
                $training[$row['name_training']] = array(
                    'title' => $row['name_training'],
                    'objetive' => $row['objetive'],
                    'teacher' => $row['name_teacher'],
                    'start' => $row['start'],
                    'end' => $row['end'],
                    'employees' => [],
                );
            }

            $training[$row['name_training']]['employees'][] = [
                'employee' => $row['name_employee'],
            ];
        }
        // $json = json_encode($training);
         return array_values($training);
    }

    public function deleteLearningMethod($nameTraining, $start){

            $query = "DELETE FROM training_teacher_employees WHERE name_training = '$nameTraining' AND start = '$start'";

            $result = mysqli_query($this->connection, $query);

            if (!$result) {
                die('Query failed delete learning method.');
            }
            echo 'Learninh method delete successfully';

    }
}
