<section>
    <div class="box">
        <div class="container-fluid">
            <!-- <div class="card"> -->
            <div class="box-header with-border">
                <h4 class="box-title titletablas">Lista de Mesas por Local</h4>
            </div>
            <div class="box-body">
            <div style="padding-bottom: 13px;">
            <button type="button" class="btn btn-primary active" data-toggle="modal" data-target="#mdlLocalMesa"><i class="fa fa-solid fa-plus"></i>&nbsp;&nbsp;Nuevo</button></div>
                <div class="table-responsive">
                    <table class="table text-center table-bordered table-light table-hover" id="tableLocalMesas" width="100%" cellspacing="0">
                        <thead class="thead-dark">
                            <tr>                            
                            <th>Nombre Mesa</th>
                            <th>Sede</th>
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
<!--REGISTRO MESA-->
<div class="modal fade" id="mdlLocalMesa" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header text-uppercase">
                <h5 class="modal-title" id="exampleModalLabel">Registro Mesa Local</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="frmRegistroLocalMesa" method="post">
                <div class="modal-body">
                    <div class="input-group mb-3 hiddensede" <?php if($_SESSION['tipo_trabajador']=="Administrador"){
                            echo 'hidden';
                        }?>>
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-check"></i></span>
                        </div>
                        <select class="form-control js-example-basic-single" id="item_local" name="item_local" required>
                            <option  value="" selected>Seleccione Local</option>
                            <?php
                            $respuesta = LocalController::ctrListarLocalesActivos("local");
                            foreach ($respuesta as $key => $value) :
                            ?>
                                <option value="<?php echo $value['id_local'] ?>"><?php echo $value['sede'] ?>  <?php echo $value["direccion"]; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <p class="text-danger m-auto">(*)</p>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-check"></i></span>
                        </div>
                        <input type="text" class="form-control" id="nom_mesa" name="nom_mesa" placeholder="Nombre de la mesa" autocomplete="off" pattern="[0-9A-Za-z#()$&'\sñÑáéíóúÁÉÍÓÚ.-]+" required>
                        <p class="text-danger m-auto">(*)</p>
                    </div>
                    <p class="text-danger">Datos requeridos <span class="badge badge-light text-danger">(*)</span></p>
                </div>
                <div class=" modal-footer ">
                    <button type="reset" class="btn btn-danger btnCancelarModal" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;&nbsp;Cancelar</button>
                    <button type="submit" class="btn btn-success" onclick="Seleccionarsede('<?php echo $_SESSION['tipo_trabajador']?>',<?php echo $_SESSION['id_local']?>,'item_local')"><i class="fa fa-save"></i>&nbsp;&nbsp;Registrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--ACTUALIZAR MESA-->
<div class="modal fade" id="mdlActualizarLocalMesa" data-backdrop="static" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ACTUALIZAR MESA LOCAL</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="frmActualizarLocalMesa" method="post">
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="idLocalMesa" name="idLocalMesa" placeholder="ID" required>
                    <div class="input-group mb-3 hiddensede" <?php if($_SESSION['tipo_trabajador']=="Administrador"){
                            echo 'hidden';
                        }?>>
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-check"></i></span>
                        </div>
                        <select class="form-control js-example-basic-single" id="item_localEditar" name="item_localEditar" required>
                            <option selected>Seleccione Local</option>
                            <?php
                            $respuesta = LocalController::ctrListarLocalesActivos("local");
                            foreach ($respuesta as $key => $value) :
                            ?>
                                <option value="<?php echo $value['id_local'] ?>"><?php echo $value['sede'] ?>
                                    <?php echo $value['direccion'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <p class="text-danger m-auto">(*)</p>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-check"></i></span>
                        </div>
                        <input type="text" class="form-control" id="nom_mesaEditar" name="nom_mesaEditar" placeholder="Nombre de la mesa" autocomplete="off" pattern="[0-9A-Za-z#()$&'\sñÑáéíóúÁÉÍÓÚ.-]+" required>  
                        <p class="text-danger m-auto">(*)</p>                      
                    </div>
                    <label for="">Estado:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <select class="form-control" id="estadoMesa" name="estadoMesa">
                                <option value="Activo" selected>Activo</option>
                                <option value="Inactivo" selected>Inactivo</option>
                                <option value="Reservado" selected>Reservado</option>
                                <option value="Ocupado" selected>Ocupado</option>
                            </select>
                        </div>
                </div>

                <div class="modal-footer">
                    <button type="reset" class="btn btn-danger btnCancelarModal" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;&nbsp;Cancelar</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>