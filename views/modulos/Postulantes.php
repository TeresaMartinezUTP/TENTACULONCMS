<section>
    <div class="box">
        <div class="container-fluid">
            <div class="box-header with-border">
                <h4 class="box-title titletablas">Lista de Postulantes</h4>
            </div>
            <div class="box-body" style="padding-bottom: 13px;">
                <button type="button" class="btn btn-primary active" data-toggle="modal" data-target="#mdlPostulantes">
                <i class="fa fa-solid fa-user-plus"></i>&nbsp;&nbsp;Registrar
                </button>
                <br>
            </div>
            <div class="table-responsive">
                <table class="table text-center table-bordered table-light table-hover" id="tbl_postulantes" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th hidden></th>
                            <th>Área a postular</th>
                            <th>Nombre completo</th>
                            <th>Tipo Doc</th>
                            <th>Nro. de Docum.</th>
                            <th>Teléfono</th>
                            <th>Correo</th>
                            <th>Currc. Vitae</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="modal fade" id="mdlPostulantes" tabindex="-1" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">REGISTRAR POSTULANTE</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="frmRegistroPostulante" method="post">
                    <div class="modal-body">
                        <label>Seleccione área a postular:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="mdi mdi-check"></i></span>
                            </div>
                            <select class="form-control js-example-basic-single" name="area_postular" required>
                                <option selected value="">Seleccionar área</option>
                                <option value="Cocina">Cocina</option>
                                <option value="Caja">Caja</option>
                                <option value="Mozo/Azafata">Mozo/Azafata</option>
                                <option value="Delivery">Delivery</option>
                            </select>
                            <p class="text-danger m-auto">(*)</p>
                        </div>
                        <label>Nombre del postulante:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <input type="text" class="form-control" name="nombre_postular" placeholder="Nombre completo del Postulante" autocomplete="off" pattern="[a-zA-Z\sñÑáéíóúÁÉÍÓÚ]+" required>
                            <p class="text-danger m-auto">(*)</p>
                        </div>
                        <label>Tipo de documento:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <select class="form-control js-example-basic-single" name="tipodoc_postular" required>
                                <option value="">Seleccione Tipo de Documento</option>
                                <option value="DNI">DNI</option>
                                <option value="Carnet de Extranjería">Carnet de Extranjería</option>
                                <option value="Pasaporte">Pasaporte</option>
                            </select>
                            <p class="text-danger m-auto">(*)</p>
                        </div>
                        <label>Número de documento:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <input type="text" class="form-control" name="numdoc_postular" placeholder="Numero de documento" autocomplete="off" pattern="[0-9]+" required>
                            <p class="text-danger m-auto">(*)</p>
                        </div>
                        <label>Teléfono:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <input type="text" class="form-control" name="telefono_postular" placeholder="Telefono" pattern="[0-9\+()]+" autocomplete="off">
                        </div>
                        <label>Correo:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <input type="email" class="form-control" name="correo_postular" placeholder="Correo de Empleado" autocomplete="off">
                        </div>
                        <p class="text-danger">Datos requeridos <span class="badge badge-light text-danger">(*)</span></p>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-danger btnCancelarModal" data-dismiss="modal" onclick="btncancelEmp()"><i class="fa fa-times"></i>&nbsp;&nbsp;Cancelar</button>
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp;&nbsp;Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="mdlUdtPostulantes" tabindex="-1" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">ACTUALIZAR POSTULANTE</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="frmActualizarPostulante" method="post">
                    <input type="hidden" class="form-control" id="postularE" name="postularE" placeholder="Nombre completo del Postulante" autocomplete="off" required>
                    <div class="modal-body">
                        <label>Seleccione área a postular:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="mdi mdi-check"></i></span>
                            </div>
                            <select class="form-control js-example-basic-single" id="area_postularE" name="area_postularE" id="area_postular" required>
                                <option selected value="">Seleccionar área</option>
                                <option value="Cocina">Cocina</option>
                                <option value="Caja">Caja</option>
                                <option value="Mozo/Azafata">Mozo/Azafata</option>
                                <option value="Delivery">Delivery</option>
                            </select>
                            <p class="text-danger m-auto">(*)</p>
                        </div>
                        <label>Nombre del postulante:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <input type="text" class="form-control" id="nombre_postularE" name="nombre_postularE" autocomplete="off" required>
                            <p class="text-danger m-auto">(*)</p>
                        </div>
                        <label>Tipo de documento:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <select class="form-control js-example-basic-single" id="tipodoc_postularE" name="tipodoc_postularE" required>
                                <option value="">Seleccione Tipo de Documento</option>
                                <option value="DNI">DNI</option>
                                <option value="Carnet de Extranjería">Carnet de Extranjería</option>
                                <option value="Pasaporte">Pasaporte</option>
                            </select>
                            <p class="text-danger m-auto">(*)</p>
                        </div>
                        <label>Número de documento:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <input type="text" class="form-control" id="numdoc_postularE" name="numdoc_postularE" placeholder="Numero de documento" autocomplete="off" pattern="[0-9]+" required>
                            <p class="text-danger m-auto">(*)</p>
                        </div>
                        <label>Teléfono:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <input type="text" class="form-control" id="telefono_postularE" name="telefono_postularE" placeholder="Telefono" pattern="[0-9\+()]+" autocomplete="off">
                        </div>
                        <label>Correo:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <input type="email" class="form-control" id="correo_postularE" name="correo_postularE" placeholder="Correo de Empleado" autocomplete="off">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-danger btnCancelarModal" data-dismiss="modal" onclick="btncancelEmp()"><i class="fa fa-times"></i>&nbsp;&nbsp;Cancelar</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="modal fade" id="mdlCurriculumVitae" data-backdrop="static" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">DATOS DEL DOCUMENTO  </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="btnResetDatossalud();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="frmRegistroCurriculumVitae" method="post">
                    <div class="modal-body">
                        <input type="hidden" class="form-control" id="curriculumvitae" name="curriculumvitae" required>
                        <input type="hidden" class="form-control" id="namedocumentovitae" name="namedocumentovitae">
                        <input type="hidden" class="form-control" id="tokenCV">
                        <label>Importar documento Curriculum Vitae:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <a class="input-group-text btn" id="urlcv"><i class="mdi mdi-folder-download"></i></a>
                            </div>
                            <input type="file" class="form-control" name="img_curriculum_vitae" id="pdfcv" required accept="application/pdf">
                            <p class="text-danger m-auto">(*)</p>
                        </div>
                        <p class="text-danger">Datos requeridos <span class="badge badge-light text-danger">(*)</span></p>
                        <img class="w-100" id="imgCV">
                        <iframe class="embed-responsive-item" id="archivo_curriculum_vitae" scrolling="no" frameborder="0" src="" width="100%" height="500"></iframe>
                    
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-angle-double-left"></i>&nbsp;&nbsp;Regesar</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fas fa-upload"></i> &nbsp;&nbsp;Subir Archivo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>