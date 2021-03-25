<?php

class Validator
{
    public $errorFirstName;
    public $errorLastName;
    public $errorCc;
    public $errorBirthday;
    public $errorPosition;
    public $errorPhone;
    public $errorAddress;
    public $errorEmail;
    public $errorSalary;
    public $errorWorkingArea;
    public $errorContractType;
    public $errorArl;
    public $errorCcf;
    public $errorEps;
    public $errorStartDate;
    public $errorEndDate;
    public $errorReasonDismissal;
    public $errorPhoto;
    public $errorPdf;
    public $errorTitleEvent;

    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function isValidFirstName($name)
    {
        if (empty($name)) {
            $this->errorFirstName = "Requerido";
        } else {
            $clearFirstName = $this->test_input($name);
            if (!preg_match("/^[a-zA-Z-' ]*$/", $clearFirstName)) {
                $this->errorFirstName = "Sólo se permiten letras y espacios en blanco";
            } else {
                return TRUE;
            }
        }
    }

    function isValidLastName($name)
    {
        if (empty($name)) {
            $this->errorLastName = "Requerido";
        } else {
            $clearName = $this->test_input($name);
            if (!preg_match("/^[a-zA-Z-' ]*$/", $clearName)) {
                $this->errorLastName = "Sólo se permiten letras y espacios en blanco";
            } else {
                return TRUE;
            }
        }
    }

    function isValidCc($cc)
    {
        if (empty($cc)) {
            $this->errorCc = "Requerido";
        } else {
            $clearCc = $this->test_input($cc);
            if (!preg_match("/^([0-9])*$/", $clearCc)) {
                $this->errorCc = "Sólo se permiten números";
            } else {
                return TRUE;
            }
        }
    }

    function isValidBirthday($birthday)
    {
        if (empty($birthday)) {
            $this->errorBirthday = "Requerido";
        } else {
            $this->test_input($birthday);
            return TRUE;
        }
    }

    function isValidPosition($position)
    {
        if ($position == "") {
            $this->errorPosition = "Requerido";
        } else {
            $this->test_input($position);
            return TRUE;
        }
    }

    function isValidWorkingArea($workingArea)
    {
        if ($workingArea == "") {
            $this->errorWorkingArea = "Requerido";
        } else {
            $this->test_input($workingArea);
            return TRUE;
        }
    }

    function isValidContractType($contractType)
    {
        if ($contractType == "") {
            $this->errorContractType = "Requerido";
        } else {
            $this->test_input($contractType);
            return TRUE;
        }
    }

    function isValidReasonDismissal($reason)
    {
        if ($reason == "") {
            $this->errorReasonDismissal = "Requerido";
        } else {
            $this->test_input($reason);
            return TRUE;
        }
    }

    function isValidPhone($phone)
    {
        if (empty($phone)) {
            $this->errorPhone = "Requerido";
        } else {
            $clearPhone = $this->test_input($phone);
            if (!preg_match("/^([0-9])*$/", $clearPhone)) {
                $this->errorPhone = "Sólo se permiten números";
            } else {
                return TRUE;
            }
        }
    }

    function isValidAddress($address)
    {
        if (empty($address)) {
            $this->errorAddress = "Requerido";
        } else {
            $this->test_input($address);
            return TRUE;
        }
    }

    function isValidEmail($email)
    {
        if (empty($email)) {
            $this->errorEmail  = "Requerido";
        } else {
            $email = $this->test_input($email);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->errorEmail = "Formato de correo invalido";
            }
        }
    }

    function isValidSalary($salary)
    {
        if (empty($salary)) {
            $this->errorSalary = "Requerido";
        } else {
            $clearSalary = $this->test_input($salary);
            if (!preg_match("/^([0-9])*$/", $clearSalary)) {
                $this->errorSalary = "Sólo se permiten números";
            } else {
                return TRUE;
            }
        }
    }

    function isValidArl($arl)
    {
        if (empty($arl)) {
            $this->errorArl = "Requerido";
        } else {
            $this->test_input($arl);
            return TRUE;
        }
    }

    function isValidCcf($ccf)
    {
        if (empty($ccf)) {
            $this->errorCcf = "Requerido";
        } else {
            $this->test_input($ccf);
            return TRUE;
        }
    }

    function isValidEps($eps)
    {
        if (empty($eps)) {
            $this->errorEps = "Requerido";
        } else {
            $this->test_input($eps);
            return TRUE;
        }
    }

    function isValidStartDate($startDate)
    {
        if (empty($startDate)) {
            $this->errorStartDate = "Requerido";
        } else {
            $this->test_input($startDate);
            return TRUE;
        }
    }

    function isValidEndtDate($endDate)
    {
        if (empty($endDate)) {
            $this->errorEndDate = "Requerido";
        } else {
            $this->test_input($endDate);
            return TRUE;
        }
    }

    function isValidEmailDb($connection, $email)
    {
        $verificar_correo = mysqli_query($connection, "SELECT * FROM employee WHERE email = '$email'");
        if (mysqli_num_rows($verificar_correo) > 0) {
            $this->errorEmail = "El correo ya está resgistado";
        }
    }

    function isValidCcDb($connection, $cc)
    {
        $verificar_cc = mysqli_query($connection, "SELECT * FROM employee WHERE cc = '$cc'");
        if (mysqli_num_rows($verificar_cc) > 0) {
            $this->errorCc = "la ceduala ya está resgistado";
        }
    }

    function isValidPhoneDb($connection, $phone)
    {
        $verificar_phone = mysqli_query($connection, "SELECT * FROM employee WHERE phone_number = '$phone'");
        if (mysqli_num_rows($verificar_phone) > 0) {
            $this->errorPhone = "El telefono ya está resgistado";
        }
    }

    function isValidPhoto()
    {
        if (empty($_FILES['photo']['name'])) {
            $this->errorPhoto = "Requerido";
        } else {
            $imageName = $_FILES['photo']['name'];
            $imageType = $_FILES['photo']['type'];
            $imageSize = $_FILES['photo']['size'];

            if ($imageType == 'image/jpeg' || $imageType == 'image/jpg' || $imageType == 'image/png') {
                if ($imageSize <= 100000) {
                    $destinationFolder = $_SERVER['DOCUMENT_ROOT'] . '/superhumans_mvc/src/images/employees-photos/';
                    move_uploaded_file($_FILES['photo']['tmp_name'], $destinationFolder . $imageName);
                    return TRUE;
                    // echo $imageName;
                } else {
                    $this->errorPhoto = 'Tamaño de imagen muy grande';
                }
            } else {
                $this->errorPhoto = 'formato de imagen no permitido';
            }
        }
    }

    function isValidPdf()
    {

        // var_dump($_FILES['pdf']);
        if (empty($_FILES['pdf']['name'])) {
            $this->errorPdf = 'Requerido';
        } else {

            $pdfName = $_FILES['pdf']['name'];
            $pdfType = $_FILES['pdf']['type'];
            $pdfSize = $_FILES['pdf']['size'];
            if ($pdfSize <= 1000000) {
                if ($pdfType == 'application/pdf') {
                    var_dump($_FILES['pdf']);
                    $destinationFolder = $_SERVER['DOCUMENT_ROOT'] . '/superhumans_mvc/src/cv-pdf/';
                    move_uploaded_file($_FILES['pdf']['tmp_name'], $destinationFolder . $pdfName);
                    return TRUE;
                } else {
                    $this->errorPdf = 'Formato de documento no valido';
                }
            } else {
                $this->errorPdf = 'Tamaño del pdf muy grande';
            }
        }
    }

    function isValidTitleEvent($value)
    {
        if (empty($value)) {
            $this->errorTitleEvent = "Requerido";
            return;
        } else {
            $clearTitleEvent = $this->test_input($value);
            if (!preg_match("/^[a-zA-Z-' ]*$/", $clearTitleEvent)) {
                $this->errorTitleEvent = "Sólo se permiten letras y espacios en blanco";
            } else {
                return TRUE;
            }
        }
    }
}
