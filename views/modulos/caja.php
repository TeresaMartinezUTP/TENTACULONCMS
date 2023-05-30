<section class="content">
    <div class="row">
        <div class="col-lg-5 px-0 order-lg-1 order-2">
            <div class="card mb-4">
                <div class="row">
                </div>

                <div class="card-header">
                    <h1>Orden</h1>
                </div>

                <div class="card-body pt-0">
                    <form id="frmgenerarventa" method="post">
                        <div class="row g-3 card-M mb-3">
                            <div class="card-body p-2 d-flex" style="align-items: center;">
                                <div class="card-title card-title-caja m-0 w-100">
                                    <p class="m-0">MODO DE ATENCIÓN</p>
                                </div>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" id="btn-caja-collapse" data-toggle="collapse" href="#caja-datos" aria-expanded="false"><i id="icon-caja-collapse" class="fas fa-solid fa-plus" style="color:black;"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-12 row collapse py-3" id=caja-datos>
                                <div class="col-12">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                                        </div>
                                        <select class="form-control" id="id_atencion" name="id_atencion">
                                            <option selected value="Presencial">Presencial</option>
                                            <option value="Delivery">Delivery</option>
                                            <option value="Recojo">Recojo</option>
                                        </select>
                                    </div>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                                        </div>
                                        <select class="form-control" id="prioridad" name="prioridad">
                                            <option selected value="Normal">Normal</option>
                                            <option value="Preferencial">Preferencial</option>
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-6" id="mesacaja">

                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                                        </div>
                                        <select class="form-control js-example-basic-single" id="id_mesaventa" name="id_mesaventa" required>
                                            <option value="">Seleccione Mesa</option>
                                            <?php
                                            $tabla = 'local_mesas';
                                            $respuesta =  clientefreControlador::ctrListarmesasxlocaldisponibles($tabla, $_SESSION['id_local']);
                                            foreach ($respuesta as $key => $value) : ?>
                                                <option value="<?php echo $value['id_mesa']; ?>">
                                                    <?php echo $value["nombre_mesa"]; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                </div>
                                <div class="col-12 pb-3" id="seccioncaja" hidden>
                                    <label>Dirección:</label>
                                    <textarea type="text" class="form-control" id="direccioncaja" name="direccioncaja" placeholder="Ingrese la dirección" rows="3" pattern="[0-9A-Za-z#()$&amp;/'.-°\sñÑáéíóúÁÉÍÓÚ]+" autocomplete="off"></textarea>
                                </div>
                                <div class="col-12 pb-3" id="referenciacaja" hidden>
                                    <label>Nombre del contacto:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                                        </div>
                                        <input class="form-control" type="text" name="nombrereferencia" id="nombrereferencia" placeholder="Nombre de referencia de contacto">
                                    </div>
                                </div>
                                <div class="col-6" id="telefonocaja" hidden>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                                        </div>
                                        <input class="form-control" type="text" name="telefono" id="telefono" placeholder="número de contacto">
                                    </div>
                                </div>

                                <div class="col-6" id="secc-clifre" hidden>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                                        </div>
                                        <select class="form-control js-example-basic-single" id="id_clifreventa" name="id_clifreventa">
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
                                </div>
                            </div>
                            <br>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="table-responsive">
                                    <table class="table text-center table-bordered table-light table-hover" id='ListarCaja' width="100%" cellspacing="0">
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
                                            <td><input class="form-control" id="subttlcaja" value="0.00" disabled></td>
                                            <td>Soles</td>
                                        </tr>
                                        <!--<tr>
                                            <td>IGV</td>
                                            <td><input class="form-control" id="igvcaja" value="0.00" disabled></td>
                                            <td>Soles</td>
                                        </tr>-->
                                        <tr id="descajatr" hidden>
                                            <td>Descuento</td>
                                            <td><input class="form-control" id="desccaja" value="0.00" disabled></td>
                                            <td>Soles</td>
                                        </tr>
                                        <tr id="seccCargo" hidden>
                                            <td>Cargo</td>
                                            <td><input type="number" class="form-control" id="crgcaja" value="0.00" name="cargo"></td>
                                            <td>Soles</td>
                                        </tr>
                                        <tr>
                                            <td>Total</td>
                                            <td><input class="form-control" id="ttlcaja" value="0.00" disabled></td>
                                            <td>Soles</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="dropdown-divider"></div>
                        <div class="row">
                            <div class="col">
                                <button type="button" onclick="btnLimpiarTemp()" class="btn btn-danger btn-block">Cancelar</button>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-success btn-block">Enviar a Cocina</button>
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
                                <button type="button" class="btn btn-primary w-100" onclick="MostrarPlatos()">PLATOS</button>

                            </div>
                            <div class="col-6">
                                <button type="button" class="btn btn-info w-100" onclick="MostrarBebidas()">BEBIDAS</button>

                            </div>
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="container-fluid">

                        <div class="columnas plato" id="seccplato">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="mdi mdi-magnify" id="btnBuscarPlato"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" id="buscarPlato" placeholder="Buscar plato" onkeyup="BuscarPlatos()">

                            </div>
                            <div class="dropdown-divider"></div>
                            <div class="row py-3" id='bPlato'>

                            </div>
                        </div>

                        <div class="columnas bebida d-none" id="seccbebida">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="mdi mdi-magnify" id="btnBuscarPlato"></i>
                                    </span>
                                </div>
                                <input class="form-control py-2 border-left-0 border" type="text" id="buscarBebida" placeholder="Buscar bebida" onkeyup="BuscarBebidas()">
                            </div>
                            <div class="dropdown-divider"></div>
                            <div class="row" id='bBebida'>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>