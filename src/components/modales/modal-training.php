<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Nueva capacitación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../../server/training/new-training.php" class="p-4" method="POST" id="formtraining">

                    <div class="form-group">
                        <label for="titletraining">Titilo</label><span class="error" id="errortitle"></span>
                        <input type="text" class="form-control" id="titletraining" name="titleevent">
                    </div>
            
                    <div class="form-group">
                        <label for="typetraining">Tipo</label><span class="error" id="errortype"></span>
                        <select id="typetraining" class="form-control" name="type">
                            <option value="">Selecciona...</option>
                            <option value="blanda">Competencia blanda</option>
                            <option value="tecnica">Competencia técnica</option>
                        </select>
                    </div>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" data-target="#staticBackdrop" id="button-event">Guardar</button>

                </form>
            </div>

        </div>
    </div>
</div>

<script>
    let $formTraining = document.getElementById('formtraining');
    let $inputTitle = document.getElementById('titletraining');
    let $inputType = document.getElementById('typetraining');

    let $errorTitle = document.getElementById('errortitle');
    let $errorType = document.getElementById('errortype');

    $formTraining.addEventListener('submit', function(e) {

        console.log("hola")
        if ($inputTitle.value === "") {
            $errorTitle.innerHTML = " Requerido";
            e.preventDefault();
        } else {
            $errorTitle.innerHTML = "";
        }
   
        if ($inputType.value === "") {
            $errorType.innerHTML = " Requerido";
            e.preventDefault();
        } else {
            $errorType.innerHTML = "";
        }


        if ($inputTitle.value.length > 0 && $inputType.value.length > 0) {
            alert('Quieres ingresar la capacitación?');
        }
    })
</script>