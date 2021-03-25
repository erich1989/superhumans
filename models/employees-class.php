<?php
class BaseModel
{
    function __construct($connection)
    {
        $this->connection = $connection;
    }
}


class Employee extends BaseModel
{

    public $json = array();
    public $firstName;
    public $lastName;
    public $cc;
    public $birthday;
    public $position;
    public $workingArea;
    public $contractType;
    public $phoneNumber;
    public $address;
    public $email;
    public $salary;
    public $arl;
    public $ccf;
    public $eps;
    public $startDate;
    public $endDate;
    public $reasonDismissal;
    public $photo;
    public $pdf;


    function selectAllEmployees($state)
    {
        $result = mysqli_query($this->connection, "SELECT * FROM employee WHERE active = '$state' ORDER BY first_name");
        while ($row = mysqli_fetch_array($result)) {
            $this->json[] = $row;
        }
        // mysqli_free_result($result);
        // $jsonstring = json_encode($this->json);
        return $this->json;
    }

    function selectAnEmployee($id)
    {
        $result = mysqli_query($this->connection, "SELECT * FROM employee WHERE id = '$id'");
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $this->employees[] = $row;
        }
        mysqli_free_result($result);
        return $this->employees;
    }

    function createEmployee()
    {
        // Crear el query sin valores
        $queryGuardar = $this->connection->prepare("INSERT INTO employee (first_name, last_name, cc, birthday, position, working_area, contract_type, phone_number, home_address, email, salary, arl, c_c_f, eps, start_of_date, photo, cv_pdf) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ? ,? , ?, ?, ?, ?, ?, ?)");

        // Conecto los valores
        $queryGuardar->bind_param('ssssssssssissssss', $this->firstName, $this->lastName, $this->cc, $this->birthday, $this->position, $this->workingArea, $this->contractType, $this->phoneNumber, $this->address, $this->email, $this->salary, $this->arl, $this->ccf, $this->eps, $this->startDate, $this->photo, $this->pdf);

        // envio el query ya preparado con con los valores
        $queryGuardar->execute();
    }

    function updateEmployee($id)
    {

        $query =  " UPDATE employee SET first_name = '$this->firstName', last_name = '$this->lastName', cc = '$this->cc', birthday = '$this->birthday', position = '$this->position', working_area = '$this->workingArea', contract_type = '$this->contractType', phone_number = '$this->phoneNumber',  home_address = '$this->address', email = '$this->email', salary = '$this->salary', arl = '$this->arl', c_c_f = '$this->ccf', eps = '$this->eps', start_of_date = '$this->startDate' WHERE id = '$id' ";

        $update = mysqli_query($this->connection, $query);
        return $update;

    }

    function deleteEmployee($id)
    {

        $query =  " UPDATE employee SET end_date = '$this->endDate', reason_dismissal = '$this->reasonDismissal', active = 0  WHERE id = '$id' ";

        $update = mysqli_query($this->connection, $query);
        return $update;
    }

    function searchEmployees($active, $q)
    {
        if (!empty($q)) {
            $query = "SELECT * FROM employee WHERE active = '$active' AND (first_name LIKE '%$q%' OR last_name LIKE '%$q%' OR cc LIKE '%$q%' ) ORDER BY first_name";
            $result = mysqli_query($this->connection, $query);
            if (!$result) {
                die('Query Error' . mysqli_error($this->connection));
            }

            $json = array();

            while ($row = mysqli_fetch_array($result)) {
                $json[] = array(
                    'id' => $row['id'],
                    'firstname' => $row['first_name'],
                    'lastname' => $row['last_name'],
                    'cc' => $row['cc'],
                    'position' => $row['position'],
                    'area' => $row['working_area'],
                    'contract' => $row['contract_type'],
                    'startdate' => $row['start_of_date'],
                    'enddate' => $row['end_date'],
                    'reasondismissal' => $row['reason_dismissal'],

                );
            }

            $jsonstring = json_encode($json);
            return $jsonstring;
        }
    }
}