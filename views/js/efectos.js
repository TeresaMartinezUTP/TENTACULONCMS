function resetuser() {
    $(".js-example-basic-single-user").val(null).trigger('change');
}

/*Funciones para las imagenes de Categoria Platos */
function previewCategoria(e) {
    const url = e.target.files[0];
    const urlTmp = URL.createObjectURL(url);
    document.getElementById("img-previewCategoriaPlatoOne").src = urlTmp;
    document.getElementById("icon-imageCategoriaPlato").classList.add("d-none");
    document.getElementById("icon-cerrarCategoriaPlato").innerHTML = `
    <button class="btn btn-danger"onclick="deleteimgCategoria(event)"><i class="mdi mdi-close"></i></button> ${url['name']}`;

}
function deleteimgCategoria() {
    document.getElementById("icon-cerrarCategoriaPlato").innerHTML = '';
    document.getElementById("icon-imageCategoriaPlato").classList.remove("d-none");
    document.getElementById("img-previewCategoriaPlatoOne").src = '';
    document.getElementById("imagenCategoriaPlato").value = '';
}

function deleteimgTwo() {
    document.getElementById("icon-cerrarCategoriaTwo").innerHTML = '';
    document.getElementById("icon-imageCategoriaPlatoTwo").classList.remove("d-none");
    document.getElementById("img-previewCategoriaPlatoTwo").src = '';
    document.getElementById("imgCategoriaPlato").value = '';
}

function readURLCategoria(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#img-previewCategoriaPlatoTwo')
                .attr('src', e.target.result)
        };
        reader.readAsDataURL(input.files[0]);
        const urlUdpCP = input.files[0];
        document.getElementById("icon-imageCategoriaPlatoTwo").classList.add("d-none");
        document.getElementById("icon-cerrarCategoriaTwo").innerHTML = `
    <button class="btn btn-danger"onclick="deleteimgTwo()"><i class="mdi mdi-close"></i></button> ${urlUdpCP['name']}`;
    }
}

/*Funciones para las imagenes de Platos */
function previewPlato(e) {
    const url = e.target.files[0];
    const urlTmp = URL.createObjectURL(url);
    document.getElementById("img-previewPlato").src = urlTmp;
    document.getElementById("icon-imagePlato").classList.add("d-none");
    document.getElementById("icon-cerrarPlato").innerHTML = `
    <button class="btn btn-danger"onclick="deleteimgPlato(event)"><i class="mdi mdi-close"></i></button> ${url['name']}`;
}

function deleteimgPlato() {
    document.getElementById("icon-cerrarPlato").innerHTML = '';
    document.getElementById("icon-imagePlato").classList.remove("d-none");
    document.getElementById("img-previewPlato").src = '';
    document.getElementById("imagenPlato").value = '';
}

function readURLPlato(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#img-previewPlatoUdp')
                .attr('src', e.target.result)
        };
        reader.readAsDataURL(input.files[0]);
        const urlUdpCP = input.files[0];
        document.getElementById("icon-imagePlatoUdp").classList.add("d-none");
        document.getElementById("icon-cerrarPlatoUdp").innerHTML = `
    <button class="btn btn-danger"onclick="deleteimgPlatoUdp()"><i class="mdi mdi-close"></i></button> ${urlUdpCP['name']}`;
    }
}

function deleteimgPlatoUdp() {
    document.getElementById("icon-cerrarPlatoUdp").innerHTML = '';
    document.getElementById("icon-imagePlatoUdp").classList.remove("d-none");
    document.getElementById("img-previewPlatoUdp").src = '';
    document.getElementById("imgPlatoUdp").value = '';
}
/*Funciones para las imagenes de Bebidas */
function previewBebidas(e) {
    const url = e.target.files[0];
    const urlTmp = URL.createObjectURL(url);
    document.getElementById("img-previewBebida").src = urlTmp;
    document.getElementById("icon-imageBebida").classList.add("d-none");
    document.getElementById("icon-cerrarBebida").innerHTML = `
    <button class="btn btn-danger"onclick="deleteimgBebida(event)"><i class="mdi mdi-close"></i></button> ${url['name']}`;
}

function deleteimgBebida() {
    document.getElementById("icon-cerrarBebida").innerHTML = '';
    document.getElementById("icon-imageBebida").classList.remove("d-none");
    document.getElementById("img-previewBebida").src = '';
    document.getElementById("imagenBebida").value = '';
}

function readURLBebida(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#img-previewBebidaUdp')
                .attr('src', e.target.result)
        };
        reader.readAsDataURL(input.files[0]);
        const urlUdpCP = input.files[0];
        document.getElementById("icon-imageBebidaUdp").classList.add("d-none");
        document.getElementById("icon-cerrarBebidaUdp").innerHTML = `
    <button class="btn btn-danger"onclick="deleteimgBebidaUdp()"><i class="mdi mdi-close"></i></button> ${urlUdpCP['name']}`;
    }
}

function deleteimgBebidaUdp() {
    document.getElementById("icon-cerrarBebidaUdp").innerHTML = '';
    document.getElementById("icon-imageBebidaUdp").classList.remove("d-none");
    document.getElementById("img-previewBebidaUdp").src = '';
    document.getElementById("imgBebidaUdp").value = '';
}

/*Funcion para cancelar modales*/
$(".btnCancelarModal").click(function () {
    formularios = $(this).parents().find("form");
    setTimeout(function(){
    $(".js-example-basic-single").val('').trigger('change')
        for (let i = 0; i < formularios.length; i++) {
            formularios[i].reset();
        }
    }, 500);

    $(".js-example-basic-single-Aprobados").val('').trigger('change');
    $(".js-example-basic-single-Udpuser").val('').trigger('change');
    $(".js-example-basic-single-user").val('').trigger('change');
    $(".js-example-basic-multiple").val('').trigger('change');
    if (!!document.getElementById("tbl_platos")==true) {
        deleteimgPlato();
    }
    if (!!document.getElementById("tbl_bebidas")==true) {
        deleteimgBebida();
    }
    if (!!document.getElementById("tbl_categoriaplato")==true) {
        deleteimgCategoria();
    }
    toastr.error('Canceló la operación');          
});


function previewMotorizado(e) {
    const url = e.target.files[0];
    const urlTmp = URL.createObjectURL(url);
    document.getElementById("archivo").src = urlTmp; 
}

// function previewMotorizado(e, i) {
//     const url = e.target.files[0];
//     const urlTmp = URL.createObjectURL(url);
//     document.getElementById("img-previewMotorizadoOne" + i).src = urlTmp;
//     document.getElementById("icon-imageMotorizado" + i).classList.add("d-none");
//     document.getElementById("icon-cerrarMotorizado" + i).innerHTML = `
//     <button class="btn btn-danger"onclick="deleteimgBoletaM(${i})"><i class="mdi mdi-close"></i></button> ${url['name']}`;

// }

// function deleteimgBoletaM(i) {
//     document.getElementById("icon-cerrarMotorizado" + i).innerHTML = '';
//     document.getElementById("icon-imageMotorizado" + i).classList.remove("d-none");
//     document.getElementById("img-previewMotorizadoOne" + i).src = '';
//     document.getElementById("imagenBoleta" + i).value = '';
// }

// $("#modal-moto #imagenBoleta").click(function () {
//     formularios = $(this).parent().find("#imagenBoleta");
//     formularios.previewMotorizado(e);
    
//     console.log(this.id)
    
// });


//en proceso
// var numero = 1;
// var conte = $(this).parent().find("#conte");
// conte.val(1)
// $(".control-cantidad #btn-agregar").click(function(){
//   numero=1;
//   let conte = $(this).parent().find("#conte");
//   conte.val(1);
// });

// $(".control-cantidad #suma").click(function(){
//   let conte = $(this).parent().find("#conte");
//   numero++;
//   console.log(numero);
//   conte.val(numero);
// });






// var numero = 1;
// var conte = $(this).parent().find("#conte");
// conte.val(1)
// $(".control-cantidad #btn-agregar").click(function(){
//   numero=1;
//   let conte = $(this).parent().find("#conte");
//   conte.val(1);

// });

// $(".control-cantidad #suma").click(function(){
//   let conte = $(this).parent().find("#conte");
//   numero++;
//   console.log(numero);
//   conte.val(numero);
// });

$("#btn-caja-collapse").click(function (){
    //console.log(document.getElementById("btn-caja-collapse").ariaExpanded=="false")
    if (document.getElementById("btn-caja-collapse").ariaExpanded=="true"){
        document.getElementById("icon-caja-collapse").classList.remove("fa-minus");
        document.getElementById("icon-caja-collapse").classList.add('fa-plus');
        document.getElementById("row-md").classList.remove('pb-3');
    }
    else{
        document.getElementById("icon-caja-collapse").classList.remove("fa-plus");
        document.getElementById("icon-caja-collapse").classList.add('fa-minus');
        document.getElementById("row-md").classList.add('pb-3');
    }
});
