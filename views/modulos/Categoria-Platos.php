<section>
    <div class="box">
        <div class="container-fluid">
            <div class="box-header with-border">
                <h4 class="box-title titletablas">Lista de Categorias de Platos</h4>
            </div>
            <div class="box-body">
            <div style="padding-bottom: 13px;">
            <button type="button" class="btn btn-primary active" data-toggle="modal" data-target="#mdlCatePlato"><i class="fa fa-solid fa-plus"></i>&nbsp;&nbsp;Nuevo</button>
            </div>
                <div class="table-responsive">
                    <table class="table text-center table-bordered table-light table-hover" id="tbl_categoriaplato" width="100%" cellspacing="0">
                        <thead class="thead-dark">
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
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
    <div class="modal fade" id="mdlCatePlato" tabindex="-1" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header text-uppercase">
                    <h5 class="modal-title" id="exampleModalLabel">Registro Categoria Plato</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="frmRegistroCatePlato" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <input type="text" class="form-control" name="nombre_cate" placeholder="Ingrese la categoria del plato" pattern="[0-9A-Za-z#()$&/'.-°\sñÑáéíóúÁÉÍÓÚ]+" autocomplete="off" required>
                            <p class="text-danger m-auto">(*)</p>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <input type="text" class="form-control mr-3" name="descripcion_cate" placeholder="Descripción" pattern="[0-9A-Za-z#()$&/'.-°\sñÑáéíóúÁÉÍÓÚ]+" autocomplete="off">
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="d-flex"> Imagen <p class="text-danger">(*)</p></label>
                                <div class="card border-primary">
                                    <div class="card-body">
                                        <label for="imagenCategoriaPlato" id="icon-imageCategoriaPlato" class="btn btn-primary"><i class="mdi mdi-image-size-select-actual"></i></label>
                                        <span id="icon-cerrarCategoriaPlato"></span>
                                        <input type="file" name="imagen" id="imagenCategoriaPlato" class="d-none" onchange="previewCategoria(event)">
                                        <img class="img-fluid" id="img-previewCategoriaPlatoOne">
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

    <div class="modal fade" id="mdlActualizarCatePlato"  data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header text-uppercase">
                    <h5 class="modal-title" id="exampleModalLabel">Actualizar Categoria Plato</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="frmActualizarCatePlato" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" class="form-control" id="cateplatoEditar" name="cateplatoEditar" placeholder="ID" required>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <input type="text" class="form-control" id="nombrecateEditar" name="nombrecateEditar" placeholder="Ingrese el nombre de su plato" pattern="[0-9A-Za-z#()$&/'.-°\sñÑáéíóúÁÉÍÓÚ]+" autocomplete="off" required>
                            <p class="text-danger m-auto">(*)</p>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <input type="text" class="form-control" id="descripcion_cateEdit" name="descripcion_cateEdit" placeholder="Descripción" pattern="[0-9A-Za-z#()$&/'.-°\sñÑáéíóúÁÉÍÓÚ]+" autocomplete="off">
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="d-flex"> Imagen<p class="text-danger">(*)</p></label>
                                <div class="card border-primary">
                                    <div class="card-body">
                                        <label for="imgCategoriaPlato" id="icon-imageCategoriaPlatoTwo" class="btn btn-primary"><i class="mdi mdi-image-size-select-actual"></i></label>
                                        <span id="icon-cerrarCategoriaTwo"></span>
                                        <input type="file" name="imgCategoriaPlato" id="imgCategoriaPlato" class="d-none" onchange="readURLCategoria(this)">
                                        <img class="img-fluid" id="img-previewCategoriaPlatoTwo">
                                        <input type="hidden" name="updt-image" id="updt-image" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <label for="">Status:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <select class="form-control" id="statuscategoria" name="statuscategoria">
                                <option value="Activo" selected>Activo</option>
                                <option value="Inactivo" selected>Inactivo</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer ">
                    <button type="reset" class="btn btn-danger btnCancelarModal" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;&nbsp;Cancelar</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>