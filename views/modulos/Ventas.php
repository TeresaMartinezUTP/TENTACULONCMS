<section>
    <div class="box">
        <div class="container-fluid">
            <!-- <div class="card"> -->
            <div class="box-header with-border">
                <h4 class="box-title titletablas">Ventas Finalizadas</h4>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table text-center table-bordered table-light table-hover" id="tblventa" width="100%" cellspacing="0">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Atencion</th>
                                <th>Fecha</th>
                                <th>Ticket</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <!-- </div> -->
        </div>
    </div>
</section>

<div class="modal fade" id="ticketporparte" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ticket por partes</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table text-center table-bordered table-light table-hover" id="tblticketporparte" width="100%" cellspacing="0">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>fecha</th>
                                            <th>Ticket</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="box-footer"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
