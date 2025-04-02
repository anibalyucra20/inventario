<!-- start page title -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="page-title-box d-flex align-items-center justify-content-between p-0">
                    <h4 class="mb-0 font-size-18">Periodos Académicos</h4>
                    <div class="page-title-right">
                        <a href="<?php echo BASE_URL ?>admin/nuevo-periodo-academico" class="btn btn-primary waves-effect waves-light">+ Nuevo</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Filtros de Búsqueda</h4>
                <div class="form-group row mb-3">
                    <label for="busqueda_tabla" class="col-3 col-form-label">Periodo Académico</label>
                    <div class="col-5">
                        <input type="text" class="form-control" name="busqueda_tabla" id="busqueda_tabla">
                    </div>
                </div>
                <div class="form-group mb-0 text-center ">
                    <button class="btn btn-primary waves-effect waves-light" onclick="numero_pagina(1);"><i class="fa fa-search"></i> Buscar</button>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Resultados de Búsqueda</h4>
                <div id="filtros_tabla_header" class="form-group  row page-title-box d-flex align-items-center justify-content-between m-0 mb-1 p-0">
                    <input type="hidden" id="pagina" value="1">
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
                <div id="tablas" class="table-responsive">
                </div>
                <div id="filtros_tabla_footer" class="form-group  row page-title-box d-flex align-items-center justify-content-between m-0 mb-1 p-0">
                    <div id="texto_paginacion_tabla"></div>
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
<script src="<?php echo BASE_URL; ?>src/view/js/functions_periodoAcademico.js"></script>
<script>
    listar_periodos();
</script>
<!-- end page title -->