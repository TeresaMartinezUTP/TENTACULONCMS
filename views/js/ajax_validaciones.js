$(document).ready(function () {
    /**Modulo Empleados*/
    $('#frmRegistroCarnetSanidad').submit(function (e) {
        e.preventDefault();
        var datos = new FormData(this);
        $.ajax({
            url: "ajax/SessionAjaxEmpleado/empleado_ajax.php",
            type: "post",
            data: datos,
            dataType: 'json',
            contentType: false,
            processData: false,
            error(e) {
                swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
            }
        }).done(function (respuesta) {
            $data = respuesta.responseJson;
            if ($data == 'adjuntado') {
                toastr.success('Archivo Adjuntado');
                $('form#frmRegistroCarnetSanidad')[0].reset();
                btnCarnetSanidad($('#token').val())
                $("#mdlVisualizarCSalud").modal("hide");
            } else if ($data == 'noImage') {
                toastr.warning('Sólo se permiten archivos pdf');
            } else {
                if ($data == 'error') {
                    swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
                }
            }
        });
    });
    $('#frmRegistroEmpleado').submit(function (e) {
        e.preventDefault();
        var $form = $(this);
        datos = $form.serialize();
        $.ajax({
            url: "ajax/SessionAjaxEmpleado/empleado_ajax.php",
            type: "post",
            data: datos,
            dataType: 'json',
            error(e) {
                swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
            }
        }).done(function (respuesta) {
            $data = respuesta.responseJson;
            if ($data == 'guardado') {
                toastr.success('Los datos fueron "Registrados"');
                tblEmpleado.ajax.reload();
                $('#frmRegistroEmpleado')[0].reset();
                $(".js-example-basic-single").val(null).trigger('change');
            } else if ($data == 'repeat') {
                toastr.warning('Upss!, el DNI o la dirección de correo ya se encuentra registrada');
            } else {
                if ($data == 'error') {
                    swal.fire('ERROR!!!', 'Algo salio mal consulte al programador del sistema');
                }
            }
        });
    });
    $('#frmActualizarEmpleado').submit(function (e) {
        e.preventDefault();
        var $form = $(this);
        datos = $form.serialize();
        $.ajax({
            url: "ajax/SessionAjaxEmpleado/empleado_ajax.php",
            type: "post",
            data: datos,
            dataType: 'json',
        }).done(function (respuesta) {
            $data = respuesta.responseJson;
            if ($data == 'actualizado') {
                toastr.info('Los datos fueron "Actualizados"');
                tblEmpleado.ajax.reload();
                $("#mdlUdtEmpleados").modal("hide");
                $(".js-example-basic-single").val(null).trigger('change');
                $('form#frmActualizarEmpleado')[0].reset();
            } else if ($data == 'repeat') {
                toastr.warning('Upss!, el DNI ya se encuentra registrado');
            } else {
                if ($data == 'error') {
                    swal.fire('ERROR!!!', 'Algo salio mal consulte al programador del sistema');
                }
            }
        });
    });
    $('#frmRegistroPostulantesActivos').submit(function (e) {
        e.preventDefault();
        var $form = $(this);
        $("#tipo_docPostulante").prop('disabled', false);
        $("#numero_docPostulante").prop('disabled', false);
        $("#tipo_areaPostulante").prop('disabled', false);
        datos = $form.serialize();
        $("#tipo_docPostulante").prop('disabled', true);
        $("#numero_docPostulante").prop('disabled', true);
        $("#tipo_areaPostulante").prop('disabled', true);
        $.ajax({
            url: "ajax/SessionAjaxEmpleado/empleado_ajax.php",
            type: "post",
            data: datos,
            dataType: 'json',
            error(e) {
                swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
            }
        }).done(function (respuesta) {
            $data = respuesta.responseJson;
            if ($data == 'guardado') {
                //alertify.success('Registrado Exitosamente');
                toastr.success('Los datos fueron "Registrados"');
                tblEmpleado.ajax.reload();
                $('#frmRegistroPostulantesActivos')[0].reset();
                $(".js-example-basic-single-Aprobados").val(null).trigger('change');
                $(".js-example-basic-single").val(null).trigger('change');
                $(".js-example-basic-single-Aprobados").load(location.href + " .js-example-basic-single-Aprobados > *");
            } else if ($data == 'repeat') {
                toastr.warning('Upss!, el DNI ya se encuentra registrado');
            } else {
                if ($data == 'error') {
                    swal.fire('ERROR!!!', 'Algo salio mal consulte al programador del sistema');
                }
            }
        });
    });
    /**Modulo Postulante */
    $('#frmRegistroCurriculumVitae').submit(function (e) {
        e.preventDefault();
        var datos = new FormData(this);
        $.ajax({
            url: "ajax/SessionAjaxPostulante/postulante_ajax.php",
            type: "post",
            data: datos,
            dataType: 'json',
            contentType: false,
            processData: false,
            error(e) {
                swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
            }
        }).done(function (respuesta) {
            $data = respuesta.responseJson;
            if ($data == 'adjuntado') {
                toastr.success('Archivo Adjuntado');
                $('form#frmRegistroCurriculumVitae')[0].reset();
                btnEnviaDatosCV($('#tokenCV').val())
            } else if ($data == 'noImage') {
                toastr.warning('Sólo se permiten archivos pdf');
            } else {
                if ($data == 'error') {
                    swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
                }
            }
        });
    });
    $('#frmRegistroPostulante').submit(function (e) {
        e.preventDefault();
        var $form = $(this);
        datos = $form.serialize();
        $.ajax({
            url: "ajax/SessionAjaxPostulante/postulante_ajax.php",
            type: "post",
            data: datos,
            dataType: 'json',
            error(e) {
                swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
            }
        }).done(function (respuesta) {
            $data = respuesta.responseJson;
            if ($data == 'guardado') {
                toastr.success('Los datos fueron "Registrados"');
                tblPostulante.ajax.reload();
                $(".js-example-basic-single").val(null).trigger('change');
                $('#frmRegistroPostulante')[0].reset();
            } else if ($data == 'repeat') {
                toastr.warning('Upss!, el DNI ya se encuentra registrado');
            }else if ($data == 'repeatcorreo') {
                toastr.warning('Upss!, la dirección de correo ya se encuentra registrada');
            }  else {
                if ($data == 'error') {
                    swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
                }
            }
        });
    });
    $('#frmActualizarPostulante').submit(function (e) {
        e.preventDefault();
        var $form = $(this);
        datos = $form.serialize();
        $.ajax({
            url: "ajax/SessionAjaxPostulante/postulante_ajax.php",
            type: "post",
            data: datos,
            dataType: 'json',
        }).done(function (respuesta) {
            $data = respuesta.responseJson;
            if ($data == 'actualizado') {
                toastr.info('Los datos fueron "Actualizados"');
                tblPostulante.ajax.reload();
                $("#mdlUdtPostulantes").modal("hide");
                $(".js-example-basic-single").val(null).trigger('change');
                $('#frmActualizarPostulante')[0].reset();
            } else if ($data == 'repeat') {
                toastr.warning('Upss!, el DNI ya se encuentra registrado');
            } else if ($data == 'repeatcorreo') {
                toastr.warning('Upss!, la dirección de correo ya se encuentra registrada');
            }else {
                if ($data == 'error') {
                    alertify.warnig('Upss! Hubo un error inesperado');
                }
            }
        });
    });
    /**Modulo Usuarios */
    $('#frmRegistroUsuario').submit(function (e) {
        e.preventDefault();
        $('#correoUsuario').attr('disabled', false);
        $('#sede').attr('disabled', false);
        var $data = $(this).serialize();
        $('#correoUsuario').attr('disabled', true);
        $('#sede').attr('disabled', true);
        $.ajax({
            type: 'post',
            url: 'ajax/SessionAjaxUsuarios/usuarios_ajax.php',
            data: $data,
            dataType: 'json',
            error(e) {
                swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
            }
        }).done(function (respuesta) {
            $data = respuesta.responseJson;
            if ($data == 'guardado') {
                toastr.success('Los datos fueron "Registrados"');
                tblUsuarios.ajax.reload();
                $('form#frmRegistroUsuario')[0].reset();
                setTimeout(function () {
                    $(".js-example-basic-single-user").val('').trigger('change')
                }, 500);
            } else if ($data == 'repeat') {
                toastr.warning('El personal ya cuenta con cuenta de usuario');
            } else {
                if ($data == 'error') {
                    swal.fire('Error', 'Algo salio mal consulte al programador del sistema');

                }
            }
        });
    });

    $('form#frmActualizarUsuario').submit(function (e) {
        e.preventDefault();
        $('#UdpcorreoUsuario').attr('disabled', false);
        $('#Udpsede').attr('disabled', false);
        var $form = $(this);
        datos = $form.serialize();
        $('#UdpcorreoUsuario').attr('disabled', true);
        $('#Udpsede').attr('disabled', true);
        $.ajax({
            url: "ajax/SessionAjaxUsuarios/usuarios_ajax.php",
            type: "post",
            data: datos,
            dataType: 'json',
            error(e) {
                swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
            }
        }).done(function (respuesta) {
            $data = respuesta.responseJson;
            if ($data == 'actualizado') {
                toastr.info('Los datos fueron "Actualizados"');
                tblUsuarios.ajax.reload();
                $('form#frmActualizarUsuario')[0].reset();
                $("#mdlUdpUsuario").modal("hide");
                $(".js-example-basic-single").val(null).trigger('change');
            } else {
                if ($data == 'error') {
                    swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
                }
            }
        });
    });

    /**Modulo Local */
    $('#frmRegistroLocal').submit(function (e) {
        e.preventDefault();
        var $data = $(this).serialize();
        $.ajax({
            type: 'post',
            url: 'ajax/SessionAjaxLocal/locales_ajax.php',
            data: $data,
            dataType: 'json',
            error(e) {
                swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
            }
        }).done(function (respuesta) {
            $data = respuesta.responseJson;
            if ($data == 'guardado') {
                toastr.success('Los datos fueron "Registrados"');
                tblLocal.ajax.reload();
                $('form#frmRegistroLocal')[0].reset();
            } else if ($data == 'repeat') {
                toastr.warning('Ya existe un código asignado a esta dirección');
            } else {
                if ($data == 'error') {
                    swal.fire('Error', 'Algo salio mal consulte al programador del sistema');

                }
            }
        });
    });
    $('#frmActualizarLocal').submit(function (e) {
        e.preventDefault();
        var $data = $(this).serialize();
        $.ajax({
            url: "ajax/SessionAjaxLocal/locales_ajax.php",
            type: "post",
            data: $data,
            dataType: 'json',
            error(e) {
                swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
            }
        }).done(function (respuesta) {
            $data = respuesta.responseJson;
            if ($data == 'actualizado') {
                toastr.info('Los datos fueron "Actualizados"');
                tblLocal.ajax.reload();
                $('form#frmActualizarLocal')[0].reset();
                $("#mdlUdpLocal").modal("hide");
            } else {
                if ($data == 'error') {
                    swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
                }
            }
        });
    });
    /**Modulo Local Platos*/
    $('#frmRegistroLocalPlatos').submit(function (e) {
        e.preventDefault();
        var $form = $(this);
        datos = $form.serialize();
        $.ajax({
            url: "ajax/SessionAjaxLocalPlatos/localplatos_ajax.php",
            type: "post",
            data: datos,
            dataType: 'json',
            error(e) {
                swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
            }
        }).done(function (respuesta) {
            $data = respuesta.response;
            if ($data == 'guardado') {
                alertify.success('Registrado Exitosamente');
                tblPlatoLocal.ajax.reload();
                $('form#frmRegistroLocalPlatos')[0].reset();
                $(".js-example-basic-single").val(null).trigger('change');
            } else if ($data == 'repeat') {
                toastr.warning('La sede ya cuenta con el plato seleccionado');
            } else {
                if ($data == 'error') {
                    swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
                }
            }
        });
    });

    $('form#frmActualizarLocalPlato').submit(function (e) {
        e.preventDefault();
        var $form = $(this);
        datos = $form.serialize();
        $.ajax({
            url: "ajax/SessionAjaxLocalPlatos/localplatos_ajax.php",
            type: "post",
            data: datos,
            dataType: 'json',
            error(e) {
                swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
            }
        }).done(function (respuesta) {
            $data = respuesta.response;
            if ($data == 'actualizado') {
                toastr.info('Datos Actualizados');
                tblPlatoLocal.ajax.reload();
                $("#mdlActualizarLocalPlato").modal("hide");
                $(".js-example-basic-single").val(null).trigger('change');
            } else if ($data == 'repeat') {
                toastr.warning('La sede ya cuenta con el plato seleccionado');
            } else {
                if ($data == 'error') {
                    swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
                }
            }
        });
    });

    /**Modulo Local Empleados*/
    $('#frmRegistroLocalEmpleado').submit(function (e) {
        e.preventDefault();
        var $form = $(this);
        datos = $form.serialize();
        $.ajax({
            url: "ajax/SessionAjaxLocalEmpleado/localempleado_ajax.php",
            type: "post",
            data: datos,
            dataType: 'json',
            error(e) {
                swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
            }
        }).done(function (respuesta) {
            $data = respuesta.responseJson;
            if ($data == 'guardado') {
                toastr.success('Los datos fueron "Registrados"');
                tblLocalEmpleado.ajax.reload();
                $(".js-example-basic-single").val(null).trigger('change');
                $('form#frmRegistroLocalEmpleado')[0].reset();
            } else if ($data == 'repeat') {
                toastr.warning('El empleado ya se encuentra registrado en una sede')
            } else {
                if ($data == 'error') {
                    swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
                }
            }
        });
    });
    $('form#frmActualizarLocalEmpleado').submit(function (e) {
        e.preventDefault();
        var $form = $(this);
        datos = $form.serialize();
        $.ajax({
            url: "ajax/SessionAjaxLocalEmpleado/localempleado_ajax.php",
            type: "post",
            data: datos,
            dataType: 'json',
            error(e) {
                swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
            }
        }).done(function (respuesta) {
            $data = respuesta.responseJson;
            if ($data == 'actualizado') {
                toastr.info('Los datos fueron "Actualizados"');
                tblLocalEmpleado.ajax.reload();
                $(".js-example-basic-single").val(null).trigger('change');
                $("#mdlActualizarLocalEmpleado").modal("hide");
            } else if ($data == 'repeat') {
                toastr.warning('El empleado ya se encuentra registrado en una sede')
            } else {
                if ($data == 'error') {
                    swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
                }
            }
        });
    });
    /**Modulo categoria platos */
    $('#frmRegistroCatePlato').submit(function (e) {
        e.preventDefault();
        if ($("#imagenCategoriaPlato").val() == "") {
            alertify.error("Debe ingresar una imagen");
        } else {
            var datos = new FormData(this);
            $.ajax({
                url: "ajax/SessionAjaxCategoriaPlatos/categoriaplatos_ajax.php",
                type: "post",
                data: datos,
                dataType: 'json',
                contentType: false,
                processData: false,
                error(e) {
                    swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
                }
            }).done(function (respuesta) {
                $data = respuesta.responseJson;
                if ($data == 'guardado') {
                    toastr.success('Los datos fueron "Registrados"');
                    tblCategoriaPlato.ajax.reload();
                    $('form#frmRegistroCatePlato')[0].reset();
                    deleteimgCategoria();
                } else if ($data == 'repeat') {
                    toastr.warning('La categoría ya existe en la lista de registro');
                } else {
                    if ($data == 'error') {
                        swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
                    }
                }
            });
        }
    });

    $('form#frmActualizarCatePlato').submit(function (e) {
        e.preventDefault();
        var datos = new FormData(this);
        $.ajax({
            url: "ajax/SessionAjaxCategoriaPlatos/categoriaplatos_ajax.php",
            type: "post",
            data: datos,
            dataType: 'json',
            mimeType: "multipart/form-data",
            contentType: false,
            processData: false,
            error(e) {
                swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
            }
        }).done(function (respuesta) {
            $data = respuesta.responseJson;
            if ($data == 'actualizado') {
                toastr.info('Los datos fueron "Actualizados"');
                tblCategoriaPlato.ajax.reload();
                $("#mdlActualizarCatePlato").modal("hide");
            } else {
                if ($data == 'error') {
                    swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
                }
            }
        });
    });

    /**Modulo platos */
    $('#frmRegistroPlatos').submit(function (e) {
        e.preventDefault();

        if ($("#imagenPlato").val() == "") {
            alertify.error("Debe ingresar una imagen");
        } else {
            datos = new FormData(this);
            $.ajax({
                url: "ajax/SessionAjaxPlatos/platos_ajax.php",
                type: "post",
                data: datos,
                dataType: 'json',
                mimeType: "multipart/form-data",
                contentType: false,
                processData: false,
                error(e) {
                    swal.fire('Error', 'Algo salio mal consulte al programador del sistema',);
                }
            }).done(function (respuesta) {
                $data = respuesta.responseJson;
                if ($data == 'guardado') {
                    toastr.success('Los datos fueron "Registrados"');
                    tblPlatos.ajax.reload();
                    $('form#frmRegistroPlatos')[0].reset();
                    $(".js-example-basic-single").val(null).trigger('change');
                    deleteimgPlato();
                } else if ($data == 'repeat') {
                    toastr.warning('El plato ya existe en la lista de registro');
                } else {
                    if ($data == 'error') {
                        deleteimgPlato
                        swal.fire('Error', 'Algo salio mal consulte al programador del sistema',);
                    }
                }
            });
        }
    });

    $('form#frmActualizarPlatos').submit(function (e) {
        e.preventDefault();
        datos = new FormData(this);
        $.ajax({
            url: "ajax/SessionAjaxPlatos/platos_ajax.php",
            type: "post",
            data: datos,
            dataType: 'json',
            mimeType: "multipart/form-data",
            contentType: false,
            processData: false,
            error(e) {
                swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
            }
        }).done(function (respuesta) {
            $data = respuesta.responseJson;
            if ($data == 'actualizado') {
                toastr.info('Los datos fueron "Actualizados"');
                tblPlatos.ajax.reload();
                $('form#frmActualizarPlatos')[0].reset();
                $(".js-example-basic-single").val(null).trigger('change');
                $("#mdlActualizarPlatos").modal("hide");
            } else {
                if ($data == 'error') {
                    swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
                }
            }
        });
    });

    /**Modulo Bebidas */
    $('#frmRegistroBebida').submit(function (e) {
        e.preventDefault();
        var $formr = document.getElementById('frmRegistroBebida');
        var datos = new FormData($formr);

        $.ajax({
            url: "ajax/SessionAjaxBebidas/bebidas_ajax.php",
            type: "post",
            data: datos,
            dataType: 'json',
            contentType: false,
            processData: false,
            error(e) {
                swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
            }
        }).done(function (respuesta) {
            $data = respuesta.responseJson;
            if ($data == 'guardado') {
                toastr.success('Los datos fueron "Registrados"');
                tblBebidas.ajax.reload();
                $('form#frmRegistroBebida')[0].reset();
                deleteimgBebida();
            } else if ($data == 'repeat') {
                toastr.warning('La bebida ya existe en la lista de registro');
            } else {
                if ($data == 'error') {
                    swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
                }
            }
        });
    });

    $('form#frmActualizarBebida').submit(function (e) {
        e.preventDefault();
        var datos = new FormData(this);
        $.ajax({
            url: "ajax/SessionAjaxBebidas/bebidas_ajax.php",
            type: "post",
            data: datos,
            dataType: 'json',
            mimeType: "multipart/form-data",
            contentType: false,
            processData: false,
            error(e) {
                swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
            }
        }).done(function (respuesta) {
            $data = respuesta.responseJson;
            if ($data == 'actualizado') {
                toastr.info('Los datos fueron "Actualizados"');
                tblBebidas.ajax.reload();
                $('form#frmActualizarBebida')[0].reset();
                $("#mdlActualizarBebida").modal("hide");
            } else {
                if ($data == 'error') {
                    swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
                }
            }
        });
    });

});


/**Modulo Empleados*/
function btnCarnetSanidad($empleadocs) {
    $('#pdfcs').val("");
    $.ajax({
        url: "ajax/SessionAjaxEmpleado/empleado_ajax.php",
        type: "post",
        data: "id_empleado=" + $empleadocs,
        dataType: 'json',
        error(e) {
            swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
        }
    }).done(function (respuesta) {
        $data = respuesta;
        $('#carnedsanidad').val($data['id_empleado']);
        $('#namedocumento').val($data['documento']);
        $('#token').val($empleadocs);   
        if ($data['documento'] == "" || $data['documento'] == null) {
            $('#archivo_carnet_sanidad').attr('hidden', true);
            $('#archivo_carnet_sanidad').attr('src', 'views/DocumentoSalud/carnet_sanidad.jpg');
        } else {
            $('#archivo_carnet_sanidad').attr('hidden', false);
            $('#archivo_carnet_sanidad').attr('src', 'views/DocumentoSalud/' + $data['documento']);
        }
    });
}
function btnEditarEmpleado(id_empleado) {
    $.ajax({
        url: "ajax/SessionAjaxEmpleado/empleado_ajax.php",
        type: "post",
        data: "id_empleado=" + id_empleado,
        dataType: 'json',
        error(e) {
            swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
        }
    }).done(function (respuesta) {
        $data = respuesta;
        $('#empleadoE').val($data['id_empleado']);
        $('#nombre_empleadoE').val($data['nombres']);
        $('#tipo_docE').val($data['tipo_doc']).trigger('change');
        $('#numero_docE').val($data['num_doc']);
        $('#telefonoE').val($data['telefono']);
        $('#correoE').val($data['correo']);
        $('#tipo_areaE').val($data['area']).trigger('change');
    });
}
function btnEliminarEmpleado(id_empleadoElm) {
    Swal.fire({
        title: 'Estás seguro de eliminar el empleado?',
        text: "Se eliminará el empleado seleccionado!!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "ajax/SessionAjaxEmpleado/empleado_ajax.php",
                type: "post",
                data: "id_empleadoElm=" + id_empleadoElm,
                dataType: "json",
                error(e) {
                    swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
                }
            }).done(function (respuesta) {
                
                if (respuesta.responseJson == 'tienele') {
                    toastr.warning('Upss! El empleado está registrado en un local');          
                }
                else if (respuesta.responseJson == "eliminado") {
                    Swal.fire(
                        'Eliminado!',
                        'El empleado seleccionado fue eliminado.',
                        'success'
                    )
                    tblEmpleado.ajax.reload();
                } else {
                    if (respuesta.responseJson == 'error') {
                        swal.fire('ERROR!!!', 'Algo salio mal consulte al programador del sistema');
                    }
                }
            })
        } else {
            toastr.error('Canceló la operación');          
        }
    })
}
function btnAusenteEmpleado(id_empleados) {
    $ausente = 'Ausente';
    $.ajax({
        url: "ajax/SessionAjaxEmpleado/empleado_ajax.php",
        type: "post",
        data: { id_estado: id_empleados, estado: $ausente },
        dataType: 'json',
        error(e) {
            swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
        }
    }).done(function (respuesta) {
        $data = respuesta.responseJson;
        if ($data == "true") {
            toastr.warning('Estado del empleado cambio a "Ausente"');
            tblEmpleado.ajax.reload();
        } else {
            if ($data == 'error') {
                swal.fire('ERROR!!!', 'Algo salio mal consulte al programador del sistema');
            }
        }
    });
}

function btnInactivoEmpleado(id_empleados) {
    $inactivo = 'Inactivo';
    $.ajax({
        url: "ajax/SessionAjaxEmpleado/empleado_ajax.php",
        type: "post",
        data: { id_estado: id_empleados, estado: $inactivo },
        dataType: 'json',
        error(e) {
            swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
        }
    }).done(function (respuesta) {
        $data = respuesta.responseJson;
        console.log($data);
        if ($data == "true") {
            toastr.warning('Estado del empleado cambio a "Inactivo"');
            tblEmpleado.ajax.reload();
            tblUsuarios.ajax.reload();
            $(".js-example-basic-single-user").load(location.href + " .js-example-basic-single-user > *");
        } else {
            if ($data == 'error') {
                swal.fire('ERROR!!!', 'Algo salio mal consulte al programador del sistema');
            }
        }
    });
}
function btnReingresarEmpleado(id_empleados) {
    $activar = 'Activo';
    Swal.fire({
        title: 'Estás seguro en reingresar Empleado?',
        text: "Se reingresará al Empleado!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Reingresar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "ajax/SessionAjaxEmpleado/empleado_ajax.php",
                type: "post",
                data: { id_estado: id_empleados, estado: $activar },
                dataType: 'json',
                error(e) {
                    swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
                }
            }).done(function (respuesta) {
                $data = respuesta.responseJson;
                console.log($data);
                if ($data == "true") {
                    Swal.fire(
                        'Reingresado!',
                        'El Empleado fue reingresado...',
                        'success'
                    )
                    tblEmpleado.ajax.reload();
                    tblUsuarios.ajax.reload();
                    $(".js-example-basic-single-user").load(location.href + " .js-example-basic-single-user > *");
                    $("#id_empleadosEditar").load(location.href + " #id_empleadosEditar > *");
                } else {
                    if ($data == 'error') {
                        swal.fire('ERROR!!!', 'Algo salio mal consulte al programador del sistema');
                    }
                }
            })
        } else {
            toastr.error('Canceló la operación');          
        }
    });
}

$('#name_postulanteAct').on('change', function () {
    $aprobados = 'Aporbados'
    $.ajax({
        url: 'ajax/SessionAjaxPostulante/postulante_ajax.php',
        type: 'post',
        data: { postulantesAprobados: $aprobados },
        dataType: 'json',
        error(e) {
            swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
        }
    }).done(function (e) {
        $('#tipo_docPostulante').val(e[0]['tipo_doc']).trigger('change');
        $('#numero_docPostulante').val(e[0]['num_doc']);
        $('#telefonoPostulante').val(e[0]['telefono']);
        $('#correoPostulante').val(e[0]['correo']);
        $('#tipo_areaPostulante').val(e[0]['area']).trigger('change');
    })
});

/*Modulo Postulante */
function btnEnviaDatosCV($postulantes) {
    $('#pdfcv').val("");
    $.ajax({
        url: "ajax/SessionAjaxPostulante/postulante_ajax.php",
        type: "post",
        data: "id_postu=" + $postulantes,
        dataType: 'json',
        error(e) {
            swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
        }
    }).done(function (respuesta) {
        $data = respuesta;
        $('#curriculumvitae').val($data['id_postulante']);
        $('#namedocumentovitae').val($data['documento']);
        $('#tokenCV').val($postulantes);
        if ($data['documento'] == "" || $data['documento'] == null) {
            $('#archivo_curriculum_vitae').attr('hidden', true);
            $('#urlcv').removeAttr('href');
            $('#urlcv').removeAttr('download');
        } else {
            let extension = obtenerExtension($data['documento']); //.png
            $('#urlcv').attr('href', 'views/Curriculum/' +$data['documento']);
            $('#urlcv').attr('download', $data['documento']);
            let img = [".jpg", ".jpeg", ".png"];
            if(img.indexOf(extension) != -1){
                $('#archivo_curriculum_vitae').attr('hidden', true);
                $('#imgCV').attr('hidden', false);
                $("#imgCV").attr('src', 'views/Curriculum/' + $data['documento']);
                console.log("es una imagen");
            } else if(extension == ".pdf"){
                $('#imgCV').attr('hidden', true);
                $('#archivo_curriculum_vitae').attr('hidden', false);
                $('#archivo_curriculum_vitae').attr('src', 'views/Curriculum/' + $data['documento']);
                console.log("es un pdf");
            }
            else{
                $('#imgCV').attr('hidden', true);
                $('#archivo_curriculum_vitae').attr('hidden', false);
                $('#archivo_curriculum_vitae').attr('src', 'http://docs.google.com/gview?url=views/Curriculum/' + $data['documento'] + '&embedded=true');
            }
            console.log(extension);
        }

    });
}

function obtenerExtension(documento) {
    var ultimo_punto = documento.lastIndexOf(".");
    var extension = documento.slice(ultimo_punto, documento.length);
    return extension;
}

function btnEditarPostulante(id_postu) {
    $.ajax({
        url: "ajax/SessionAjaxPostulante/postulante_ajax.php",
        type: "post",
        data: "id_postu=" + id_postu,
        dataType: 'json',
        error(e) {
            swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
        }
    }).done(function (respuesta) {
        $data = respuesta;
        $('#postularE').val($data['id_postulante']);
        $('#area_postularE').val($data['area']).trigger('change');
        $('#nombre_postularE').val($data['nombres']);
        $('#tipodoc_postularE').val($data['tipo_doc']).trigger('change');
        $('#numdoc_postularE').val($data['num_doc']);
        $('#telefono_postularE').val($data['telefono']);
        $('#correo_postularE').val($data['correo']);
    });
}
function btnAprobadoPostulante(postulante) {
    $estado = 'Aprobado'
    $.ajax({
        url: "ajax/SessionAjaxPostulante/postulante_ajax.php",
        type: "post",
        data: { postulante: postulante, estado: $estado },
        dataType: 'json',
        error(e) {
            swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
        }
    }).done(function (respuesta) {
        $data = respuesta.responseJson;
        if ($data == "true") {
            toastr.warning('Estado del empleado cambio a "Aprobado"');
            tblPostulante.ajax.reload();
        } else {
            if ($data == 'error') {
                swal.fire('ERROR!!!', 'Algo salio mal consulte al programador del sistema');
            }
        }
    });
}
function btnDesaprobadoPostulante(postulante) {
    $estado = 'Desaprobado'
    $.ajax({
        url: "ajax/SessionAjaxPostulante/postulante_ajax.php",
        type: "post",
        data: { postulante: postulante, estado: $estado },
        dataType: 'json',
        error(e) {
            swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
        }
    }).done(function (respuesta) {
        $data = respuesta.responseJson;
        if ($data == "true") {
            toastr.warning('Estado del empleado cambio a "Desaprobado"');
            tblPostulante.ajax.reload();
        } else {
            if ($data == 'error') {
                swal.fire('ERROR!!!', 'Algo salio mal consulte al programador del sistema');
            }
        }
    });
}
function btnCambioEstado(postulante) {
    $estado = 'Activo'
    Swal.fire({
        title: 'Estás seguro de reevaluar al postulante?',
        text: "Se reingresará al modulo postulante!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Reingresar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "ajax/SessionAjaxPostulante/postulante_ajax.php",
                type: "post",
                data: { postulante: postulante, estado: $estado },
                dataType: 'json',
                error(e) {
                    swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
                }
            }).done(function (respuesta) {
                $data = respuesta.responseJson;
                if ($data = "true") {
                    Swal.fire(
                        'Reingresado!',
                        'El postulante fue reingresado.',
                        'success'
                    )
                    tblPostulante.ajax.reload();
                } else {
                    if ($data == 'error') {
                        swal.fire('ERROR!!!', 'Algo salio mal consulte al programador del sistema');
                    }
                }
            })
        } else {
            toastr.error('Canceló la operación');          
        }
    })
}
/**Modulo Usuarios */
$('#empleado').on('change', function () {
    let data = $('#empleado').val();
    if (data == '') {
        $('#correoUsuario').val('');
    } else {
        let datasend = 'id_empleadoEmail=' + data;
        $.ajax({
            type: 'POST',
            url: 'ajax/SessionAjaxEmpleado/empleado_ajax.php',
            data: datasend,
            dataType: 'json',
            error(e) {
                swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
            }
        }).done(function (respuesta) {
            if (respuesta) {
                $('#correoUsuario').val(respuesta['correo']);
                $('#sede').val(respuesta['id_localemple']).trigger('change');
                $('#rpt_correo').text("");
                $('#rpt_sede').text("");
                let rolsel = respuesta['area'].toLowerCase();
                var sel = document.getElementById("rol"); 
                for (var i = 0; i < sel.length; i++) {
                    var opt = sel[i].value;                    
                    if (opt.toLowerCase().includes(rolsel)) {
                        $('#rol').val(opt).trigger('change');
                        console.log(opt);
                    }
                    if(rolsel=="oficina"){
                        $('#rol').val("Administrador").trigger('change');
                    }
                }
            } else {
                if (respuesta['correo'] == '' || respuesta['correo'] == null) {
                    $('#rpt_correo').text("No se encontró un correo relacionado al empleado.");
                    $('#sede').val(null).trigger('change');
                    $('#correoUsuario').val('');
                }
                if (respuesta['sede'] == '' || respuesta['sede'] == null) {
                    $('#rpt_sede').text("No se encontró una sede relacionado al empleado.");
                }
                $('#rol').val("").trigger('change');
            }
        });
    }
});
function btnEditarUsuario(id_usuario) {
    $.ajax({
        url: "ajax/SessionAjaxUsuarios/usuarios_ajax.php",
        type: "post",
        data: "id_usuario=" + id_usuario,
        dataType: 'json',
        error(e) {
            swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
        }
    }).done(function (respuesta) {
        $data = respuesta;
        $('#Usuarios').val($data['id_usuario']);
        $('#Udpempleado').val($data['id_empleado']);
        $('#Udpempleado').trigger('change');
        $('#Udprol').val($data['rol']);
        $('#Udpsede').val($data['id_localemple']);/* 

        if($data['sede'] == 'General'){
            $('#Udpsede').attr('disabled',true);
        } */
    });
}
$('#Udpempleado').on('change', function () {
    let data = $('#Udpempleado').val();
    if (data == '') {
        $('#UdpcorreoUsuario').val('');
    } else {
        let datasend = 'id_empleadoEmail=' + data;
        $.ajax({
            type: 'POST',
            url: 'ajax/SessionAjaxEmpleado/empleado_ajax.php',
            data: datasend,
            dataType: 'json',
            error(e) {
                swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
            }
        }).done(function (respuesta) {
            console.log(respuesta);
            if (respuesta) {
                $('#UdpcorreoUsuario').val(respuesta['correo']);
            } else {
                $('#rpt_Udpcorreo').text("No se encontró un correo relacionado al empleado.");
            }
        });
    }
});
function btnEliminarUsuario(id_usuElm) {
    Swal.fire({
        title: 'Estás seguro en eliminar?',
        text: "Se eliminará el usuario seleccionado!!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "ajax/SessionAjaxUsuarios/usuarios_ajax.php",
                type: "post",
                data: "id_usuElm=" + id_usuElm,
                dataType: "json",
                error(e) {
                    swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
                }
            }).done(function (respuesta) {
                if (respuesta.responseJson = "eliminado") {
                    Swal.fire(
                        'Eliminado!',
                        'La usuario fue eliminado.',
                        'success'
                    )
                    tblUsuarios.ajax.reload();
                } else {
                    if (respuesta.responseJson == 'error') {
                        swal.fire('ERROR!!!', 'Algo salio mal consulte al programador del sistema');
                    }
                }
            })

        } else {
            toastr.error('Canceló la operación');          
        }
    })
}
/**Modulo Local */
function btnEditarLocal(id_local) {
    $.ajax({
        url: "ajax/SessionAjaxLocal/locales_ajax.php",
        type: "post",
        data: "id_local=" + id_local,
        dataType: 'json',
        error(e) {
            swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
        }
    }).done(function (respuesta) {
        $data = respuesta;
        $('#id_localEditar').val($data['id_local']);
        $('#Udpdireccionlocal').val($data['direccion']);
        $('#UdpcodSede').val($data['sede']);
        $('#statuslocal').val($data['status']);
    });
}

function btnEliminarlocal(id_local) {

    Swal.fire({
        title: 'Estás seguro en eliminar?',
        text: "Se eliminará el local seleccionado!!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'ajax/SessionAjaxLocal/locales_ajax.php',
                type: 'post',
                data: 'id_eliminar=' + id_local,
                dataType: 'json',
                error(e) {
                    swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
                }
            }).done(function (respuesta) {
                $data = respuesta.responseJson;
                if ($data == 'eliminado') {
                    Swal.fire(
                        'Eliminado!',
                        'La el local fue eliminado.',
                        'success'
                    )
                    tblLocal.ajax.reload();
                } else if ($data == 'usadoUser') {
                    toastr.warning('No se puede eliminar, tiene registro en el módulo usuario, "Inactivar" status de local');
                } else if ($data == 'usadoLm') {
                    toastr.warning('No se puede eliminar, tiene registro en el módulo local mesa, "Inactivar" status de local');
                } else if ($data == 'usadoLp') {
                    toastr.warning('No se puede eliminar, tiene registro en el módulo local plato, "Inactivar" status de local');
                } else if ($data == 'usadoLb') {
                    toastr.warning('No se puede eliminar, tiene registro en el módulo local bebida, "Inactivar" status de local');
                } else if ($data == 'usadoLe') {
                    toastr.warning('No se puede eliminar, tiene registro en el módulo local empleado, "Inactivar" status de local');
                } else if ($data == 'usadoCf') {
                    toastr.warning('No se puede eliminar, tiene registro en el módulo clientes frecuentes, "Inactivar" status de local');
                } else {
                    if ($data == 'error') {
                        swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
                    }
                }
            });

        } else {
            toastr.error('Canceló la operación');          
        }
    });


}

/**Modulo Local Platos*/
function btnEditarPlatoLocal(id_pl) {
    $.ajax({
        url: "ajax/SessionAjaxLocalPlatos/localplatos_ajax.php",
        type: "post",
        data: "id_plalocal=" + id_pl,
        dataType: 'json',
    }).done(function (respuesta) {
        $data = respuesta;
        $('#id_plEditar').val($data['id_localplato']);
        $('#listarPlatoED').val($data['id_plato']);
        $('#listarPlatoED').trigger('change');
        $('#listarLocalED').val($data['id_local']);
        $('#estadoED').val($data['estado']);
        $('#listarLocalED').trigger('change');
    });
};

function btnEliminarPlatoLocal(id_pl) {
    Swal.fire({
        title: 'Estás seguro en eliminar?',
        text: "Se eliminará el plato del local!!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "ajax/SessionAjaxLocalPlatos/localplatos_ajax.php",
                type: "post",
                data: "id_Eliminar=" + id_pl,
                dataType: 'json',
                error(e) {
                    swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
                }
            }).done(function (respuesta) {
                if (respuesta.response = "eliminado") {
                    Swal.fire(
                        'Eliminado!',
                        'El plato local fue eliminado.',
                        'success'
                    )
                    tblPlatoLocal.ajax.reload();
                } else {
                    if (respuesta.response == 'error') {
                        swal.fire('ERROR!!!', 'Algo salió mal, consulte al programador del sistema');
                    }
                }
            })

        } else {
            toastr.error('Canceló la operación');          
        }
    })
}
/**Modulo categoria platos */
function btnEditarCategoriaPlato(id_categoriaP) {
    $.ajax({
        url: "ajax/SessionAjaxCategoriaPlatos/categoriaplatos_ajax.php",
        type: "post",
        data: "id_categoriaP=" + id_categoriaP,
        dataType: 'json',
        error(e) {
            swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
        }
    }).done(function (respuesta) {
        $data = respuesta;
        $('#cateplatoEditar').val($data['id_categoria']);
        $('#nombrecateEditar').val($data['nombre']);
        $('#descripcion_cateEdit').val($data['descripcion']);
        $('#updt-image').val($data['imagen']);
        $('#statuscategoria').val($data['status']);
        if ($data['imagen'] == "" || $data['imagen'] == null) {
            document.getElementById('img-previewCategoriaPlatoTwo').src = 'views/imgcateplato/default.jpg';
            document.getElementById("icon-cerrarCategoriaTwo").innerHTML = `
            <button class="btn btn-danger" onclick="deleteimgTwo()"><i class="mdi mdi-close"></i></button> default.jpg`;
            document.getElementById("icon-imageCategoriaPlatoTwo").classList.add("d-none");
        } else {
            document.getElementById('img-previewCategoriaPlatoTwo').src = 'views/imgcateplato/' + $data['imagen'];
            document.getElementById("icon-cerrarCategoriaTwo").innerHTML = `
            <button class="btn btn-danger" onclick="deleteimgTwo()"><i class="mdi mdi-close"></i></button> ${$data['imagen']}`;
            document.getElementById("icon-imageCategoriaPlatoTwo").classList.add("d-none");
        }
    });
}

function btnEliminarCategoriaPlato(id_CatePlatoEli, $imagen) {
    Swal.fire({
        title: 'Estás seguro en eliminar?',
        text: "Se eliminará la categoria seleccionada!!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "ajax/SessionAjaxCategoriaPlatos/categoriaplatos_ajax.php",
                type: "post",
                data: { idCategoriaPlato: id_CatePlatoEli, imagenElm: $imagen },
                dataType: "json",
                error(e) {
                    swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
                }
            }).done(function (respuesta) {
                $data = respuesta.responseJson;
                if ($data == 'eliminado') {
                    Swal.fire(
                        'Eliminado!',
                        'La categoria seleccionada fue eliminada.',
                        'success'
                    )
                    tblCategoriaPlato.ajax.reload();
                } else if ($data == 'usado') {
                    toastr.warning('No se puede eliminar, la categoria tiene registro en el módulo Platos, "Inactivar" status');
                } else {
                    if ($data == 'error') {
                        swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
                    }
                }
            });

        } else {
            toastr.error('Canceló la operación');          
        }
    });
}

/**Modulo platos */
function btnEditarPlatos(id_plato) {
    $.ajax({
        url: "ajax/SessionAjaxPlatos/platos_ajax.php",
        type: "post",
        data: "plato=" + id_plato,
        dataType: 'json',
        error(e) {
            swal.fire('Error', 'Algo salio mal consulte al programador del sistema',);
        }
    }).done(function (respuesta) {
        $data = respuesta;
        $('#platoEditar').val($data['id_plato']);
        $('#nombreplatoEdit').val($data['nombre_plato']);
        $('#descripcionplatoEdit').val($data['descripcion']);
        $('#precioplatoEdit').val($data['precio']);
        $('#item_cateEdit').val($data['id_categoria']);
        $('#item_cateEdit').trigger('change');
        $('#statusplato').val($data['status']);
        $('#updt-imagePlato').val($data['imagen']);
        if ($data['imagen'] == "" || $data['imagen'] == null) {
            document.getElementById('img-previewPlatoUdp').src = 'views/imgcplato/default.jpg';
            document.getElementById("icon-cerrarPlatoUdp").innerHTML = `
            <button class="btn btn-danger" onclick="deleteimgPlatoUdp()"><i class="mdi mdi-close"></i></button> default.jpg`;
            document.getElementById("icon-imagePlatoUdp").classList.add("d-none");
        } else {
            document.getElementById('img-previewPlatoUdp').src = 'views/imgplato/' + $data['imagen'];
            document.getElementById("icon-cerrarPlatoUdp").innerHTML = `
            <button class="btn btn-danger" onclick="deleteimgPlatoUdp()"><i class="mdi mdi-close"></i></button> ${$data['imagen']}`;
            document.getElementById("icon-imagePlatoUdp").classList.add("d-none");
        }
    });
}

function btnEliminarPlatos(id_plato, $imagen) {
    Swal.fire({
        title: 'Estás seguro en eliminar?',
        text: "Se eliminará la fila seleccionada!!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "ajax/SessionAjaxPlatos/platos_ajax.php",
                type: "post",
                data: { Eliminar: id_plato, imagenElm: $imagen },
                dataType: 'json',
                error(e) {
                    swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
                }
            }).done(function (respuesta) {
                $data = respuesta.responseJson;
                if ($data == "eliminado") {
                    Swal.fire(
                        'Eliminado!',
                        'La fila seleccionada fue eliminada.',
                        'success'
                    )
                    tblPlatos.ajax.reload();
                } else if ($data == 'usado') {
                    toastr.warning('No se puede eliminar, la fila tiene registro en el módulo Platos, "Inactivar" status');
                } else {
                    if ($data == 'error') {
                        swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
                    }
                }
            })

        } else {
            toastr.error('Canceló la operación');          
        }
    });
}

/**Modulo Bebidas */
function btnEditarBebida(id_bebida) {
    $.ajax({
        url: "ajax/SessionAjaxBebidas/bebidas_ajax.php",
        type: "post",
        data: "id_bebida=" + id_bebida,
        dataType: 'json',
        error(e) {
            swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
        }
    }).done(function (respuesta) {
        $data = respuesta;
        $('#id_bebidaED').val($data['id_bebida']);
        $('#marcaED').val($data['marca']);
        $('#descripcionED').val($data['descripcion']);
        $('#preciobebidaED').val($data['precio']);
        $('#updt-imageBebida').val($data['ruta_imagen']);
        $('#statusED').val($data['status']);
        if ($data['ruta_imagen'] == "") {
            document.getElementById('img-previewBebidaUdp').src = 'views/imgbebida/default.jpg';
            document.getElementById("icon-cerrarBebidaUdp").innerHTML = `
        <button class="btn btn-danger" onclick="deleteimgBebidaUdp()"><i class="mdi mdi-close"></i></button> default.jpg`;
            document.getElementById("icon-imageBebidaUdp").classList.add("d-none");
        } else {
            document.getElementById('img-previewBebidaUdp').src = 'views/imgbebida/' + $data['ruta_imagen'];
            document.getElementById("icon-cerrarBebidaUdp").innerHTML = `
        <button class="btn btn-danger" onclick="deleteimgBebidaUdp()"><i class="mdi mdi-close"></i></button> ${$data['ruta_imagen']}`;
            document.getElementById("icon-imageBebidaUdp").classList.add("d-none");
        }
    });
}

function btnEliminarBebida($id_bebida, $imagen) {
    Swal.fire({
        title: '¿Estás seguro en eliminar?',
        text: "Se eliminará la bebida",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "ajax/SessionAjaxBebidas/bebidas_ajax.php",
                type: "post",
                data: { idBebida: $id_bebida, imagen: $imagen },
                dataType: "json",
                error(e) {
                    swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
                }
            }).done(function (respuesta) {
                $data = respuesta.responseJson;
                if ($data == 'eliminado') {
                    Swal.fire(
                        'Eliminado',
                        'La bebida fue eliminada',
                        'success'
                    )
                    tblBebidas.ajax.reload();
                } else if ($data == 'usado') {
                    toastr.warning('No se puede eliminar, la fila tiene registro en el módulo Platos, "Inactivar" status');
                } else {
                    if ($data == 'error') {
                        swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
                    }
                }
            });
        } else {
            toastr.error('Canceló la operación');          
        }
    })
}
function Seleccionarsede($tipotra,$id_sede,$select){
    if ($tipotra!="Administrador General") {
        $("#"+$select).val($id_sede).trigger('change');
        $(".hiddensede").attr("hidden",true);
    }else{
        $(".hiddensede").attr("hidden",false);
    }   
}