<?php

require_once('../../models/database-connection.php');
require_once('../../models/tasks-class.php');

$connection = new Database("localhost", "transito", "valeria2", "superhumanos");
$newEvent = new Events($connection->connection);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $newEvent->title = $_POST['titleevent'];
    $newEvent->allDay = $_POST['gridRadios'];
    $newEvent->start = $_POST['startDate'];
    $newEvent->end = $_POST['endDate'];
    $newEvent->className = $_POST['className'];

    $newEvent->createEvent();

    echo '<script> alert("Evento guardado satisfactoriamente") </script>';
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Document</title>
    <link href='../../fullcalendar/main.css' rel='stylesheet' />
    <script src='../../fullcalendar/main.js'></script>
    <script src='../../fullcalendar/locales/es.js'></script>
    <script src="../../moment/moment.js"></script>



    <style>
        body {
            font-family: 'Nunito', sans-serif;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
        }

        .primary {
            /* background: rgba(250,92,124,.25); */
            background-color: #fa5c7c;
            border: red;
            /* color: #fa5c7c !important; */
            text-align: center;
            font-size: 15px;
        }

        .secondary {
            background: #0acf97;
            border: green;
            text-align: center;
            font-size: 15px;
        }

        .tertiary {
            background: #39afd1;
            border: blue;
            text-align: center;
            font-size: 15px;

        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                // timeZone: 'UTC',
                locale: 'es',
                timeZone: 'local',
                height: '545px',
                navLinks: true,

                // aspectRatio: 2,
                initialView: 'timeGridDay',
                headerToolbar: {
                    left: 'prev,next',
                    center: 'title',
                    right: 'timeGridDay,dayGridWeek,dayGridMonth'
                },
                events: '/superhumans_mvc/server/tasks/events.php',
                themeSystem: '',
                views: {
                    timeGridDay: {
                        titleFormat: {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric',
                        },
                        businessHours: {
                            daysOfWeek: [1, 2, 3, 4, 5],
                            startTime: '08:00',
                            endTime: '17:00',
                        },
                        slotMinTime: "06:00:00",
                        slotMaxTime: "18:00:00",
                        scrollTime: "08:00:00",
                    }

                }

            });

            calendar.render();
        });
    </script>
</head>

<body onload="">
    <div class="container-fluid p-0 " id="container-primary">
        <div class="row" style="height: 100%;">
            <div class="col-2 pr-0">
                <?php require_once('../../src/components/navbar/navbar.php'); ?>
            </div>
            <div class="col-10 px-5 pt-3">
                <!-- Button trigger modal -->
                <div class="mb-4">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
                        <i class="fas fa-tasks"></i> Nuevo Evento
                    </button>
                </div>

                <?php require_once('../../src/components/modales/modal-events.php'); ?>

                <div id='calendar'></div>
            </div>
        </div>
    </div>




    <!-- <script src="../../controllers/tasks/events.js"></script> -->
    <script src="../../src/styles/js/style.js"></script>
    <script src="https://kit.fontawesome.com/43fd7ff13a.js" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

    <script>
        let formEvent = document.getElementById('formevent');
        let inputTitle = document.getElementById('title');
        let textError = document.getElementsByClassName('error')[0];
        let startDate = document.getElementById('startDate');
        let endDate = document.getElementById('endDate');
        let inputState = document.getElementById('inputState');
        let radioSi = document.getElementById('gridRadios1');

        let regex = new RegExp("^[a-zA-Z ]+$");

        // radioSi.addEventListener('click', function () {
        //     document.getElementById('startDate').style.display = 'none'; 

        // })

        var f = new Date();
        // if ( startDate <= f ) {
        //     document.write('debe seer fecha igual o mayor a hoy ');
        // }


        formEvent.addEventListener('submit', function(e) {


            if (inputTitle.value === "") {
                textError.innerHTML = ' Requerido';
                textError.style.color = 'red';
                e.preventDefault();

            } else {
                if (!regex.test(inputTitle.value)) {
                    document.getElementsByClassName('error')[0].innerHTML = ' Solo letras y espacios en blanco';
                    document.getElementsByClassName('error')[0].style.color = 'red';
                    e.preventDefault();
                } else {

                }
            }
            if (startDate.value === "") {
                document.getElementsByClassName('error')[1].innerHTML = ' Requerido';
                document.getElementsByClassName('error')[1].style.color = 'red';
                e.preventDefault();

            } else {
                document.getElementsByClassName('error')[1].innerHTML = '';
            }
            if (endDate.value === "") {
                document.getElementsByClassName('error')[2].innerHTML = ' Requerido';
                document.getElementsByClassName('error')[2].style.color = 'red';
                e.preventDefault();
            } else {
                document.getElementsByClassName('error')[2].innerHTML = '';
            }
            if (inputState.value === "") {
                document.getElementsByClassName('error')[3].innerHTML = ' Requerido';
                document.getElementsByClassName('error')[3].style.color = 'red';
                e.preventDefault();
            } else {
                document.getElementsByClassName('error')[3].innerHTML = '';
            }

            var hoy = moment().format();
            var fechaFormulario = startDate.value;
            let newhoy = hoy.slice(0, 10);
            let newFechaFormulario = fechaFormulario.slice(0, 10);


            // Comparamos solo las fechas => no las horas!!
            // hoy.setHours(0, 0, 0, 0); // Lo iniciamos a 00:00 horas
            console.log(newFechaFormulario)
            // console.log(hoy.getFullYear() + "-" + (hoy.getMonth() +1) + "-" + hoy.getDate() )

            console.log(newhoy);

            if (newhoy > fechaFormulario) {
                console.log("Debes elegir una fecha mayor que hoy");
            } else {
                console.log("Fecha a partir de hoy");
            }

        })
    </script>
</body>

</html>