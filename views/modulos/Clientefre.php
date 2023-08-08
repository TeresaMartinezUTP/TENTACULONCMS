<section>
    <div class="box">
        <div class="container-fluid">
            <!-- <div class="card"> -->
            <div class="box-header with-border">
                <h4 class="box-title titletablas">Lista de Clientes Frecuentes</h4>
            </div>
            <div class="box-body">
            <div style="padding-bottom: 13px;">
            <button type="button" class="btn btn-primary active" data-toggle="modal" data-target="#mdlClientesfre"><i class="fa fa-solid fa-user-plus"></i>&nbsp;&nbsp;Nuevo
                </button>
            </div>
                <div class="table-responsive">
                    <table class="table text-center table-bordered table-light table-hover" id="tblclientefre" width="100%" cellspacing="0">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Nombre Completo</th>
                                <th>Teléfono</th>
                                <th>Correo Electrónico</th>
                                <th>Descuento</th>
                                <th>Local</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <!-- </div> -->
        </div>
    </div>
</section>
<section>
    <div class="modal fade" id="mdlClientesfre" tabindex="-1" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">REGISTRAR CLIENTE FRECUENTE</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="frmRegistroClientefre" method="post">
                    <div class="modal-body">
                        <?php if ($_SESSION['tipo_trabajador'] == "Administrador General") { ?>
                            <label for="">Sede:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                                </div>
                                <select class="form-control js-example-basic-single" id="local_clifre" name="local_clifre" required>
                                    <option value="">Seleccione Sede:</option>
                                    <?php
                                    $tabla = 'local';
                                    $respuesta = localcontroller::ctrListarLocalesActivos($tabla);
                                    foreach ($respuesta as $key => $value) : ?>
                                        <option value="<?php echo $value['id_local']; ?>">
                                            <?php echo $value["sede"]; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <p class="text-danger m-auto">&nbsp;&nbsp;(*)</p>
                            </div>
                        <?php } ?>

                        <label for="">Nombre Completo:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <input type="text" class="form-control" name="nombre_clifre" placeholder="Nombre Completo" pattern="[a-zA-Z0-9!?-\sñÑáéíóúÁÉÍÓÚ]+" autocomplete="off" required>
                            <p class="text-danger m-auto">&nbsp;&nbsp;(*)</p>
                        </div>

                        <label for="">Teléfono:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <input type="number" class="form-control" name="telefono_clifre" placeholder="Teléfono" autocomplete="off" pattern="[0-9]{9}" required>
                            <p class="text-danger m-auto">&nbsp;&nbsp;(*)</p>
                        </div>
                        <label for="">Correo Electrónico:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <input type="email" class="form-control" name="email_clifre" placeholder="Correo Electrónico" autocomplete="off" required>
                            <p class="text-danger m-auto">&nbsp;&nbsp;(*)</p>
                        </div>
                        <label for="">Descuento:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <input type="number" step="any" class="form-control" name="descuento" min="0" placeholder="Descuento" autocomplete="off" required>
                            <p class="text-danger m-auto">&nbsp;&nbsp;(*)</p>
                        </div>
                    </div>
                    <div class=" modal-footer">
                        <button type="reset" class="btn btn-danger btnCancelarModal" data-dismiss="modal" onclick="btncancelLocal()"><i class="fa fa-times"></i>&nbsp;&nbsp;Cancelar</button>
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp;&nbsp;Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="mdlClientesfreUp" tabindex="-1" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">ACTUALIZAR CLIENTE FRECUENTE</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="frmUpClientefre" method="post">
                    <div class="modal-body">
                        <?php if ($_SESSION['tipo_trabajador'] == "Administrador General") { ?>
                            <label for="">Sede:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                                </div>
                                <select class="form-control js-example-basic-single" id="local_clifreEdit" name="local_clifreEdit" required>
                                    <option value="">Seleccione Sede</option>
                                    <?php
                                    $tabla = 'local';
                                    $respuesta = localcontroller::ctrListarLocalesActivos($tabla);
                                    foreach ($respuesta as $key => $value) : ?>
                                        <option value="<?php echo $value['id_local']; ?>">
                                            <?php echo $value["sede"]; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <p class="text-danger m-auto">&nbsp;&nbsp;(*)</p>
                            </div>
                        <?php } ?>
                        <label for="">Nombre Completo:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <input type="hidden" class="form-control" name="id_cliente_frecuenteEdit" id="id_cliente_frecuenteEdit" required>
                            <input type="text" class="form-control" name="nombreEdit" id="nombreEdit" placeholder="Nombre Completo" pattern="[a-zA-Z0-9!?-\sñÑáéíóúÁÉÍÓÚ]+" autocomplete="off" required>
                            <p class="text-danger m-auto">&nbsp;&nbsp;(*)</p>
                        </div>

                        <label for="">Teléfono:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <input type="number" class="form-control" name="telefonoEdit" id="telefonoEdit" placeholder="Teléfono" autocomplete="off" pattern="[0-9]{9}" required>
                            <p class="text-danger m-auto">&nbsp;&nbsp;(*)</p>
                        </div>
                        <label for="">Correo Electrónico:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <input type="email" class="form-control" name="emailEdit" id="emailEdit" placeholder="Correo Electrónico" autocomplete="off" required>
                            <p class="text-danger m-auto">&nbsp;&nbsp;(*)</p>
                        </div>
                        <label for="">Descuento:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <input type="number" step="any" class="form-control" name="descuentoEdit" id="descuentoEdit" min="0" placeholder="Descuento" autocomplete="off" required>
                            <p class="text-danger m-auto">&nbsp;&nbsp;(*)</p>
                        </div>
                        <label for="">Estado:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <select class="form-control" name="estadoEdit" id="estadoEdit" required>
                                <option value="Activo">Activo</option>
                                <option value="Inactivo">Inactivo</option>
                            </select>
                        </div>
                    </div>
                    <div class=" modal-footer">
                        <button type="reset" class="btn btn-danger btnCancelarModal" data-dismiss="modal" onclick="btncancelLocal()"><i class="fa fa-times"></i>&nbsp;&nbsp;Cancelar</button>
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp;&nbsp;Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>