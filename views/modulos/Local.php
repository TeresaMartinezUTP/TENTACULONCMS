<section>
    <div class="box">
        <div class="container-fluid">
            <!-- <div class="card"> -->
            <div class="box-header with-border">
                <h4 class="box-title titletablas">Lista de locales</h4>
            </div>
            <div class="box-body">
            <div style="padding-bottom: 13px;">
                <button type="button" class="btn btn-primary active" data-toggle="modal"  onclick="resetuser()" data-target="#mdlLocal">
                <i class="fa fa-solid fa-plus"></i>&nbsp;&nbsp;Nuevo
                </button>
            </div>
                <div class="table-responsive">
                    <table class="table text-center table-bordered table-light table-hover" id="tbl_local" width="100%" cellspacing="0">
                        <thead class="thead-dark">
                            <tr>
                                <th>Códido de Sede</th>
                                <th>Dirección</th>
                                <th>Status</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
    </div>
</section>
<section>
    <div class="modal fade" id="mdlLocal" tabindex="-1" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">REGISTRAR LOCAL</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="frmRegistroLocal" method="post">
                    <div class="modal-body">
                        <label for="">Códido de Sede:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <input type="text" class="form-control" name="codSede" placeholder="Código de la sede" pattern="[0-9A-Za-z#()$&'°\sñÑáéíóúÁÉÍÓÚ.-]+" autocomplete="off" required>
                            <p class="text-danger m-auto">(*)</p>
                        </div>

                        <label for="">Dirección:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <input type="text" class="form-control" name="direccionlocal" placeholder="Dirección del local" pattern="[0-9A-Za-z#()$&'°\sñÑáéíóúÁÉÍÓÚ.-]+" autocomplete="off" required>
                            <p class="text-danger m-auto">(*)</p>
                        </div>
                    </div>
                    <div class=" modal-footer">
                        <button type="reset" class="btn btn-danger btnCancelarModal" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;&nbsp;Cancelar</button>
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp;&nbsp;Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="mdlUdpLocal" tabindex="-1" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">ACTUALIZAR LOCAL</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="frmActualizarLocal" method="post">
                    <input type="hidden" id="id_localEditar" name="id_localEditar">
                    <div class="modal-body">
                        <label for="">Códido de Sede:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <input type="text" class="form-control" id="UdpcodSede" name="UdpcodSede" placeholder="Código de la sede" pattern="[0-9A-Za-z#()$&'°\sñÑáéíóúÁÉÍÓÚ.-]+" autocomplete="off" required>
                            <p class="text-danger m-auto">(*)</p>
                        </div>

                        <label for="">Dirección:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <input type="text" class="form-control" id="Udpdireccionlocal" name="Udpdireccionlocal" placeholder="Dirección del local" pattern="[0-9A-Za-z#()$&'°\sñÑáéíóúÁÉÍÓÚ.-]+" autocomplete="off" required>
                            <p class="text-danger m-auto">(*)</p>
                        </div>
                        <label for="">Status:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <select class="form-control" id="statuslocal" name="statuslocal">
                                <option value="Activo" selected>Activo</option>
                                <option value="Inactivo" selected>Inactivo</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-danger btnCancelarModal" data-dismiss="modal" onclick="btncancelLocal()"><i class="fa fa-times"></i>&nbsp;&nbsp;Cancelar</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>