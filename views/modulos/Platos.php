<section>
    <div class="box">
        <div class="container-fluid">
            <div class="box-header with-border">
                <h4 class="box-title titletablas">Lista de platos</h4>
            </div>

            <div class="box-body">
            <div style="padding-bottom: 13px;">
            <button type="button" class="btn btn-primary active" data-toggle="modal" data-target="#mdlPlatos"><i class="fa fa-solid fa-plus"></i>&nbsp;&nbsp;Nuevo
                </button>
            </div>
                <div class="table-responsive">
                    <table class="table text-center table-bordered table-light table-hover" id="tbl_platos" width="100%" cellspacing="0">
                        <thead class="thead-dark">
                            <tr>
                                <th>Categoria</th>
                                <th>Plato en la carta</th>
                                <th>Descripción</th>
                                <th>Precio</th>
                                <th>Imagen</th>
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
    <div class="modal fade" id="mdlPlatos" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header text-uppercase">
                    <h5 class="modal-title">Registro Plato</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="frmRegistroPlatos" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <label for="">Categoria del plato:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <select class="form-control js-example-basic-single" name="item_categoriaplato" required>
                                <option selected value="">Seleccione Categoria</option>
                                <?php
                                $tabla = "categoria_platos";
                                $marca = categoriaplatoscontroller::ctrListarCategoriaPlatoActivos($tabla);
                                foreach ($marca as $key => $value) :
                                ?>
                                    <option value="<?php echo $value['id_categoria'] ?>"><?php echo $value['nombre'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <p class="text-danger m-auto">(*)</p>
                        </div>
                        <label for="">Nombre del plato:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <input type="text" class="form-control" name="nombreplato" placeholder="Ingrese el nombre del plato" pattern="[0-9A-Za-z#()$&/'.-°\sñÑáéíóúÁÉÍÓÚ]+" autocomplete="off" required>
                            <p class="text-danger m-auto">(*)</p>
                        </div>
                        <label for="">Descripción del plato:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <textarea type="text" class="form-control" name="descripcionplato" placeholder="Ingrese la descripcion del plato" rows="3" pattern="[0-9A-Za-z#()$&/'.-°\sñÑáéíóúÁÉÍÓÚ]+" autocomplete="off" required></textarea>
                            <p class="text-danger m-auto">(*)</p>
                        </div>
                        <label for="">Precio:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <input type="number" step="any" class="form-control" name="precioplato" placeholder="Ingrese el precio" autocomplete="off" required>
                            <p class="text-danger m-auto">(*)</p>
                        </div>


                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="d-flex">Imagen: <p class="text-danger">(*)</p></label>
                                <div class="card border-primary">
                                    <div class="card-body">
                                        <label for="imagenPlato" id="icon-imagePlato" class="btn btn-primary"><i class="mdi mdi-image-size-select-actual"></i></label>
                                        <span id="icon-cerrarPlato"></span>
                                        <input type="file" name="imagen" id="imagenPlato" class="d-none" onchange="previewPlato(event)">
                                        <img class="img-fluid" id="img-previewPlato">
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

    <div class="modal fade" id="mdlActualizarPlatos" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header text-uppercase">
                        <h5 class="modal-title" id="exampleModalLabel">Actualizar Plato</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form id="frmActualizarPlatos" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <input type="hidden" class="form-control" id="platoEditar" name="platoEditar" required>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                                </div>
                                <select class="form-control js-example-basic-single" id="item_cateEdit" name="item_cateEdit" aria-label="Username" aria-describedby="basic-addon1" required>
                                    <option selected>Seleccione Categoria</option>
                                    <?php
                                    $tabla = "categoria_platos";
                                    $marca = categoriaplatoscontroller::ctrListarCategoriaPlatoActivos($tabla);
                                    foreach ($marca as $key => $value) :
                                    ?>
                                        <option value="<?php echo $value['id_categoria'] ?>"><?php echo $value['nombre'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <p class="text-danger m-auto">(*)</p>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                                </div>
                                <input type="text" class="form-control" id="nombreplatoEdit" name="nombreplatoEdit" placeholder="Ingrese el nombre del plato" pattern="[0-9A-Za-z#()$&/'.-°\sñÑáéíóúÁÉÍÓÚ]+" autocomplete="off" required>
                                <p class="text-danger m-auto">(*)</p>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                                </div>
                                <textarea type="text" class="form-control" id="descripcionplatoEdit" name="descripcionplatoEdit" placeholder="Ingrese la descripcion del plato" pattern="[0-9A-Za-z#()$&/'.-°\sñÑáéíóúÁÉÍÓÚ]+" autocomplete="off" required></textarea>
                                <p class="text-danger m-auto">(*)</p>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                                </div>
                                <input type="number" step="any" class="form-control" id="precioplatoEdit" name="precioplatoEdit" placeholder="Ingrese el precio" autocomplete="off" required>
                                <p class="text-danger m-auto">(*)</p>
                            </div>

                            <div class="col-md-12">
                            <div class="mb-3">
                                <label> Imagen </label>
                                <div class="card border-primary">
                                    <div class="card-body">
                                        <label for="imgPlatoUdp" id="icon-imagePlatoUdp" class="btn btn-primary"><i class="mdi mdi-image-size-select-actual"></i></label>
                                        <span id="icon-cerrarPlatoUdp"></span>
                                        <input type="file" name="imgPlatoUdp" id="imgPlatoUdp" class="d-none" onchange="readURLPlato(this)">
                                        <img class="img-fluid" id="img-previewPlatoUdp">
                                        <input type="hidden" name="updt-imagePlato" id="updt-imagePlato"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <label for="">Status:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <select class="form-control" id="statusplato" name="statusplato">
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