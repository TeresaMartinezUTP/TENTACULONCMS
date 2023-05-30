<section>
    <div class="box">
        <div class="container-fluid">
            <div class="box-header with-border">
                <h4 class="box-title titletablas">Lista de Platos por Local</h4>
            </div>

            <div class="box-body">
            <div style="padding-bottom: 13px;">
                <button type="button" class="btn btn-primary active" data-toggle="modal" data-target="#mdllocalplatos">
                <i class="fa fa-solid fa-plus"></i>&nbsp;&nbsp;Nuevo
                </button>
            </div>
                <div class="table-responsive">
                    <table class="table text-center table-bordered table-light table-hover" id="tbl_localplatos" width="100%" cellspacing="0">
                        <thead class="thead-dark">
                            <tr>
                                <th>Sede</th>
                                <th>Plato</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- Registro Plato Local -->
<section>
    <div class="modal fade" id="mdllocalplatos" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header text-uppercase">
                    <h5 class="modal-title" id="exampleModalLabel">Registro platos por local</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="frmRegistroLocalPlatos" method="post">
                    <div class="modal-body">
                        <div class="input-group mb-3 hiddensede" <?php if($_SESSION['tipo_trabajador']=="Administrador"){
                            echo 'hidden';
                        }?>>
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <select class="form-control js-example-basic-single" id="listarLocal" name="listarLocal" required>
                                <option value="" selected disabled>Seleccionar Local</option>
                                <?php
                                $respuesta = localcontroller::ctrListarLocalesActivos("local");
                                foreach ($respuesta as $key => $value) : ?>
                                    <option value="<?php echo $value['id_local']; ?>">
                                        <?php echo $value["sede"]; ?>  <?php echo $value["direccion"]; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <p class="text-danger m-auto">(*)</p>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <select class="form-control js-example-basic-single" id="listarPlato" name="listarPlato" required>
                                <option value="" selected>Seleccione Plato </option>
                                <?php
                                $respuesta = platoscontroller::ctrListarPlatosActivos("platos");
                                foreach ($respuesta as $key => $value) : ?>
                                    <option value="<?php echo $value['id_plato']; ?>">
                                        <?php echo $value["nombre_plato"]; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <p class="text-danger m-auto">(*)</p>
                        </div>
                        <p class="text-danger">Datos requeridos <span class="badge badge-light text-danger">(*)</span></p>
                    </div>
                    <div class=" modal-footer ">
                        <button type="reset" class="btn btn-danger btnCancelarModal" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;&nbsp;Cancelar</button>
                        <button type="submit" class="btn btn-success" onclick="Seleccionarsede('<?php echo $_SESSION['tipo_trabajador']?>',<?php echo $_SESSION['id_local']?>,'listarLocal')"><i class="fa fa-save"></i>&nbsp;&nbsp;Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- Actualizar Plato Local -->
<section>
    <div class="modal fade" id="mdlActualizarLocalPlato" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header text-uppercase">
                    <h5 class="modal-title" id="exampleModalLabel">Actualizar Plato por Local</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="frmActualizarLocalPlato" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="id_plEditar" id="id_plEditar">
                        <div class="input-group mb-3 hiddensede" <?php if($_SESSION['tipo_trabajador']=="Administrador"){
                            echo 'hidden';
                        }?>>
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <select class="form-control js-example-basic-single" id="listarLocalED" name="listarLocalED" required>
                                <option value="" selected>Seleccionar Local</option>
                                <?php
                                $respuesta = localcontroller::ctrListarLocalesActivos("local");
                                foreach ($respuesta as $key => $value) : ?>
                                    <option value="<?php echo $value['id_local']; ?>">
                                        <?php echo $value["sede"]; ?>  <?php echo $value["direccion"]; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <p class="text-danger m-auto">(*)</p>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <select class="form-control js-example-basic-single" id="listarPlatoED" name="listarPlatoED" required>
                                <option value="" selected>Seleccione Plato </option>
                                <?php
                                $respuesta = platoscontroller::ctrListarPlatosActivos("platos");
                                foreach ($respuesta as $key => $value) : ?>
                                    <option value="<?php echo $value['id_plato']; ?>">
                                        <?php echo $value["nombre_plato"]; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <p class="text-danger m-auto">(*)</p>
                        </div>
                        <label for="">Status:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <select class="form-control" id="estadoED" name="estadoED">
                                <option value="Activo" selected>Activo</option>
                                <option value="Inactivo" selected>Inactivo</option>
                            </select>
                        </div>
                    </div>
                    <div class=" modal-footer ">
                        <button type="reset" class="btn btn-danger btnCancelarModal" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;&nbsp;Cancelar</button>
                        <button type="submit" class="btn btn-success"></i>&nbsp;&nbsp;Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>