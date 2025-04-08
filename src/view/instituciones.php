<!-- start page title -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="page-title-box d-flex align-items-center justify-content-between p-0">
                    <h4 class="mb-0 font-size-18">Instituciones</h4>
                    <div class="page-title-right">
                        <a href="<?php echo BASE_URL; ?>nueva-institucion" class="btn btn-primary waves-effect waves-light">+ Nuevo</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Filtros de Búsqueda</h4>
                    <div class="row col-12">
                        <div class="form-group row mb-3 col-6">
                            <label for="busqueda_tabla_codigo" class="col-5 col-form-label">Código Modular:</label>
                            <div class="col-7">
                                <input type="text" class="form-control" name="busqueda_tabla_codigo" id="busqueda_tabla_codigo">
                            </div>
                        </div>
                        <div class="form-group row mb-3 col-6">
                            <label for="busqueda_tabla_ruc" class="col-5 col-form-label">Ruc:</label>
                            <div class="col-7">
                                <input type="text" class="form-control" name="busqueda_tabla_ruc" id="busqueda_tabla_ruc">
                            </div>
                        </div>
                        <div class="form-group row mb-3 col-6">
                            <label for="busqueda_tabla_insti" class="col-5 col-form-label">Institución:</label>
                            <div class="col-7">
                                <input type="text" class="form-control" name="busqueda_tabla_insti" id="busqueda_tabla_insti">
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-0 text-center ">
                        <button type="button" class="btn btn-primary waves-effect waves-light" onclick="numero_pagina(1);"><i class="fa fa-search"></i> Buscar</button>
                    </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Resultados de Búsqueda</h4>
                <div id="filtros_tabla_header" class="form-group  row page-title-box d-flex align-items-center justify-content-between m-0 mb-1 p-0">
                    <input type="hidden" id="pagina" value="1">
                    <input type="hidden" id="filtro_ruc" value="">
                    <input type="hidden" id="filtro_codigo" value="">
                    <input type="hidden" id="filtro_insti" value="">
                    <div>
                        <label for="cantidad_mostrar">Mostrar</label>
                        <select name="cantidad_mostrar" id="cantidad_mostrar" class="form-control-sm" onchange="numero_pagina(1);">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <label for="cantidad_mostrar">registros</label>
                    </div>
                </div>
                <div id="tablas"></div>
                <div id="filtros_tabla_footer" class="form-group  row page-title-box d-flex align-items-center justify-content-between m-0 mb-1 p-0">
                    <div id="texto_paginacion_tabla">
                    </div>
                    <div id="paginacion_tabla">
                        <ul class="pagination justify-content-end" id="lista_paginacion_tabla">
                        </ul>
                    </div>
                </div>

                <div id="modals_editar"></div>
                <div id="modals_permisos"></div>

            </div>
        </div>
    </div>
</div>
<script src="<?php echo BASE_URL; ?>src/view/js/functions_institucion.js"></script>
<script>
    listar_instituciones();
</script>
<!-- end page title -->