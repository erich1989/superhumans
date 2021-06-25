<!-- Modal -->
<div class="modal fade" id="staticBackdropTeacher" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Nuevo facilitador</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../../server/training/new-teacher.php" class="p-4" method="POST" id="formteacher">
                    <div class="form-group">
                        <label for="firstName">Nombres</label><span class="error" id="errorfirstname"></span>
                        <input type="text" class="form-control" id="firstName" name="firstname">
                    </div>
                    <div class="form-group">
                        <label for="lastName">Apellidos</label><span class="error" id="errorlastname"></span>
                        <input type="text" class="form-control" id="lastName" name="lastname">
                    </div>
                    <div class="form-group">
                        <label for="cc">C.C</label><span class="error" id="errorcc"></span>
                        <input type="text" class="form-control" id="cc" name="cc">
                    </div>
                    <div class="form-group">
                        <label for="profession">Profesion</label><span class="error" id="errorprofession"></span>
                        <input type="text" class="form-control" id="profession" name="profession">
                    </div>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" data-target="#staticBackdropTeacher" id="button-event">Guardar</button>

                </form>
            </div>

        </div>
    </div>
</div>

<script>
    let $formTeacher = document.getElementById('formteacher');

    let $inputFirstName = document.getElementById('firstName');
    let $inputLastName = document.getElementById('lastName');
    let $inputCc = document.getElementById('cc');
    let $inputProfession = document.getElementById('profession');

    let $errorFirstName = document.getElementById('errorfirstname');
    let $errorLastName = document.getElementById('errorlastname');
    let $errorCc = document.getElementById('errorcc');
    let $errorProfession = document.getElementById('errorprofession');

    $formTeacher.addEventListener('submit', function(e) {

        if($inputFirstName.value === "") {
            $errorFirstName.innerHTML = " Requerido";
            e.preventDefault();
        }else{
            $errorFirstName.innerHTML = "";
        }
        if($inputLastName.value === "") {
            $errorLastName.innerHTML = " Requerido";
            e.preventDefault();
        }else{
            $errorLastName.innerHTML = "";
        }
        if($inputCc.value === "") {
            $errorCc.innerHTML = " Requerido";
            e.preventDefault();
        }else{
            $errorCc.innerHTML = "";
        }
        if($inputProfession.value === ""){
            $errorProfession.innerHTML = " Requerido";
            e.preventDefault();
        }else{
            $errorProfession.innerHTML = "";
        }

        if($inputFirstName.value.length > 0 && $inputLastName.value.length > 0 && $inputCc.value.length > 0 && $inputProfession.value.length > 0) {
            alert("Está seguro de ingresar el nuevo nombre");
        }

    })
</script>