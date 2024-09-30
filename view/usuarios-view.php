<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Usuarios</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <a href="<?php BASE_URL ?>nuevo-usuario" class="btn btn-primary">+ Nuevo</a>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">DNI</th>
                                    <th scope="col">CIP</th>
                                    <th scope="col">Apellidos y Nombres</th>
                                    <th scope="col">Género</th>
                                    <th scope="col">Tipo de Usuario</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="tblUsuario">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
<script src="<?php BASE_URL ?>assets/js/functions_usuarios.js"></script>