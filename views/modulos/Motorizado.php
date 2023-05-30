<div>
    <h1 class="text-center titletablas" style="font-family: auto;">Pedidos Delivery en Curso</h1>

    <?php if ($_SESSION['tipo_trabajador'] == "Administrador General") { ?>
                <div class="p-4">
                    <select class="custom-select" name="" id="selectsedeAdminM">
                    <option value=""  selected>---Todas las sedes---</option>
                    <?php
                    $respuesta = localcontroller::ctrListarLocalesActivos("local");
                    foreach ($respuesta as $key => $value) : ?>
                        <option value="<?php echo $value['id_local']; ?>">
                            <?php echo $value["sede"]; ?>
                        </option>
                    <?php endforeach; ?>
                    </select>
            </div>
            <?php } ?>
</div>

<div class="row moto" id="divCardsM">

</div>

<div class="modal fade" id="mdlIncidencia" tabindex="-1" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-uppercase">
                <h5 class="modal-title" id="exampleModalLabel">Registro de Incidencia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="frmIncidencia">
                <div class="modal-body">
                    <input type="hidden" name="id_ventaF" id="hddid_venta"/>
                    <input type="hidden" name="id_p_motorizado" id="hddid"/>
                    <input type="hidden" name="estado" id="hddestado"/>
                    <div class="input-group mb-3">
                        <select class="form-control mr-3" id="select-incidencia" name="id_incidencia">
                            <option  value="" selected disabled>Seleccione Incidencia</option>
                                <?php
                                $respuesta = incidenciacontroller::ctrListarIncidencias();
                                foreach ($respuesta as $key => $value) :
                                ?>
                                    <option value="<?php echo $value['id_incidencia'] ?>"><?php echo $value['descripcion'] ?></option>
                                <?php endforeach; ?>
                        </select>
                        <p class="text-info m-auto">(*)</p>
                    </div>
                    <div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="mdi mdi-check"></i></span>
                            </div>
                            <textarea id="txtDescripcion" name="descripcion" type="text" class="form-control mr-3" placeholder="Descripción" pattern="[0-9A-Za-z#()$&/'.-°\sñÑáéíóúÁÉÍÓÚ]+" autocomplete="off"></Textarea>
                            <p class="text-info m-auto">(*)</p>
                        </div>
                        <p class="text-info">Opcional <span class="badge badge-light text-info">(*)</span></p>
                    </div>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-danger btnCancelarModal" data-dismiss="modal"><i class="mdi mdi-close"></i> Cancelar</button>
                    <button type="submit" class="btn btn-success"> <i class="mdi mdi-content-save"> </i> Registrar</button>
                </div>
        </div>
        </form>
    </div>
</div>
</div>