<section>
    <div class="box">
        <div class="container-fluid">
            <!-- <div class="card"> -->
            <div class="box-header with-border">
                <h4 class="box-title titletablas">Lista de bebidas</h4>
            </div>
            <div class="box-body">
            <div style="padding-bottom: 13px;">
            <button type="button" class="btn btn-primary active" data-toggle="modal" data-target="#mdlBebida"> <i class="fa fa-solid fa-plus"></i>&nbsp;&nbsp;Nuevo</button>
            </div>
                <div class="table-responsive">
                    <table class="table text-center table-bordered table-light table-hover" id="tbl_bebidas" width="100%" cellspacing="0">
                        <thead class="thead-dark">
                            <tr>
                                <th>Id</th>
                                <th>Marca</th>
                                <th>Descripción</th>
                                <th>Precio venta</th>
                                <th>Imagen</th>
                                <th>Fecha registro</th>
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
    <div class="modal fade" id="mdlBebida" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header text-uppercase">
                    <h5 class="modal-title" id="exampleModalLabel">Registro Bebida</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="frmRegistroBebida" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <label for="">Marca de bebida:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <input type="text" class="form-control" name="marca" placeholder="Ingrese el nombre de la marca" pattern="[0-9A-Za-z#()$&/'.-°\sñÑáéíóúÁÉÍÓÚ]+" autocomplete="off" required>
                            <p class="text-danger m-auto">(*)</p>
                        </div>
                        <label for="">Descripción:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>                            
                            <textarea type="text" class="form-control" name="descripcion" placeholder="Descripción de la bebida" autocomplete="off" pattern="[0-9A-Za-z#()$&/'.-°\sñÑáéíóúÁÉÍÓÚ]+" required></textarea>
                            <p class="text-danger m-auto">(*)</p>
                        </div>
                        <label for="">Precio:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <input type="number" step="any" class="form-control" name="precio" placeholder="Precio de venta" autocomplete="off" required>
                            <p class="text-danger m-auto">(*)</p>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                            <label class="d-flex">Imagen: <p class="text-danger">(*)</p></label>
                                <div class="card border-primary">
                                    <div class="card-body">
                                        <label for="imagenBebida" id="icon-imageBebida" class="btn btn-primary"><i class="mdi mdi-image-size-select-actual"></i></label>
                                        <span id="icon-cerrarBebida"></span>
                                        <input type="file" name="imagen" id="imagenBebida" class="d-none" onchange="previewBebidas(event)">
                                        <img class="img-fluid" id="img-previewBebida">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="text-danger">Datos requeridos <span class="badge badge-light text-danger">(*)</span></p>
                    </div>
                    <div class="modal-footer ">
                        <button type="reset" class="btn btn-danger btnCancelarModal" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;&nbsp;Cancelar</button>
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp;&nbsp;Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="mdlActualizarBebida" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header text-uppercase">
                    <h5 class="modal-title" id="exampleModalLabel">Actualizar Bebida</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="frmActualizarBebida" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" class="form-control" id="id_bebidaED" name="id_bebidaED" placeholder="ID" required>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <input type="text" class="form-control" id="marcaED" name="marcaED" placeholder="Ingrese el nombre de la marca" pattern="[0-9A-Za-z#()$&/'.-°\sñÑáéíóúÁÉÍÓÚ]+" autocomplete="off" required>
                            <p class="text-danger m-auto">(*)</p>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <input type="text" class="form-control" id="descripcionED" name="descripcionED" placeholder="Descripción de la bebida" autocomplete="off" pattern="[0-9A-Za-z#()$&/'.-°\sñÑáéíóúÁÉÍÓÚ]+" required>
                            <p class="text-danger m-auto">(*)</p>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <input type="number" step="any" class="form-control" id="preciobebidaED" name="preciobebidaED" placeholder="Precio de venta" autocomplete="off" required>
                            <p class="text-danger m-auto">(*)</p>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label> Imagen </label>
                                <div class="card border-primary">
                                    <div class="card-body">
                                        <label for="imgBebidaUdp" id="icon-imageBebidaUdp" class="btn btn-primary"><i class="mdi mdi-image-size-select-actual"></i></label>
                                        <span id="icon-cerrarBebidaUdp"></span>
                                        <input type="file" name="imgBebidaUdp" id="imgBebidaUdp" class="d-none" onchange="readURLBebida(this)">
                                        <img class="img-fluid" id="img-previewBebidaUdp">
                                        <input type="hidden" name="updt-imageBebida" id="updt-imageBebida"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <label for="">Status:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <select class="form-control" id="statusED" name="statusED">
                                <option value="Activo" selected>Activo</option>
                                <option value="Inactivo" selected>Inactivo</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer ">
                        <button type="button" class="btn btn-danger btnCancelarModal" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;&nbsp;Cancelar</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>