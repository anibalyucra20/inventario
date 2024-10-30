<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>REPORTE DE CONSULTAS</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <form id="frmRegistro">
                            <div class="form-group">
                                <label for="fecha_reporte" class="form-label col-md-3">Fecha para Reporte:</label>
                                <input type="hidden" id="id_consulta" name="id_consulta">
                                <input type="hidden" id="auxiliar">
                                <div class="col-md-6">
                                    <input type="date" class="form-control col-md-6" id="fecha_reporte" required value="<?php echo date("Y-m-d"); ?>">
                                </div>
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-info col-md-2" onclick="reporte_consultas();"><i class="fa fa-search"></i></button>
                                </div>
                            </div>

                        </form>
                        <br>
                        <button type="button" class="btn btn-primary" onclick="imprimir_reporte();">Imprimir</button>
                        <br>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content" id="imprimir_form" style="font-size: 8px;">
                        <div id="encabezado_reporte">
                            
                        </div>
                        <div id="contenido_reporte_consulta">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
<!-- incluimos una libreria para los reportes - "HTML2PDF" -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="<?php BASE_URL ?>assets/js/functions_reporte.js"></script>
<script>
    obtener_usuario(<?php echo $_SESSION['id_inventario']; ?>)
</script>