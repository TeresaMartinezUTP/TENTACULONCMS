<section>
    <div class="box">
        <div class="container-fluid">
            <div class="box-header with-border">
                <h4 class="box-title titletablas">Lista de Bebidas por Local</h4>
            </div>

            <div class="box-body">
            <div style="padding-bottom: 13px;">
                <button type="button" class="btn btn-primary active" data-toggle="modal" data-target="#mdlLocalBebida">
                <i class="fa fa-solid fa-plus"></i>&nbsp;&nbsp;Nuevo
                </button>
            </div>
                <div class="table-responsive">
                    <table class="table text-center table-bordered table-light table-hover" id="tbl_localbebidas" width="100%" cellspacing="0">
                        <thead class="thead-dark">
                            <tr>                                
                                <th>Sede</th>
                                <th>Bebida</th>
                                <th>Status</th>
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
    <div class="modal fade" id="mdlLocalBebida" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header text-uppercase">
                    <h5 class="modal-title" id="exampleModalLabel">Registro bebida por local</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="frmRegistroLocalBebida" method="post">
                    <div class="modal-body">
                        <div class="input-group mb-3 hiddensede" <?php if($_SESSION['tipo_trabajador']=="Administrador"){
                            echo 'hidden';
                        }?>>
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <select class="form-control selectFrm" id="listarLocal" name="listarLocal" required>
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
                            <select class="form-control selectFrm" id="listarBebida" name="listarBebida" required>
                                <option value="" selected>Seleccione Bebida </option>
                                <?php
                                $respuesta = bebidascontroller::ctrListarBebidaActivas("bebidas");
                                foreach ($respuesta as $key => $value) : ?>
                                    <option value="<?php echo $value['id_bebida']; ?>">
                                        <?php echo $value["marca"]; ?>  <?php echo $value["descripcion"]; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <p class="text-danger m-auto">(*)</p>
                        </div>
                        <p class="text-danger">Datos requeridos <span class="badge badge-light text-danger">(*)</span></p>
                    </div>
                    <div class=" modal-footer ">
                        <button type="reset" class="btn btn-danger btnCancelarModal" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;&nbsp;Cancelar</button>
                        <button type="submit" class="btn btn-success"  onclick="Seleccionarsede('<?php echo $_SESSION['tipo_trabajador']?>',<?php echo $_SESSION['id_local']?>,'listarLocal')"><i class="fa fa-save"></i>&nbsp;&nbsp;Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="modal fade" id="mdlActualizarLocalBebida" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header text-uppercase">
                    <h5 class="modal-title" id="exampleModalLabel">Actualizar bebida por Local</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="frmActualizarLocalBebida" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="idLocalbebida" id="idLocalbebida">
                        <div class="input-group mb-3 hiddensede" <?php if($_SESSION['tipo_trabajador']=="Administrador"){
                            echo 'hidden';
                        }?>>
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <select class="form-control selectFrm" id="listarLocalED" name="listarLocalED" required>
                                <option value="" selected>Seleccionar Local</option>
                                <?php
                                $respuesta = localcontroller::ctrListarLocalesActivos("local");
                                foreach ($respuesta as $key => $value) : ?>
                                    <option value="<?php echo $value['id_local']; ?>">
                                        <?php echo $value["sede"]; ?> || <?php echo $value["direccion"]; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <p class="text-danger m-auto">(*)</p>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <select class="form-control selectFrm" id="listarBebidaED" name="listarBebidaED" required>
                                <option value="" selected>Seleccione Bebida </option>
                                <?php
                                $respuesta = bebidascontroller::ctrListarBebidaActivas("bebidas");
                                foreach ($respuesta as $key => $value) : ?>
                                    <option value="<?php echo $value['id_bebida']; ?>">
                                        <?php echo $value["marca"]; ?> || <?php echo $value["descripcion"]; ?>
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
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp;&nbsp;Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>