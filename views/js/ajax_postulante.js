function btnEliminarPostulante(id_postElm) {
    Swal.fire({
        title: 'Estás seguro en eliminar?',
        text: "Se eliminará la fila seleccionada!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "ajax/SessionAjaxPostulante/postulante_ajax.php",
                type: "post",
                data: "id_postElm=" + id_postElm,
            }).done(function (respuesta) {
                if (respuesta = "ok") {
                    Swal.fire(
                        'Eliminado!',
                        'El la fila seleccionada fue eliminado.',
                        'success'
                    )
                    tblPostulante.ajax.reload();
                }
            })

        } else {
            toastr.error('Canceló la operación');          
        }
    })
}

/////////////////////cv

function previewCV(e) {
    const url = e.target.files[0];
    const urlTmp = URL.createObjectURL(url);
    document.getElementById("img-previewCV").src = urlTmp;
    document.getElementById("icon-imageCV").classList.add("d-none");
    document.getElementById("icon-cerrarCV").innerHTML = `
    <button class="btn btn-danger"onclick="deleteimgCV()"><i class="fas fa-times"></i></button> ${url['name']}`;
}
function deleteimgCV() {
    document.getElementById("icon-cerrarCV").innerHTML = '';
    document.getElementById("icon-imageCV").classList.remove("d-none");
    document.getElementById("img-previewCV").src = '';
    document.getElementById("imagenCV").value = '';
}

$('form#frmRegistarCVPos').submit(function (e) {
    e.preventDefault();
    var formregiCV = document.getElementById('frmRegistarCVPos');
    var datos = new FormData(formregiCV);
    $.ajax({
        url: "ajax/SessionAjaxPostulante/postulante_ajax.php",
        type: "post",
        data: datos,
        dataType: 'json',
        contentType: false,
        processData: false,
    }).done(function (respuesta) {
        $data = respuesta.response;
        if ($data == 'guardado') {
            Swal.fire(
                '¡Éxito!',
                'El documento fue registrado.',
                'success'
            )
            deleteimgCV();
            $('form#frmRegistarCVPos')[0].reset();
            $("#mdlregistrarcvPos").modal("hide");
            tblPostulante.ajax.reload();
        } else if ($data == 'sinimagen') {
            Swal.fire(
                '¡Aviso!',
                'Debe registrar una imagen.',
                'info'
            )

        } else {
            Swal.fire(
                '¡Error!',
                'No se pudo registrar el documento.',
                'info'
            )
        }
    });
});



function btnEnviarDniPosCV(dni) {
    $.ajax({
        url: "ajax/SessionAjaxPostulante/postulante_ajax.php",
        type: "post",
        data: "dni=" + dni,
        dataType: 'json',
        error(e) {
            swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
        }
    }).done(function (respuesta) {
        $data = respuesta;
        $('#dnicv').val($data['num_doc']);
        document.getElementById('cvimg').src = 'views/Curriculum/' + $data['cv'];
    });
}

/* ELIMINACION DE IMAGEN */
function eliminarimgcv() {
    var cvimg = document.getElementById('cvimg').value;
    $.ajax({
        url: "ajax/SessionAjaxPostulante/EliminarCV.php",
        data: "cvimg=" + cvimg,
        method: 'POST',
    })
}


function btnEliminarCVPos() {
    var id_docEliCv = document.getElementById('id_doc').value;
    Swal.fire({
        title: 'Estás seguro en eliminar?',
        text: "Se eliminará los datos definitivamente",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, eliminar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "ajax/SessionAjaxPostulante/postulante_ajax.php",
                type: "post",
                data: "id_docEliCv=" + id_docEliCv,
                error(e) {
                    swal.fire('Error', 'Algo salio mal consulte al programador del sistema');
                }
            }).done(function (respuesta) {
                if (respuesta.response = "eliminado") {
                    Swal.fire(
                        'Eliminado!',
                        'El registro fue eliminado.',
                        'success'
                    );
                    eliminarimgcv();
                    tblPostulante.ajax.reload();
                } else {
                    if (respuesta.response == 'error') {
                        swal.fire('ERROR!!!', 'Algo salio mal consulte al programador del sistema');
                    }
                }
            })

        } else {
            toastr.error('Canceló la operación');          
        }
    })
}
