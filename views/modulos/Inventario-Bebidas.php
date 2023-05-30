<section>
    <div class="box">
        <div class="container-fluid">
            <div class="box-header with-border">
                <h4 class="box-title titletablas">Lista de Inventario bebidas</h4>
            </div>
            <div class="box-body">
                <div style="padding-bottom: 13px;">
                    <button type="button" class="btn btn-primary active" data-toggle="modal" data-target="#mdlBebidaInventario">
                    <i class="fa fa-solid fa-plus"></i>&nbsp;&nbsp;Nuevo
                    </button>
                </div>

                <select class="form-group w-25" name="" id="desplegarsede">
                    <option value="" selected>---Todas las sedes---</option>
                    <?php
                    $respuesta = localcontroller::ctrListarLocalesActivos("local");
                    foreach ($respuesta as $key => $value) : ?>
                        <option value="<?php echo $value['sede']; ?>">
                            <?php echo $value["sede"]; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <div class="table-responsive">
                    <table class="table text-center table-bordered table-light table-hover" id="tbl_inventariobebidas" width="100%" cellspacing="0">
                        <thead class="thead-dark">
                            <tr>
                                <th>Bebida</th>
                                <th>Stock Total</th>
                                <th>Sede</th>
                                <th>Estado stock</th>
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
<button type="button" class="btn btn-primary active mdi" data-toggle="modal" data-target="#mdlListaActualizarStock">Ver Historial</button>
<section>
<div class="modal fade" id="mdlListaActualizarStock" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Módulo bebidas al stock</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card mb-4">
                        <div class="card-header"><i class="fa fa-table mr-1"></i> Historial de bebida agregados al stock</div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table text-center table-bordered table-light table-hover" id="tableBebidaInventario" width="100%" cellspacing="0">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Sede</th>
                                            <th>Bebida</th>
                                            <th>Stock</th>
                                            <th>Fecha Registro</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="box-footer"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="modal fade" id="mdlBebidaInventario" tabindex="-1" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registro Bebida Local</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="frmRegistroBebidaInventario" method="post">
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-check"></i></span>
                            </div>
                            <select class="form-control Select2" name="" id="localAdmGnr" required>
                                <option value="" selected>Seleccione Sede</option>
                                <?php
                                $respuesta = localcontroller::ctrListarLocalesActivos("local");
                                foreach ($respuesta as $key => $value) : ?>
                                    <option value="<?php echo $value['sede']; ?>">
                                        <?php echo $value["sede"]; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <p class="text-danger m-auto">(*)</p>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-check"></i></span>
                            </div>
                            <select class="form-control Select2" id="listarBebida" name="listarBebida" required>
                                <option value="" selected>Seleccione Bebida</option>
                            </select>
                            <p class="text-danger m-auto">(*)</p>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-check"></i></span>
                            </div>
                            <input type="number" class="form-control" id="stock" name="stock" placeholder="Ingrese Stock" required>
                            <p class="text-danger m-auto">(*)</p>
                        </div>
                        <p class="text-danger">Datos requeridos <span class="badge badge-light text-danger">(*)</span></p>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-danger btnCancelarModal" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="modal fade" id="mdlActualizarBebidaInventario" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header text-uppercase">
                    <h5 class="modal-title" id="exampleModalLabel">Actualizar Bebida Local Inventario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="frmActualizarbebidaInventario" method="post">
                    <div class="modal-body">
                        <input type="hidden" class="form-control" id="id_blEditar" name="id_blEditar" placeholder="ID" required>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-check"></i></span>
                            </div>
                            <select class="form-control Select2" name="listarSedeEditar" id="listarSedeEditar" required>
                                <option value="" selected>Seleccione Sede</option>
                                <?php
                                $respuesta = localcontroller::ctrListarLocalesActivos("local");
                                foreach ($respuesta as $key => $value) : ?>
                                    <option value="<?php echo $value['sede']; ?>">
                                        <?php echo $value["sede"]; ?> || <?php echo $value["direccion"]; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-check"></i></span>
                            </div>
                            <select class="form-control Select2" id="listarBebidaEditar" name="listarBebidaEditar" required>
                                <option value="">Seleccione Bebida</option>
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-check"></i></span>
                            </div>
                            <input type="text" class="form-control" id="stockEditar" name="stockEditar" placeholder="Ingrese Stock" required>
                        </div>
                    </div>
                    <div class="modal-footer ">
                        <button type="reset" class="btn btn-danger" data-dismiss="modal" onclick="btncancelInvBebidas()"><i class="fa fa-times"></i> Cancelar</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>