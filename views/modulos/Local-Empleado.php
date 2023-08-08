<section>
    <div class="box">
        <div class="container-fluid">
            <div class="box-header with-border">
                <h4 class="box-title titletablas">Lista de Empleados por Local</h4>
            </div>
            <div class="box-body">
            <div style="padding-bottom: 13px;">
                <button type="button" class="btn btn-primary active" data-toggle="modal" data-target="#mdlLocalEmpleado">
                <i class="fa fa-solid fa-plus"></i>&nbsp;&nbsp;Registrar
                </button>
            </div>
                <div class="table-responsive">
                    <table class="table text-center table-bordered table-light table-hover" id="tbl_localempleado" width="100%" cellspacing="0">
                        <thead class="thead-dark">
                            <tr>                                
                                <th>Sede</th>
                                <th>Empleado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="modal fade" id="mdlLocalEmpleado" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header text-uppercase">
                    <h5 class="modal-title" id="exampleModalLabel">Registro empleado por local</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="frmRegistroLocalEmpleado" method="post">
                    <div class="modal-body">
                        <div class="input-group mb-3 hiddensede" <?php if($_SESSION['tipo_trabajador']=="Administrador"){
                            echo 'hidden';
                        }?>>
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <select class="form-control js-example-basic-single" id="listarLocal" name="listarLocal" required>
                                <option value="" selected>Seleccionar Local</option>
                                <?php
                                $respuesta = localcontroller::ctrListarLocalesActivos("local");
                                foreach ($respuesta as $key => $value) : ?>
                                    <option value="<?php echo $value['id_local']; ?>">
                                        <?php echo $value["sede"]; ?> <?php echo $value["direccion"]; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <p class="text-danger m-auto">&nbsp;&nbsp;(*)</p>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <select class="form-control js-example-basic-single" id="listarEmpleado" name="listarEmpleado" required>
                                <option value="" selected>Seleccionar Empleado </option>
                                <?php
                                $tabla='empleado';
                                $respuesta = empleadoscontroller::ctrListarEmpleadosActivos($tabla);
                                foreach ($respuesta as $key => $value) : ?>
                                    <option value="<?php echo $value['id_empleado']; ?>">
                                        <?php echo $value["nombres"]; ?> || <?php echo $value["area"]; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <p class="text-danger m-auto">&nbsp;&nbsp;(*)</p>
                        </div>
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
<section>
    <div class="modal fade" id="mdlActualizarLocalEmpleado" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header text-uppercase">
                    <h5 class="modal-title" id="exampleModalLabel">Actualizar empleado por local</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="frmActualizarLocalEmpleado" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="id_localempleadoED" id="id_localempleadoED">
                        <div class="input-group mb-3 hiddensede" <?php if($_SESSION['tipo_trabajador']=="Administrador"){
                            echo 'hidden';
                        }?>>
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <select class="form-control js-example-basic-single" id="id_localED" name="id_localED" required>
                                <option value="" selected>Seleccionar Local</option>
                                <?php
                                $respuesta = localcontroller::ctrListarLocalesActivos("local");
                                foreach ($respuesta as $key => $value) : ?>
                                    <option value="<?php echo $value['id_local']; ?>">
                                        <?php echo $value["sede"]; ?> <?php echo $value["direccion"]; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <p class="text-danger m-auto">&nbsp;&nbsp;(*)</p>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <select class="form-control js-example-basic-single" id="id_empleadoED" name="id_empleadoED" required>
                                <option value="" selected>Seleccionar Empleado </option>
                                <?php
                                $tabla='empleado';
                                $respuesta = empleadoscontroller::ctrListarEmpleadosActivos($tabla);
                                foreach ($respuesta as $key => $value) : ?>
                                    <option value="<?php echo $value['id_empleado']; ?>">
                                    <?php echo $value["nombres"]; ?> || <?php echo $value["area"]; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <p class="text-danger m-auto">&nbsp;&nbsp;(*)</p>
                        </div>
                    </div>
                    <div class=" modal-footer ">
                        <button type="reset" class="btn btn-danger btnCancelarModal" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;&nbsp;Cancelar</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>