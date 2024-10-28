<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Modificar datos de Categoría</h3>
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
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
                                <input type="hidden" id="id_c" name="id_c"required>
                            </div>
                            <br>
                            <div>
                                <button type="submit" class="btn btn-success">Guardar</button>
                                <a href="<?php echo BASE_URL ?>categorias" class="btn btn-success">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
<script src="<?php echo BASE_URL ?>assets/js/functions_categoria.js"></script>
<script>
    const id="<?php $pagina=explode("/", $_GET['views']); echo $pagina['1']?>";
    mostrar_categoria(id);
</script>