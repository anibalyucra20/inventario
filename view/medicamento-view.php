<!-- page content -->
<!-- se agrega el header-->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>LISTA DE MEDICAMENTOS</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <a href="<?php BASE_URL ?>nuevo-medicamento" class="btn btn-primary">+ Nuevo</a>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">codigo</th>
                                    <th scope="col">nombre</th>
                                    <th scope="col">presentacion</th>
                                    <th scope="col">stock</th>
                                    <th scope="col">fecha_vencimiento</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="tblMedicamento">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
<script src="<?php BASE_URL ?>assets/js/functions_medicamento.js"></script>
<!-- se agrega el footer-->