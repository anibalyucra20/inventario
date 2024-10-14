<!-- footer content -->
<footer>
  <div class="pull-right">
    Sistema de Inventario 2024
  </div>
  <div class="clearfix"></div>
</footer>
<!-- /footer content -->
</div>
</div>

<!-- jQuery -->
<script src="<?php echo BASE_URL ?>view/Gentella/vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo BASE_URL ?>view/Gentella/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?php echo BASE_URL ?>view/Gentella/vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="<?php echo BASE_URL ?>view/Gentella/vendors/nprogress/nprogress.js"></script>
<!-- iCheck -->
<script src="<?php echo BASE_URL ?>view/Gentella/vendors/iCheck/icheck.min.js"></script>

<!-- Custom Theme Scripts -->
<script src="<?php echo BASE_URL ?>view/Gentella/build/js/custom.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/js/functions_login.js"></script>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  var element = document.getElementById('imprimir_form');
  html2pdf(element);
</script>-->
<?php 
if (!isset($_SESSION['id_inventario']) || !isset($_SESSION['nombres_inventario']) || !isset($_SESSION['tipo_inventario'])) {
  ?>
  <script>cerrar_sesion();</script>
  <?php
}
?>
</body>

</html>