<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Atenciones en Farmacia</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <a href="<?php BASE_URL ?>nueva-atencion" class="btn btn-primary">+ Nuevo</a>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">fecha</th>
                                    <th scope="col">paciente</th>
                                    <th scope="col">motivo de consulta</th>
                                </tr>
                            </thead>
                            <tbody id="tblFarmacia">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
<script src="<?php echo BASE_URL ?>assets/js/functions_farmacia.js"></script>