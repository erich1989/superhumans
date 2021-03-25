<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Nuevo evento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="p-2" method="POST" id="formevent">

                    <div class="form-group">
                        <label for="title">Titilo</label><span class="error"></span>
                        <input type="text" class="form-control" id="title" name="titleevent">
                    </div>

                    <fieldset class="form-group">
                        <div class="row">
                            <legend class="col-form-label col-sm-3 pt-0">Todo el dia</legend>
                            <div class="col-sm-9">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="1">
                                    <label class="form-check-label" for="gridRadios1">
                                        SI
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="0" checked>
                                    <label class="form-check-label" for="gridRadios2">
                                        NO
                                    </label>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <div class="form-group">
                        <label for="startDate">Fecha de inicio</label><span class="error"></span>
                        <input type="datetime-local" class="form-control" name="startDate" id="startDate" placeholder="1234 Main St" >
                    </div>
                    <div class="form-group">
                        <label for="endDate">Fecha de fin</label><span class="error"></span>
                        <input type="datetime-local" class="form-control" name="endDate" id="endDate" placeholder="Apartment, studio, or floor">
                    </div>

                    <div class="form-group">
                        <label for="inputState">Prioridad</label><span class="error"></span>
                        <select id="inputState" class="form-control" name="className">
                            <option value="">Selecciona...</option>
                            <option value="primary">Primario</option>
                            <option value="secondary">Segundario</option>
                            <option value="tertiary">Terciario</option>
                        </select>
                    </div>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" data-target="#staticBackdrop" id="button-event">Guardar</button>

                </form>
            </div>

        </div>
    </div>
</div>

