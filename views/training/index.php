<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            /* background-color: #fa5c7c;
            border: red; */
            /* color: #fa5c7c !important; */
            text-align: center;
            font-size: 15px;
        }
    </style>


</head>

<body>
    <div class="container-fluid p-0 " id="container-primary">
        <div class="row" style="height: 100%;">
            <div class="col-2 pr-0">
                <?php require_once('../../src/components/navbar/navbar.php'); ?>
            </div>
            <div class="col-10 px-3 pt-3">
                <!-- Button trigger modal -->
                <div class="mb-4">
                    <a href="new-learning-method.php" class="btn btn-primary"><i class="fas fa-tasks"></i> Nueva Capacitación</a>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-4">
                            <div id='calendarListYear'></div>
                        </div>
                        <div class="col-8">
                            <div id='calendarMonth'></div>
                        </div>
                        <form action="../../views/training/select-event-view.php" method="POST" id="formularioIdEvento">
                            <input type="hidden" id="titleTraining" name="titletraining">
                            <input type="hidden" id="startTraining" name="starttraining">
                            <input type="hidden" id="endTraining" name="endtraining">
                
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendarListYear');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'listYear',
                    locale: 'es',
                    timeZone: 'local',
                    height: '520px',
                    navLinks: true,
                    events: '/superhumans_mvc/server/tasks/all-training-events.php',
                    headerToolbar: {
                        left: 'title',
                        center: '',
                        right: ''
                    },

                });
                calendar.render();
            });
            document.addEventListener('DOMContentLoaded', function(e) {
                var calendarEl = document.getElementById('calendarMonth');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    locale: 'es',
                    timeZone: 'local',
                    height: '520px',
                    // navLinks: true,
                    events: '/superhumans_mvc/server/tasks/all-training-events.php',

                    eventClick: function(info) {

                        const title = info.event.title;
                        const start = info.event.start;
                        const end = info.event.end;

                        function newTimeFormat($oldDate) {

                            $age = $oldDate.getFullYear();
                            $month = $oldDate.getMonth() + 1;
                            $day = $oldDate.getDate();
                            $hours = $oldDate.getHours();
                            $minutes = $oldDate.getMinutes();
                            $seconds = $oldDate.getSeconds();

                            return `${$age}-${$month}-${$day} ${$hours}:${$minutes}:${$seconds}`;
                        }
                        $newStart = newTimeFormat(start);
                        $newEnd = newTimeFormat(end);
                        
                        console.log($newStart+'fecha de inicio');
                        console.log($newEnd+'fecha de fin');

                        const formIdEvent = document.getElementById('formularioIdEvento');
                        const titleTraining = document.getElementById('titleTraining');
                        const startTraining = document.getElementById('startTraining');
                        const endTraining = document.getElementById('endTraining');

                        titleTraining.setAttribute('value', title);
                        startTraining.setAttribute('value', $newStart);
                        endTraining.setAttribute('value', $newEnd);

                        formIdEvent.submit();
                    },
                    headerToolbar: {
                        left: '',
                        center: 'title',
                        right: 'prev,next'
                    },

                });
                calendar.render();
            });
        </script>

        <script src="../../src/styles/js/style.js"></script>
        <script src="https://kit.fontawesome.com/43fd7ff13a.js" crossorigin="anonymous"></script>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>

</html>