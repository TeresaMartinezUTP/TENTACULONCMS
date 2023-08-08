
<!--
    Ejemplo de swal fire para el proyecto con cdn modificado en los estilos css 
<script>
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                swalWithBootstrapButtons.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            } else if (
                
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                )
            }
        })
    
</script> -->
<!-- partial -->
</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="views/vendors/js/vendor.bundle.base.js"></script>
<script src="views/vendors/select2/select2.min.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="views/vendors/chart.js/Chart.min.js"></script>
<script src="views/vendors/progressbar.js/progressbar.min.js"></script>
<script src="views/vendors/jvectormap/jquery-jvectormap.min.js"></script>
<script src="views/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="views/vendors/owl-carousel-2/owl.carousel.min.js"></script>
<script src="views/vendors/js/alertify.js"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="views/js/off-canvas.js"></script>
<script src="views/js/hoverable-collapse.js"></script>
<script src="views/js/misc.js"></script>
<script src="views/js/settings.js"></script>
<script src="views/js/todolist.js"></script>

<script src="views/js/select2.js"></script>
<script src="views/js/toastr.min.js"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<script src="views/js/dashboard.js"></script>
<!-- End custom js for this page -->
<script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="views/js/ajax_tables.js"></script>
<script src="views/js/ajax_localbebidas.js"></script>
<script src="views/js/ajax_localmesas.js"></script>
<script src="views/js/ajax_localempleado.js"></script>
<script src="views/js/ajax_bebidas.js"></script>
<script src="views/js/ajax_inventariobebidas.js"></script>
<script src="views/js/ajax_emple.js"></script>
<script src="views/js/ajax_validaciones.js"></script>
<script src="views/js/alerts.js"></script>
<script src="views/js/ajax_postulante.js"></script>
<script src="views/js/ajax_clientefre.js"></script>
<script src="views/js/ajax_caja.js"></script>
<script src="views/js/ajax_login.js"></script>
<script src="views/js/ajax_cocina.js"></script>
<script src="views/js/ajax_upcaja.js"></script>
<script src="views/js/ajax_pedidosdelivery.js"></script>
<script src="views/js/ajax_motorizado.js"></script>
<script src="views/js/ajax_pedidos_finalizados.js"></script>


<script src="views/js/efectos.js"></script>

</body>

</html>