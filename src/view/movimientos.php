<!-- start page title -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="card-body">
                <div class="page-title-box d-flex align-items-center justify-content-between p-0">
                    <h4 class="mb-0 font-size-18">Movimientos</h4>
                    <div class="page-title-right">
                        <a href="<?php echo BASE_URL; ?>nuevo-movimiento" class="btn btn-primary waves-effect waves-light">+ Nuevo</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Filtros de Búsqueda</h4>
                <div class="row col-12">
                    <div class="form-group row mb-3 col-6">
                        <label for="busqueda_tabla_amb_origen" class="col-5 col-form-label">Ambiente de Origen:</label>
                        <div class="col-7">
                            <select class="form-control" name="busqueda_tabla_amb_origen" id="busqueda_tabla_amb_origen">
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-3 col-6">
                        <label for="busqueda_tabla_amb_destino" class="col-5 col-form-label">Ambiente de Destino:</label>
                        <div class="col-7">
                            <select class="form-control" name="busqueda_tabla_amb_destino" id="busqueda_tabla_amb_destino">
                            </select>
                        </div>
                    </div>
                    <?php
                    $hoy = date("Y-m-d");
                    $fecha_antes = strtotime('-1 months', strtotime($hoy));
                    $fecha_antes = date('Y-m-d', $fecha_antes);
                    ?>
                    <div class="form-group row mb-3 col-6">
                        <label for="busqueda_fecha_desde" class="col-5 col-form-label">Desde:</label>
                        <div class="col-7">
                            <input type="date" class="form-control" name="busqueda_fecha_desde" id="busqueda_fecha_desde" max="<?php echo $hoy; ?>" value="<?php echo $fecha_antes; ?>">
                        </div>
                    </div>
                    <div class="form-group row mb-3 col-6">
                        <label for="busqueda_fecha_hasta" class="col-5 col-form-label">Hasta:</label>
                        <div class="col-7">
                            <input type="date" class="form-control" name="busqueda_fecha_hasta" id="busqueda_fecha_hasta" max="<?php echo $hoy; ?>" value="<?php echo $hoy; ?>">
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
                    <input type="hidden" id="filtro_ambiente_origen" value="">
                    <input type="hidden" id="filtro_ambiente_destino" value="">
                    <input type="hidden" id="filtro_fecha_inicio" value="">
                    <input type="hidden" id="filtro_fecha_fin" value="">
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
<script src="<?php echo BASE_URL; ?>src/view/js/functions_movimiento.js"></script>
<script>
    listar_MovimientosOrdenados();
</script>
<!-- end page title -->