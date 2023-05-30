<section>
    <div class="box">
        <div class="container-fluid">
            <div class="box-header with-border">
            <?php if ($_SESSION['tipo_trabajador'] == "Administrador General") { ?>
                <h1 class="text-center titletablas">HISTORIAL PEDIDOS DELIVERY</h1>
            <?php }else { ?>
                <h1 class="text-center titletablas">PEDIDOS ENTREGADOS</h1>
            <?php }  ?>
            </div>
            <?php if ($_SESSION['tipo_trabajador'] == "Administrador General") { ?>
                <div class="p-4">
                    <select class="custom-select" name="" id="selectsedeAdminPE">
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

            <div class="row justify-content-center pedidos-entregados">
                <div class="table-responsive">
                    <table class="table text-center justify-content-center table-bordered table-light table-hover" id="tbl_pedidosentregados" width="100%" cellspacing="0">
                        <thead class="thead-dark">
                            <tr>
                                <th>id venta</th>
                                <th>Cliente</th>
                                <th>motorizado</th>
                                <th>Estado</th>
                                <th>Tipo De Indidencia</th>
                                <th>Descripcion de Incidencia</th>
                                <th>Fecha de Creacion</th>
                                <th>Detalle</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="modal fade" id="mdlpedidosentregados" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="row">
                                <div class=" col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="row justify-content-end">
                                                <div class="col-3 text-center">
                                                    <h6 class="m-0">Fecha:</h6>
                                                </div>
                                                <div class="col-8 text-center">
                                                    <h6 class="m-0" id="fecha"></h6>
                                                </div>
                                                <div class="col-1">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <ul class="p-0">
                                                <li><b>Cliente:</b></li>
                                                <li id="cliente"></li>
                                                <li><b>Detalle:</b></li>
                                                <li>
                                                    <table class="table-moto m-auto">
                                                        <thead>
                                                            <tr>
                                                                <th>Producto</th>
                                                                <th>Cant.</th>
                                                                <th>P/u</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="pedido_detalle">
                                                        </tbody>
                                                    </table>
                                                    <div class="dropdown-divider"></div>
                                                </li>
                                                <li id="descuento"></li>
                                                <li><b>Cargo:</b></li>
                                                <li id="cargo"></li>
                                                <li><b>Total:</b></li>
                                                <li id="total"></li>
                                                <li><b>Hora de Pedido:</b></li>
                                                <li id="hora_pedido"></li>
                                                <li><b>Hora de Entrega:</b></li>
                                                <li id="hora_entrega"></li>
                                            </ul>
                                            <span class="badge badge-success" id="estado"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>