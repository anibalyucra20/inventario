<!-- start page title -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="page-title-box d-flex align-items-center justify-content-between p-0">
                    <h4 class="mb-0 font-size-18">Bienes</h4>
                    <div class="page-title-right">
                        <a href="<?php echo BASE_URL; ?>nuevo-bien" class="btn btn-primary waves-effect waves-light">+ Nuevo</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Filtros de Búsqueda</h4>
                <div class="row col-12">
                    <div class="form-group row mb-3 col-6">
                        <label for="busqueda_tabla_ambiente" class="col-5 col-form-label">Ambiente:</label>
                        <div class="col-7">
                            <select class="form-control" name="busqueda_tabla_ambiente" id="busqueda_tabla_ambiente">
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-3 col-6">
                        <label for="busqueda_tabla_codigo" class="col-5 col-form-label">Código:</label>
                        <div class="col-7">
                            <input type="number" class="form-control" name="busqueda_tabla_codigo" id="busqueda_tabla_codigo">
                        </div>
                    </div>
                    <div class="form-group row mb-3 col-6">
                        <label for="busqueda_tabla_denominacion" class="col-5 col-form-label">Denominación:</label>
                        <div class="col-7">
                            <input type="text" class="form-control" name="busqueda_tabla_denominacion" id="busqueda_tabla_denominacion">
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
                    <input type="hidden" id="filtro_codigo" value="">
                    <input type="hidden" id="filtro_ambiente" value="">
                    <input type="hidden" id="filtro_denominacion" value="">
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
            </div>
        </div>
    </div>
</div>
<script src="<?php echo BASE_URL; ?>src/view/js/functions_bien.js"></script>
<script>
    listar_BienesOrdenados();
</script>
<!-- end page title -->