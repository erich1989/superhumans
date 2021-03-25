<?php

require_once('models/database-connection.php');
$connection = new Database("localhost", "transito", "valeria2", "superhumanos");

$user;
$password;
$errorInfo = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $user = $_POST['user'];

    $password = $_POST['password'];

    $query = "SELECT user_name, password FROM users WHERE user_name = '$user'";

    $verificar_info = mysqli_query($connection->connection, $query);

    $result = mysqli_num_rows($verificar_info);

    if ($result > 0) {
        $row = $verificar_info->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            header("Location:views/tasks/day.php");
        } else {
            $errorInfo = "La contraseña ingresada es incorrecta";
        }
        // echo $row['password']; 
    } else {
        $errorInfo = "El usuario ingresado es incorrecto";
        // echo $errorInfo;
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Document</title>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #007bff;
            color: white;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
        }

        form {
            background-color: white;
            color: black;
        }

        h2 {
            line-height: 42px;
            font-weight: 400;
        }

        .welcome {
            display: inline-block;
            color: rgba(255,255,255,.5);
        }

        .btn-index {
            color: #fff;
            background-color: #0acf97;
            border-color: #0acf97;
        }

        .list-index{
            color: rgba(255,255,255,.5);
        }
    </style>
</head>

<body>

    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary pt-4 pl-0">
            <a class="navbar-brand mr-5" href="#">
                <img src="src/images/logo_sh_blue.png" width="150px" height="" class="d-inline-block align-top" alt="" loading="lazy">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse d-flex justify-content-start" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                    </li>
                </ul>
        </nav>
        <div class="row justify-content-center align-items-center">
            <div class="col-6">
                <div class="">
                    <div>
                        <span class="badge rounded-pill mr-1" style="background-color: #fa5c7c;">New</span>
                        <p class="welcome">Bienvenido a SUPERHUMANS</p>
                    </div>

                    <h3>Concéntrate en los resultados y olvídate de los engorrosos procedimientos.</h3>
                    <br>
                    <ul type="A" class="list-index">
                        <li>Julio</li>
                        <li>Carmen</li>
                        <li>Ignacio</li>
                        <li>Elena</li>
                    </ul>
                </div>
            </div>
            <div class="col-6">
                <div class="p-5">
                    <form class="p-5 rounded" method="POST">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Usuario</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="user">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Contraseña</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success btn-index" ">Ingresar <i class=" fas fa-angle-double-right mt-1"></i></button>
                        </div>
                    </form>
                    <h4><?php echo $errorInfo ?></h4>
                </div>
            </div>
        </div>
    </div>



    <script src="https://kit.fontawesome.com/43fd7ff13a.js" crossorigin="anonymous"></script>

    <!-- Bootstrap js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

</body>

</html>