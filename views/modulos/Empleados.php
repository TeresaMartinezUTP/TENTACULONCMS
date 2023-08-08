<section>
    <div class="box">
        <div class="container-fluid">
            <div class="box-header with-border">
                <h4 class="box-title titletablas">Lista de Empleados</h4>
            </div>
            <div class="box-body">
                <div style="padding-bottom: 13px;">
                <button type="button" class="btn btn-primary active" data-toggle="modal" data-target="#mdlEmpleados">
                <i class="fa fa-solid fa-user-plus"></i>&nbsp;&nbsp;Registrar
                </button>
                <button type="button" class="btn btn-warning active" data-toggle="modal" data-target="#mdlPsotulantesActivos">
                <i class="fa fa-solid fa-user-plus"></i>
                </button>
                </div>
                <div class="table-responsive">
                    <table class="table text-center justify-content-center table-bordered table-light table-hover" id="tbl_empleados" width="100%" cellspacing="0">
                        <thead class="thead-dark">
                            <tr>
                                <th hidden></th>
                                <th>Nombre</th>
                                <th>Tipo Doc</th>
                                <th>Nro. de Docum.</th>
                                <th>Teléfono</th>
                                <th>Correo</th>
                                <th>Área</th>
                                <th>Carnet Sanidad</th>
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

<section>
    <div class="modal fade" id="mdlEmpleados" tabindex="-1" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-uppercase">
                    <h5 class="modal-title">Registrar Empleado</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="frmRegistroEmpleado" method="post">
                    <div class="modal-body">
                        <label>Nombre de empleado:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <input type="text" class="form-control" name="nombre_empleado" placeholder="Nombres del Empleado" autocomplete="off" pattern="[a-zA-Z\sñÑáéíóúÁÉÍÓÚ]+" required>
                            <p class="text-danger m-auto">&nbsp;&nbsp;(*)</p>
                        </div>
                        <label>Tipo de documento:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <select class="form-control js-example-basic-single" name="tipo_doc" required>
                                <option value="">Seleccione Tipo de Documento</option>
                                <option value="DNI">DNI</option>
                                <option value="Carnet de Extranjería">Carnet de Extranjería</option>
                                <option value="Pasaporte">Pasaporte</option>
                            </select>
                            <p class="text-danger m-auto">&nbsp;&nbsp;(*)</p>
                        </div>
                        <label>Número de documento:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <input type="text" class="form-control" name="numero_doc" placeholder="Número documento" autocomplete="off" pattern="[0-9]+" required>
                            <p class="text-danger m-auto">&nbsp;&nbsp;(*)</p>
                        </div>
                        <label>Teléfono:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <input type="text" class="form-control" name="telefono" placeholder="Teléfono" pattern="[0-9\+()]+" autocomplete="off">
                        </div>
                        <label>Correo:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <input type="email" class="form-control" name="correo" placeholder="Correo de Empleado" autocomplete="off" required>
                            <p class="text-danger m-auto">&nbsp;&nbsp;(*)</p>
                        </div>
                        <label>Seleccione área de trabajo:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <select class="form-control js-example-basic-single" name="tipo_area" required>
                                <option selected value="">Seleccionar área</option>
                                <option value="Oficina">Oficina</option>
                                <option value="Cocina">Cocina</option>
                                <option value="Caja">Caja</option>
                                <option value="Mozo/Azafata">Mozo/Azafata</option>
                                <option value="Delivery">Delivery</option>
                            </select>
                            <p class="text-danger m-auto">&nbsp;&nbsp;(*)</p>
                        </div>
                        <!-- <p class="text-danger">Datos requeridos <span class="badge badge-light text-danger">(*)</span></p> -->
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-danger btnCancelarModal" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;&nbsp;Cancelar</button>
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp;&nbsp;Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="mdlUdtEmpleados" data-backdrop="static"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-uppercase">
                    <h5 class="modal-title">Actualizar Empleado</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="frmActualizarEmpleado" method="post">
                    <div class="modal-body">
                        <input type="hidden" class="form-control" id="empleadoE" name="empleadoE" required>
                        <label>Nombre de empleado:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <input type="text" class="form-control" id="nombre_empleadoE" name="nombre_empleadoE" placeholder="Nombres del Empleado" autocomplete="off" pattern="[a-zA-Z\sñÑáéíóúÁÉÍÓÚ]+" required>
                            <p class="text-danger m-auto"> &nbsp;&nbsp;(*)</p>
                        </div>
                        <label>Tipo de documento:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <select class="form-control js-example-basic-single" id="tipo_docE" name="tipo_docE" required>
                                <option value="">Seleccione Tipo de Documento</option>
                                <option value="DNI">DNI</option>
                                <option value="Carnet de Extranjería">Carnet de Extranjería</option>
                                <option value="Pasaporte">Pasaporte</option>
                            </select>
                            <p class="text-danger m-auto">&nbsp;&nbsp;(*)</p>
                        </div>
                        <label>Número de documento:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <input type="text" class="form-control" id="numero_docE" name="numero_docE" placeholder="Numero documento" autocomplete="off" pattern="[0-9]+" required>
                            <p class="text-danger m-auto">&nbsp;&nbsp;(*)</p>
                        </div>
                        <label>Teléfono:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <input type="text" class="form-control" id="telefonoE" name="telefonoE" placeholder="Teléfono" pattern="[0-9\+()]+" autocomplete="off">
                        </div>
                        <label>Correo:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <input type="email" class="form-control" id="correoE" name="correoE" placeholder="Correo de Empleado" autocomplete="off" required>
                            <p class="text-danger m-auto">&nbsp;&nbsp;(*)</p>
                        </div>
                        <label>Seleccione área de trabajo:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <select class="form-control js-example-basic-single" id="tipo_areaE" name="tipo_areaE" required>
                                <option selected value="">Seleccionar área</option>
                                <option value="Oficina">Oficina</option>
                                <option value="Cocina">Cocina</option>
                                <option value="Caja">Caja</option>
                                <option value="Mozo/Azafata">Mozo/Azafata</option>
                                <option value="Delivery">Delivery</option>
                            </select>
                            <p class="text-danger m-auto">&nbsp;&nbsp;(*)</p>
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
</section>

<section>
    <div class="modal fade" id="mdlVisualizarCSalud" data-backdrop="static" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">DATOS DEL DOCUMENTO</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="btnResetDatossalud();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="frmRegistroCarnetSanidad" method="post">
                    <div class="modal-body">
                        <input type="hidden" class="form-control" id="carnedsanidad" name="carnedsanidad" required>
                        <input type="hidden" class="form-control" id="namedocumento" name="namedocumento">
                        <input type="hidden" class="form-control" id="token">
                        <label>Importar imagen de carnet de sanidad:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <input type="file" class="form-control" id="pdfcs" name="img_canet_sanidad" accept="application/pdf" required>
                            <p class="text-danger m-auto">&nbsp;&nbsp;(*)</p>
                        </div>
                        <!-- <p class="text-danger">Datos requeridos <span class="badge badge-light text-danger">(*)</span></p> -->
                        <!--<image class="embed-responsive-item" id="archivo_carnet_sanidad" frameborder="0" src="" width="100%" height="500"></image>-->
                        <iframe class="embed-responsive-item" id="archivo_carnet_sanidad" scrolling="no" frameborder="0" src="" width="100%" height="500"></iframe>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-angle-double-left"></i>&nbsp;&nbsp;Regesar</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fas fa-upload"></i> &nbsp;&nbsp;Subir Archivo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="mdlPsotulantesActivos" tabindex="-1" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-uppercase">
                    <h5 class="modal-title">Registrar Postulantes Aprobados</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="frmRegistroPostulantesActivos" method="post">
                    <div class="modal-body">
                        <label>Postulantes:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <select class="form-control js-example-basic-single-Aprobados" id="name_postulanteAct" name="name_postulanteAct" required>
                                <option selected value="">Seleccionar postulante</option>
                                <?php
                                $tabla='postulante';
                                $response = postulantecontroller::ctrListarPostulanteAprobados($tabla);
                                foreach($response as $key => $value):
                                ?>
                                <option value="<?php echo $value['nombres'] ?>"><?php echo $value['nombres'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <p class="text-danger m-auto">&nbsp;&nbsp;(*)</p>
                        </div>
                        <label>Tipo de documento:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <select class="form-control Select2" id="tipo_docPostulante" name="tipo_docPostulante" disabled required>
                                <option value="">Seleccione Tipo de Documento</option>
                                <option value="DNI">DNI</option>
                                <option value="Carnet de Extranjería">Carnet de Extranjería</option>
                                <option value="Pasaporte">Pasaporte</option>
                            </select>
                            <p class="text-danger m-auto">&nbsp;&nbsp;(*)</p>
                        </div>
                        <label>Número de documento:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <input type="text" class="form-control" id="numero_docPostulante" name="numero_docPostulante" placeholder="Numero documento" autocomplete="off" pattern="[0-9]+" disabled required>
                            <p class="text-danger m-auto">&nbsp;&nbsp;(*)</p>
                        </div>
                        <label>Teléfono:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <input type="text" class="form-control" id="telefonoPostulante" name="telefonoPostulante" placeholder="Telefono" pattern="[0-9\+()]+" autocomplete="off">                            
                        </div>
                        <label>Correo:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <input type="email" class="form-control" id="correoPostulante" name="correoPostulante" placeholder="Correo de Empleado" autocomplete="off" required>
                            <p class="text-danger m-auto">&nbsp;&nbsp;(*)</p>
                        </div>
                        <label>Seleccione área de trabajo:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <select class="form-control js-example-basic-single" id="tipo_areaPostulante" name="tipo_areaPostulante" disabled required>
                                <option selected value="">Seleccionar área</option>
                                <option value="Oficina">Oficina</option>
                                <option value="Cocina">Cocina</option>
                                <option value="Caja">Caja</option>
                                <option value="Mozo/Azafata">Mozo/Azafata</option>
                                <option value="Delivery">Delivery</option>
                            </select>
                            <p class="text-danger m-auto">&nbsp;&nbsp;(*)</p>
                        </div>
                        <!-- <p class="text-danger">Datos requeridos <span class="badge badge-light text-danger">(*)</span></p> -->
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-danger btnCancelarModal" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;&nbsp;Cancelar</button>
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp;&nbsp;Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>