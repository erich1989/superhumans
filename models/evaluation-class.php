<?php

class BaseModelEvaluation
{
    function __construct($connection)
    {
        $this->connection = $connection;
    }
}

class Evaluation extends BaseModelEvaluation
{
    public $competence;
    public $startDate;
    public $endDate;

    public function createNewEvaluation()
    {
        $queryNewEvaluation = $this->connection->prepare("INSERT INTO evaluation (competence, start_date, end_date) value (?,?,?)");
        $queryNewEvaluation->bind_param('sss', $this->competence, $this->startDate, $this->endDate);
        $queryNewEvaluation->execute();
    }

    public function deleteEvaluation($competence, $startDate)
    {
        $query = "DELETE FROM evaluation WHERE competence = '$competence' AND start_date = '$startDate'";

        $result = mysqli_query($this->connection, $query);

        if (!$result) {
            die('Query failed Evaluation delete.' . mysqli_error($this->connection));
        }
        echo 'Evaluation delete successfully';
    }

    public function allEvaluationInformation($competence, $startDate)
    {
        $json = array();
        $result = mysqli_query($this->connection, "SELECT * FROM evaluation WHERE competence = '$competence' AND start_date = '$startDate'");
        while ($row = mysqli_fetch_array($result)) {
            $json[] = $row;
        }

        // $jsonstring = json_encode($json);
        // return $jsonstring;
        return array_values($json);
        mysqli_free_result($result);
    }
}

class Question extends BaseModelEvaluation
{
    public $idEvaluation;
    public $question;
    public $correctResponse;
    public $optionA;
    public $optionB;
    public $optionC;
    public $optionD;

    public function selectQuestions($id_evaluation)
    {
        $json = array();
        $query = "SELECT * FROM question_evaluation WHERE id_evaluation = '$id_evaluation' ";
        $result = mysqli_query($this->connection, $query);

        while ($row = mysqli_fetch_array($result)) {
            $json[] = array(
                'id' => $row['id'],
                'id_evaluation' => $row['id_evaluation'],
                'question' => $row['question'],
                'correct_response' => $row['correct_response'],
                'option_a' => $row['option_a'],
                'option_b' => $row['option_b'],
                'option_c' => $row['option_c'],
                'option_d' => $row['option_d'],
            );
        }

        return array_values($json);
        mysqli_free_result($result);
    }

    public function selectQuestionsJson($id_evaluation)
    {
        $json = array();
        $query = "SELECT * FROM question_evaluation WHERE id_evaluation = '$id_evaluation' ";
        $result = mysqli_query($this->connection, $query);

        while ($row = mysqli_fetch_array($result)) {
            $json[] = array(
                'id' => $row['id'],
                'id_evaluation' => $row['id_evaluation'],
                'question' => $row['question'],
                'correct_response' => $row['correct_response'],
                'option_a' => $row['option_a'],
                'option_b' => $row['option_b'],
                'option_c' => $row['option_c'],
                'option_d' => $row['option_d'],
            );
        }

        return json_encode($json);
        mysqli_free_result($result);
    }

    public function createNewEvaluationQuestion()
    {
        $query = $this->connection->prepare("INSERT INTO question_evaluation (id_evaluation, question, correct_response, option_a, option_b, option_c, option_d) VALUES (?,?,?,?,?,?,?)");

        $query->bind_param('sssssss', $this->idEvaluation, $this->question, $this->correctResponse, $this->optionA, $this->optionB, $this->optionC, $this->optionD);

        $query->execute();
    }

    public function deleteEvalauationQuestions($idEvaluation)
    {
        $query = "DELETE FROM question_evaluation WHERE id_evaluation = '$idEvaluation'";

        $result = mysqli_query($this->connection, $query);

        if (!$result) {
            die('Query failed delete questions.');
        }
        echo 'Questions delete successfully';
    }
}
