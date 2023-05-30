<section>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="atenciones">
            <a class="nav-link active" id="Presencial-tab" data-toggle="tab" href="#Presencial" role="tab" aria-controls="Presencial" aria-selected="true">Presencial</a>
        </li>
        <li class="nav-item" role="atenciones">
            <a class="nav-link" id="Delivery-tab" data-toggle="tab" href="#Delivery" role="tab" aria-controls="Delivery" aria-selected="false">Delivery</a>
        </li>
        <li class="nav-item" role="atenciones">
            <a class="nav-link" id="Recojo-tab" data-toggle="tab" href="#Recojo" role="tab" aria-controls="Recojo" aria-selected="false">Recojo</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <!-- PRESENCIAL -->
        <div class="tab-pane fade show active" id="Presencial" role="tabpanel" aria-labelledby="Presencial-tab">
            <!-- TABLA -->
            <section class="py-5">
                <div class="box">
                    <div class="container-fluid">
                        <!-- <div class="card"> -->
                        <div class="box-header with-border">
                            <h4 class="box-title">Atenciones en curso</h4>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table text-center table-bordered table-light table-hover" id="tblupcaja" width="100%" cellspacing="0">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Mesa</th>
                                            <th>Fecha</th>
                                            <th>Prioridad</th>
                                            <th>Pendientes</th>
                                            <th>Modificar</th>
                                            <th>Pagar por partes</th>
                                            <th>Finalizar</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <!-- </div> -->
                    </div>
                </div>
            </section>
            <!-- MODIFICAR ORDEN -->
            <section>
                <div class="modal fade" id="mdlupcaja" tabindex="-1" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" style="max-width: 1500px;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Actualizar</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <div id="avisoppk">
                                    
                                </div>
                                <section class="content">
                                    <div class="row">
                                        <div class="col-lg-5 px-0 order-lg-1 order-2">
                                            <div class="card mb-4">
                                                <div class="card-header">
                                                    <form id="frmupdateventa" method="post">
                                                        <div class="row g-3 card-M p-2">
                                                            <div class="card-body d-flex p-0" style="align-items: center;">
                                                                <div class="card-title card-title-caja p-0 m-0 w-100">
                                                                    <h3 class="m-0">Modificar Orden</h3>
                                                                </div>
                                                                <div class="card-tools">
                                                                    <button type="button" class="btn btn-tool" id="btn-caja-collapse" data-toggle="collapse" href="#caja-datosP" aria-expanded="false"><i id="icon-caja-collapse" class="fas fa-solid fa-plus" style="color:black;"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 row collapse py-3" id=caja-datosP>
                                                                <div class="col-6">
                                                                    <div class="input-group justify-content-start">
                                                                        <div class="input-group mb-3">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                                                                            </div>
                                                                            <input class="form-control" id="id_mesaventaEditm" name="id_mesaventaEditm" disabled>
                                                                            <input type="hidden" class="form-control" id="id_mesaventaEdit" name="id_mesaventaEdit">
                                                                            <input type="hidden" class="form-control" id="id_ventaediting" name="id_ventaediting">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="input-group justify-content-start">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                                                                        </div>
                                                                        <select class="form-control js-example-basic-single selectCF" id="id_clifreventaEdit" name="id_clifreventaEdit">
                                                                            <option value="0">Seleccione Cliente Frecuente</option>
                                                                            <?php
                                                                            $tabla = 'clientes_frecuentes';
                                                                            $respuesta =  clientefreControlador::ctrListarTablaClienFrecuentexSede($tabla, $_SESSION['id_local']);
                                                                            foreach ($respuesta as $key => $value) : ?>
                                                                                <option value="<?php echo $value['id_cliente_frecuente']; ?>">
                                                                                    <?php echo $value["nombre_completo"]; ?>
                                                                                </option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6 pt-3">
                                                                    <div class="input-group justify-content-start">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                                                                        </div>
                                                                        <select class="form-control selectP" id="prioridadEdit" name="prioridad">
                                                                            <option selected value="Normal">Normal</option>
                                                                            <option value="Preferencial">Preferencial</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>

                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="table-responsive">
                                                                    <table class="table text-center table-bordered table-light table-hover" id='ListarCajaedit' width="100%" cellspacing="0">
                                                                        <thead class="thead-dark">
                                                                            <tr>
                                                                                <th>Descripcion</th>
                                                                                <th>Precio</th>
                                                                                <th style="table-layout: fixed; width: 300px;">Cantidad</th>
                                                                                <th>Total</th>
                                                                                <th>Eliminar</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="container">
                                                                <table class="table table-striped">
                                                                    <thead>
                                                                        <tr>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>SubTotal</td>
                                                                            <td><input class="form-control subtotalcaja" id="subttlcajaEdit" disabled></td>
                                                                            <td>Soles</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Descuento</td>
                                                                            <td><input class="form-control descuentocaja" id="desccajaEdit" value="0.00" disabled></td>
                                                                            <td>Soles</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Total</td>
                                                                            <td><input class="form-control totalcaja" id="ttlcajaEdit" disabled></td>
                                                                            <td>Soles</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Monto Pagado</td>
                                                                            <td><input type="number" class="form-control montocaja" id="mpcajaEdit" value="0.00"></td>
                                                                            <td>Soles</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Vuelto</td>
                                                                            <td><input class="form-control vueltocaja" id="vcajaEdit" value="0.00" disabled></td>
                                                                            <td>Soles</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-7 order-lg-2 order-1">
                                            <div class="card mb-4">
                                                <div class="container">
                                                    <div class="card-header">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <button type="button" class="btn btn-primary w-100" onclick="MostrarPlatosedit()">PLATOS</button>
                                                            </div>
                                                            <div class="col-6">
                                                                <button type="button" class="btn btn-info w-100" onclick="MostrarBebidasedit()">BEBIDAS</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="dropdown-divider"></div>
                                                    <div class="container-fluid">

                                                        <div class="columnas plato seccplato" id="seccplato">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="mdi mdi-magnify" id="btnBuscarPlato"></i>
                                                                    </span>
                                                                </div>
                                                                <input type="text" class="form-control buscarPlatoedit" id="buscarPlatoedit" placeholder="Buscar plato" onkeyup="BuscarPlatosedit(this.id)">

                                                            </div>
                                                            <div class="dropdown-divider"></div>
                                                            <div class="row bPlatoedit" id='bPlatoedit'>

                                                            </div>
                                                        </div>

                                                        <div class="columnas bebida d-none seccbebida" id="seccbebida">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="mdi mdi-magnify" id="btnBuscarPlato"></i>
                                                                    </span>
                                                                </div>
                                                                <input class="form-control py-2 border-left-0 border buscarBebidaedit" type="text" id="buscarBebidaedit" placeholder="Buscar bebida" onkeyup="BuscarBebidasedit(this.id)">
                                                            </div>
                                                            <div class="dropdown-divider"></div>
                                                            <div class="row bBebidaedit" id='bBebidaedit'>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- PAGAR POR PARTES -->
            <section>
                <div class="modal fade" id="mdlpagarxpartes" class="modal fade bd-example-modal-lg" tabindex="-1" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Pagar por partes</h5>
                            </div>

                            <div class="modal-body">
                                <section class="content">
                                    <div class="row">
                                        <div class="col">
                                            <div class="card mb-4">
                                                <div class="row">
                                                </div>

                                                <div class="card-header">
                                                    <h1>Pagar por partes</h1>

                                                </div>
                                                <div class="card-body">
                                                    <br>

                                                    <div class="row">
                                                        <div class="col">

                                                            <div class="table-responsive">
                                                                <table class="table text-center table-bordered table-light table-hover" id='tblCajapagoxpartes' width="100%" cellspacing="0">
                                                                    <thead class="thead-dark">
                                                                        <tr>
                                                                            <th>Descripcion</th>
                                                                            <th>Precio</th>
                                                                            <th>Cantidad Solicitada</th>
                                                                            <th>Cantidad Restante</th>
                                                                            <th style="table-layout: fixed; width: 300px;">Cantidad a Pagar</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="container">
                                                        <div class="input-group my-4">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                                                            </div>
                                                            <select class="form-control js-example-basic-single" id="id_clifreventaPp" name="id_clifreventaPp">
                                                                <option value="">Seleccione Cliente Frecuente</option>
                                                                <?php
                                                                $tabla = 'clientes_frecuentes';
                                                                $respuesta =  clientefreControlador::ctrListarTablaClienFrecuentexSede($tabla, $_SESSION['id_local']);
                                                                foreach ($respuesta as $key => $value) : ?>
                                                                    <option value="<?php echo $value['id_cliente_frecuente']; ?>">
                                                                        <?php echo $value["nombre_completo"]; ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr></tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>SubTotal</td>
                                                                    <td><input class="form-control" id="subttlpartes" value="0.00" disabled></td>
                                                                    <td>Soles</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Descuento</td>
                                                                    <td><input class="form-control" id="descpartes" value="0.00" disabled></td>
                                                                    <td>Soles</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Total</td>
                                                                    <td><input class="form-control" id="ttlpartes" value="0.00" disabled></td>
                                                                    <td>Soles</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Monto Pagado</td>
                                                                    <td><input type="number" class="form-control" id="mppartes" value="0.00"></td>
                                                                    <td>Soles</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Vuelto</td>
                                                                    <td><input class="form-control" id="vpartes" value="0.00" disabled></td>
                                                                    <td>Soles</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <button class="btn btn-danger p-2" id="btncancelarpagopartes">Cancelar Pago</button>
                                                        </div>
                                                        <div class="col text-right">
                                                            <button class="btn btn-success p-2" id="btncpagopartes">Confirmar Pago</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--  -->
        </div>
        <!-- DELIVERY -->
        <div class="tab-pane fade" id="Delivery" role="tabpanel" aria-labelledby="Delivery-tab">
            <!-- TABLA -->
            <section class="py-5">
                <div class="box">
                    <div class="container-fluid">
                        <!-- <div class="card"> -->
                        <div class="box-header with-border">
                            <h4 class="box-title">Atenciones en curso</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table text-center table-bordered table-light table-hover" id="tblDelivery" width="100%" cellspacing="0">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre Cliente</th>
                                        <th>Direccion</th>
                                        <th>N° contacto</th>
                                        <th>Fecha</th>
                                        <th>Prioridad</th>
                                        <th>Pago</th>
                                        <th>Pendientes</th>
                                        <th>Modificar</th>
                                        <th>Voucher</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <!-- </div> -->
                    </div>
                </div>
            </section>
            <!-- MODIFICAR ORDEN -->
            <section>
                <div class="modal fade" id="mdlcajaDelivery" tabindex="-1" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" style="max-width: 1500px;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Actualizar</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <section class="content">
                                    <div class="row">
                                        <div class="col-lg-5 px-0 order-lg-1 order-2">
                                            <div class="card mb-4">
                                                <div class="card-header">
                                                    <form id="frmupdateventaDelivery" method="post">
                                                        <div class="row g-3 card-M p-2">
                                                            <div class="card-body d-flex p-0" style="align-items: center;">
                                                                <div class="card-title card-title-caja p-0 m-0 w-100">
                                                                    <h3 class="m-0">Modificar Orden</h3>
                                                                </div>
                                                                <div class="card-tools">
                                                                    <button type="button" class="btn btn-tool" id="btn-caja-collapse" data-toggle="collapse" href="#caja-datosD" aria-expanded="false"><i id="icon-caja-collapse" class="fas fa-solid fa-plus" style="color:black;"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 row collapse py-3" id=caja-datosD>
                                                                <div class="col-12 pb-3">
                                                                    <textarea type="text" class="form-control" id="direccionDelivery" name="direccionDelivery" placeholder="Ingrese la dirección" rows="3" pattern="[0-9A-Za-z#()$&amp;/'.-°\sñÑáéíóúÁÉÍÓÚ]+" autocomplete="off" required="required" disabled></textarea>
                                                                </div>
                                                                <div class="col-12 pb-3">
                                                                    <div class="input-group justify-content-start">
                                                                        <div class="input-group mb-3">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                                                                            </div>
                                                                            <input class="form-control" type="text" name="nameclienteDelivery" id="nameclienteDelivery" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                                                                        </div>
                                                                        <input class="form-control" type="text" name="telefonoDelivery" id="telefono" placeholder="número de contacto" required="required" disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="input-group justify-content-start">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                                                                        </div>
                                                                        <select class="form-control js-example-basic-single selectCF" id="clifreventeDelivery" name="clifreventeDelivery">
                                                                            <option value="0">Seleccione Cliente Frecuente</option>
                                                                            <?php
                                                                            $tabla = 'clientes_frecuentes';
                                                                            $respuesta =  clientefreControlador::ctrListarTablaClienFrecuentexSede($tabla, $_SESSION['id_local']);
                                                                            foreach ($respuesta as $key => $value) : ?>
                                                                                <option value="<?php echo $value['id_cliente_frecuente']; ?>">
                                                                                    <?php echo $value["nombre_completo"]; ?>
                                                                                </option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6 pt-3">
                                                                    <div class="input-group justify-content-start">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                                                                        </div>
                                                                        <select class="form-control selectP" id="prioridadEditD" name="prioridad">
                                                                            <option selected value="Normal">Normal</option>
                                                                            <option value="Preferencial">Preferencial</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="table-responsive">
                                                                    <table class="table text-center table-bordered table-light table-hover" id='ListarCajaDelivery' width="100%" cellspacing="0">
                                                                        <thead class="thead-dark">
                                                                            <tr>
                                                                                <th>Descripcion</th>
                                                                                <th>Precio</th>
                                                                                <th style="table-layout: fixed; width: 300px;">Cantidad</th>
                                                                                <th>Total</th>
                                                                                <th>Eliminar</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody></tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="container">
                                                                <table class="table table-striped">
                                                                    <thead>
                                                                        <tr></tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>SubTotal</td>
                                                                            <td><input class="form-control subtotalcaja" id="subttlcajaDelivery" disabled></td>
                                                                            <td>Soles</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Descuento</td>
                                                                            <td><input class="form-control descuentocaja" id="desccajaDelivery" value="0.00" disabled></td>
                                                                            <td>Soles</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Total</td>
                                                                            <td><input class="form-control totalcaja" id="ttlcajaDelivery" disabled></td>
                                                                            <td>Soles</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-7 order-lg-2 order-1">
                                            <div class="card mb-4">
                                                <div class="container">
                                                    <div class="card-header">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <button type="button" class="btn btn-primary w-100" onclick="MostrarPlatosedit()">PLATOS</button>
                                                            </div>
                                                            <div class="col-6">
                                                                <button type="button" class="btn btn-info w-100" onclick="MostrarBebidasedit()">BEBIDAS</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="dropdown-divider"></div>
                                                    <div class="container-fluid">
                                                        <div class="columnas plato seccplato" id="seccplatoDelivery">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="mdi mdi-magnify" id="btnBuscarPlatoDelivery"></i></span>
                                                                </div>
                                                                <input type="text" class="form-control buscarPlatoedit" id="buscarPlatoDelivery" placeholder="Buscar plato" onkeyup="BuscarPlatosedit(this.id)">
                                                            </div>
                                                            <div class="dropdown-divider"></div>
                                                            <div class="row bPlatoedit" id='bPlatoDelivery'></div>
                                                        </div>

                                                        <div class="columnas bebida d-none seccbebida" id="seccbebidaDelivery">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="mdi mdi-magnify" id="btnBuscarPlatoDelivery"></i></span>
                                                                </div>
                                                                <input class="form-control py-2 border-left-0 border buscarBebidaedit" type="text" id="buscarBebidaDelivery" placeholder="Buscar bebida" onkeyup="BuscarBebidasedit(this.id)">
                                                            </div>
                                                            <div class="dropdown-divider"></div>
                                                            <div class="row bBebidaedit" id='bBebidaDelivery'></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- IMAGEN PAGO -->
            <div class="modal fade" id="mdlVisualizarIPago" data-backdrop="static" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">DATOS DEL DOCUMENTO</h5>
                            <button type="reset" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="frmRegistroImagenPago" method="post">
                            <div class="modal-body">
                                <input type="hidden" class="form-control" id="token" name="token">
                                <input type="hidden" class="form-control" id="antiguo" name="antiguo">
                                <input type="hidden" class="form-control" id="id-venta" name="id-venta">
                                <label>Importar imagen de pago:</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                                    </div>
                                    <input type="file" class="form-control" name="ruta_imagen" accept="image/*" id="foto" onchange="previewMotorizado(event,foto)" required>
                                    <p class="text-danger m-auto">(*)</p>
                                </div>
                                <p class="text-danger">Datos requeridos <span class="badge badge-light text-danger">(*)</span></p>

                                <img class="embed-responsive-item" id="archivo" frameborder="0" src="" width="100%" height="500">
                            </div>
                            <div class="modal-footer">
                                <button type="reset" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-angle-double-left"></i>&nbsp;&nbsp;Regesar</button>
                                <button type="submit" class="btn btn-primary"><i class="fa fas fa-upload"></i> &nbsp;&nbsp;Subir Archivo</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- RECOJO -->
        <div class="tab-pane fade" id="Recojo" role="tabpanel" aria-labelledby="Recojo-tab">
            <!-- TABLA -->
            <section class="py-5">
                <div class="box">
                    <div class="container-fluid">
                        <!-- <div class="card"> -->
                        <div class="box-header with-border">
                            <h4 class="box-title">Atenciones en curso</h4>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table text-center table-bordered table-light table-hover" id="tblRecojo" width="100%" cellspacing="0">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre Cliente</th>
                                            <th>N° contacto</th>
                                            <th>Fecha</th>
                                            <th>Prioridad</th>
                                            <th>Pendientes</th>
                                            <th>Modificar</th>
                                            <th>Finalizar</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <!-- </div> -->
                    </div>
                </div>
            </section>
            <!-- MODIFICAR ORDEN -->
            <section>
                <div class="modal fade" id="mdlcajaRecojo" tabindex="-1" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" style="max-width: 1500px;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Actualizar</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <section class="content">
                                    <div class="row">
                                        <div class="col-lg-5 px-0 order-lg-1 order-2">
                                            <div class="card mb-4">
                                                <div class="card-header">
                                                    <form id="frmupdateventaRecojo" method="post">
                                                        <div class="row g-3 card-M p-2">
                                                            <!-- <div class="col-12 pb-3">
                                                                <label>Dirección:</label>
                                                                <textarea type="text" class="form-control" id="direccionRecojo" name="direccionRecojo" placeholder="Ingrese la dirección" rows="3" pattern="[0-9A-Za-z#()$&amp;/'.-°\sñÑáéíóúÁÉÍÓÚ]+" autocomplete="off" required="required" disabled></textarea>
                                                            </div> -->
                                                            <div class="card-body d-flex p-0" style="align-items: center;">
                                                                <div class="card-title card-title-caja p-0 m-0 w-100">
                                                                    <h3 class="m-0">Modificar Orden</h3>
                                                                </div>
                                                                <div class="card-tools">
                                                                    <button type="button" class="btn btn-tool" id="btn-caja-collapse" data-toggle="collapse" href="#caja-datosR" aria-expanded="false"><i id="icon-caja-collapse" class="fas fa-solid fa-plus" style="color:black;"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 row collapse py-3" id=caja-datosR>
                                                                <div class="col-12 pb-3">
                                                                    <div class="input-group justify-content-start">
                                                                        <div class="input-group mb-3">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                                                                            </div>
                                                                            <input class="form-control" type="text" name="nameclienteRecojo" id="nameclienteRecojo" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                                                                        </div>
                                                                        <input class="form-control" type="text" name="telefonoRecojo" id="telefonoRecojo" placeholder="número de contacto" required="required" disabled>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6">
                                                                    <div class="input-group justify-content-start">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                                                                        </div>
                                                                        <select class="form-control js-example-basic-single selectCF" id="clifreventeRecojo" name="clifreventeRecojo">
                                                                            <option value="0">Seleccione Cliente Frecuente</option>
                                                                            <?php
                                                                            $tabla = 'clientes_frecuentes';
                                                                            $respuesta =  clientefreControlador::ctrListarTablaClienFrecuentexSede($tabla, $_SESSION['id_local']);
                                                                            foreach ($respuesta as $key => $value) : ?>
                                                                                <option value="<?php echo $value['id_cliente_frecuente']; ?>">
                                                                                    <?php echo $value["nombre_completo"]; ?>
                                                                                </option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-6 pt-3">
                                                                    <div class="input-group justify-content-start">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                                                                        </div>
                                                                        <select class="form-control selectP" id="prioridadEditR" name="prioridad">
                                                                            <option selected value="Normal">Normal</option>
                                                                            <option value="Preferencial">Preferencial</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="table-responsive">
                                                                    <table class="table text-center table-bordered table-light table-hover" id='ListarCajaRecojo' width="100%" cellspacing="0">
                                                                        <thead class="thead-dark">
                                                                            <tr>
                                                                                <th>Descripcion</th>
                                                                                <th>Precio</th>
                                                                                <th style="table-layout: fixed; width: 300px;">Cantidad</th>
                                                                                <th>Total</th>
                                                                                <th>Eliminar</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody></tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="container">
                                                                <table class="table table-striped">
                                                                    <thead>
                                                                        <tr></tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>SubTotal</td>
                                                                            <td><input class="form-control subtotalcaja" id="subttlcajaRecojo" disabled></td>
                                                                            <td>Soles</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Descuento</td>
                                                                            <td><input class="form-control descuentocaja" id="desccajaRecojo" value="0.00" disabled></td>
                                                                            <td>Soles</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Total</td>
                                                                            <td><input class="form-control totalcaja" id="ttlcajaRecojo" disabled></td>
                                                                            <td>Soles</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Monto Pagado</td>
                                                                            <td><input type="number" class="form-control montocaja" id="mpcajaRecojo" value="0.00"></td>
                                                                            <td>Soles</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Vuelto</td>
                                                                            <td><input class="form-control vueltocaja" id="vcajaRecojo" value="0.00" disabled></td>
                                                                            <td>Soles</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-7 order-lg-2 order-1">
                                            <div class="card mb-4">
                                                <div class="container">
                                                    <div class="card-header">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <button type="button" class="btn btn-primary w-100" onclick="MostrarPlatosedit()">PLATOS</button>
                                                            </div>
                                                            <div class="col-6">
                                                                <button type="button" class="btn btn-info w-100" onclick="MostrarBebidasedit()">BEBIDAS</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="dropdown-divider"></div>
                                                    <div class="container-fluid">
                                                        <div class="columnas plato seccplato" id="seccplatoRecojo">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="mdi mdi-magnify" id="btnBuscarPlatoRecojo"></i></span>
                                                                </div>
                                                                <input type="text" class="form-control buscarPlatoedit" id="buscarPlatoRecojo" placeholder="Buscar plato" onkeyup="BuscarPlatosedit(this.id)">
                                                            </div>
                                                            <div class="dropdown-divider"></div>
                                                            <div class="row bPlatoedit" id='bPlatoRecojo'></div>
                                                        </div>

                                                        <div class="columnas bebida d-none seccbebida" id="seccbebidaRecojo">
                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="mdi mdi-magnify" id="btnBuscarPlatoRecojo"></i></span>
                                                                </div>
                                                                <input class="form-control py-2 border-left-0 border buscarBebidaedit" type="text" id="buscarBebidaRecojo" placeholder="Buscar bebida" onkeyup="BuscarBebidasedit(this.id)">
                                                            </div>
                                                            <div class="dropdown-divider"></div>
                                                            <div class="row bBebidaedit" id='bBebidaRecojo'></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- TODOS -->
        <!-- PENDIENTES -->
        <section>
            <div class="modal fade" id="mdlupcajapendiente" class="modal fade bd-example-modal-lg" tabindex="-1" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Pendientes</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <section class="content">
                                <div class="row">
                                    <div class="col">
                                        <div class="card mb-4">
                                            <div class="row">
                                            </div>
                                            <div class="card-header">
                                                <h1>Pendientes</h1>
                                            </div>

                                            <div class="card-header">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-warning my-3" onclick="PrepararTodo();"><i class="fa fa-solid fa-check-double"></i>&nbsp; Marcar todos como preparados</button>
                                                        </div>
                                                        <div class="table-responsive">
                                                            <table class="table text-center table-bordered table-light table-hover" id='tblCajapendiente' width="100%" cellspacing="0">
                                                                <thead class="thead-dark">
                                                                    <tr>
                                                                        <th>Descripcion</th>
                                                                        <th>Precio</th>
                                                                        <th>Cantidad Solicitada</th>
                                                                        <th style="table-layout: fixed; width: 300px;">Cantidad Preparada</th>

                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- ID_VENTAGLOBAL -->
    <input type="hidden" name="id_ventaglobal" id="id_ventaglobal">
</section>