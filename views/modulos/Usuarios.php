<section>
    <div class="box">
        <div class="container-fluid">
            <div class="box-header with-border">
                <h4 class="box-title titletablas">Lista de usuarios</h4>
            </div>
            
                <div class="box-body">
                <div style="padding-bottom: 13px;">
                <button type="button" class="btn btn-primary active" data-toggle="modal"  onclick="resetuser()" data-target="#mdlUsuario">
                <i class="fa fa-solid fa-user-plus"></i>&nbsp;&nbsp;Registrar
                </button>
                <br>
            </div>
                    <div class="table-responsive">
                        <table class="table text-center table-bordered table-light table-hover" id="tbl_usuario" width="100%" cellspacing="0">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Id</th>
                                    <th>Cargo</th>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>Local</th>
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
    <div class="modal fade" id="mdlUsuario" tabindex="-1" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">REGISTRAR USUARIO</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="frmRegistroUsuario" method="post">
                    <div class="modal-body">
                        <label for="">Empleado:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <select class="js-example-basic-single-user form-control w-100" id="empleado" name="empleado" required>
                                <option value="" selected>Seleccione Empleado</option>
                                <?php
                                $tabla = 'empleado';
                                $respuesta = empleadoscontroller::ctrListarEmpleadosActivos($tabla);
                                foreach ($respuesta as $key => $value) :
                                ?>
                                    <option value="<?php echo $value['id_empleado'] ?>"><?php echo $value['nombres'] ?> || <?php echo $value['area'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <p class="text-danger m-auto">(*)</p>
                        </div>
                        <label for="">Correo</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <input type="email" class="form-control" id="correoUsuario" placeholder="Correo del Empleado" autocomplete="off" required disabled>
                        </div>
                        <p class="text-danger" id="rpt_correo"></p>
                        <label for="">Rol de usuario</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <select class="form-control Select2" name="rol" id="rol" required>
                                <option value="">Seleccione rol</option>
                                <option value="Administrador General">Administrador General</option>
                                <option value="Administrador">Administrador</option>
                                <option value="Mozo/Azafata">Mozo/Azafata</option>
                                <option value="Jefe de Cocina">Jefe de Cocina</option>
                                <option value="Counte en caja">Counte en caja</option>
                                <option value="Delivery motorizado">Delivery motorizado</option>
                            </select>
                            <p class="text-danger m-auto">(*)</p>
                        </div>
                        <label for="">Sede:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <select class="form-control Select2" name="sede" id="sede" required disabled>
                                <option value="">selecione sede</option>
                                <?php
                                $tabla = 'local_empleado';
                                $respuesta = localcontroller::ctrListarLocalesEmpleado($tabla);
                                foreach ($respuesta as $key => $value) :
                                ?>
                                    <option value="<?php echo $value['id_localemple'] ?>"><?php echo $value['sede'] ?> || <?php echo $value['direccion'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <p class="text-danger m-auto">(*)</p>
                        </div>
                        <p class="text-danger" id="rpt_sede"></p>
                        <label for="">Contraseña:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <input type="password" class="form-control" id="contraseña" name="contraseña" placeholder="Contraseña" autocomplete="off" required>
                            <p class="text-danger m-auto">(*)</p>
                        </div>
                        <label for="">Repetir contraseña:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <input type="password" class="form-control" id="repeatcontraseña" name="repeatcontraseña" placeholder="Repetir contraseña" oninput="checkUser(this)" autocomplete="off" required>
                            <script language='javascript' type='text/javascript'>
                                function checkUser(input) {
                                    if (input.value != document.getElementById('contraseña').value) {
                                        input.setCustomValidity('Las contraseñas no coinciden.');
                                    } else {
                                        // input is valid -- reset the error message
                                        input.setCustomValidity('');
                                    }
                                }
                            </script>
                            <p class="text-danger m-auto">(*)</p>
                        </div>
                    </div>
                    <div class=" modal-footer">
                        <button type="button" class="btn btn-danger btnCancelarModal" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;&nbsp;Cancelar</button>
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp;&nbsp;Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="mdlUdpUsuario" tabindex="-1" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">ACTUALIZAR USUARIO</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="frmActualizarUsuario" method="post">
                    <input type="hidden" name="Usuarios" id="Usuarios">
                    <div class="modal-body">
                        <label for="">Empleado:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <select class="form-control js-example-basic-single-Udpuser" id="Udpempleado" name="Udpempleado" required>
                                <option value="" selected>Seleccione Empleado</option>
                                <?php
                                $tabla = 'empleado';
                                $respuesta = empleadoscontroller::ctrListarEmpleadosActivos($tabla);
                                foreach ($respuesta as $key => $value) :
                                ?>
                                    <option value="<?php echo $value['id_empleado'] ?>"><?php echo $value['nombres'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <p class="text-danger m-auto">(*)</p>
                        </div>
                        <label for="">Correo</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <input type="email" class="form-control" id="UdpcorreoUsuario" name="UdpcorreoUsuario" placeholder="Correo del Empleado" autocomplete="off" required disabled>
                        </div>
                        <p class="text-danger" id="rpt_Udpcorreo"></p>
                        <label for="">Rol de usuario</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <select class="form-control Select2" id="Udprol" name="Udprol" required>
                                <option value="">seleccione rol</option>
                                <option value="Administrador General">Administrador General</option>
                                <option value="Administrador">Administrador</option>
                                <option value="Azafata/Mozo">Azafata/Mozo</option>
                                <option value="Jefe de Cocina">Jefe de Cocina</option>
                                <option value="Counte en caja">Counte en caja</option>
                                <option value="Delivery motorizado">Delivery motorizado</option>
                            </select>
                            <p class="text-danger m-auto">(*)</p>
                        </div>
                        <label for="">Sede:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <select class="form-control Select2" id="Udpsede" name="Udpsede" required disabled>
                                <option value="">selecione sede</option>
                                <?php
                                $tabla = 'local_empleado';
                                $respuesta = localcontroller::ctrListarLocalesEmpleado($tabla);
                                foreach ($respuesta as $key => $value) :
                                ?>
                                    <option value="<?php echo $value['id_localemple'] ?>"><?php echo $value['sede'] ?> || <?php echo $value['direccion'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <p class="text-danger m-auto">(*)</p>
                        </div>
                        <label for="">Contraseña:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <input type="password" class="form-control" id="Udpcontraseña" name="Udpcontraseña" placeholder="Contraseña" autocomplete="off" required>
                            <p class="text-danger m-auto">(*)</p>
                        </div>
                        <label for="">Repetir contraseña:</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-check"></i></span>
                            </div>
                            <input type="password" class="form-control" id="Udprepeatcontraseña" name="Udprepeatcontraseña" placeholder="Repetir contraseña" oninput="checkUserUdp(this)" autocomplete="off" required>
                            <script language='javascript' type='text/javascript'>
                                function checkUserUdp(input) {
                                    if (input.value != document.getElementById('Udpcontraseña').value) {
                                        input.setCustomValidity('Las contraseñas no coinciden.');
                                    } else {
                                        // input is valid -- reset the error message
                                        input.setCustomValidity('');
                                    }
                                }
                            </script>
                            <p class="text-danger m-auto">(*)</p>
                        </div>
                    </div>
                    <div class=" modal-footer">
                        <button type=" button" class="btn btn-danger btnCancelarModal" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;&nbsp;Cancelar</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>&nbsp;&nbsp;Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>