<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Modificar Datos de Medicamento</h3>
            </div>

            
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form id="frmEditar">
                            <div class="mb-3">
                                <label for="codigo" class="form-label">Código</label>
                                <input type="number" class="form-control" id="codigo" name="codigo" placeholder="Código" required>
                                <input type="hidden" id="id_m" name="id_m"required>
                            </div>
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripción" required>
                            </div>
                            <div class="mb-3">
                                <label for="presentacion" class="form-label">Presentación</label>
                                <input type="text" class="form-control" id="presentacion" name="presentacion" placeholder="Presentación" required>
                            </div>
                            <div class="mb-3">
                                <label for="fecha_vencimiento" class="form-label">Fecha de vencimiento</label>
                                <input type="date" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento" required>
                            </div>
                            <div class="mb-3">
                                <label for="id_categoria" class="form-label">Categoría</label>
                                <select class="form-control" id="id_categoria" name="id_categoria" required>
                                    <option value=""></option>
                                </select>
                            </div>
                            <br>
                            <div>
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                                <a href="<?php echo BASE_URL ?>medicamento" class="btn btn-danger">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
<script src="<?php echo BASE_URL ?>assets/js/functions_medicamento.js"></script>
<script>
    
    const id="<?php $pagina=explode("/", $_GET['views']); echo $pagina['1']?>";
    mostrar_producto(id);
</script>