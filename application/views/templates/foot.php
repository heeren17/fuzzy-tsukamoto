<footer class="sticky-footer active">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
      <span>SISTEM INFORMASI | FUZZY TSUKAMOTO</span>
    </div>
  </div>
</footer>

</div>
<!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url() ?>/template_admin/vendor/jquery/jquery.min.js">
</script>
<script
  src="<?= base_url() ?>/template_admin/vendor/bootstrap/js/bootstrap.bundle.min.js">
</script>

<!-- Core plugin JavaScript-->
<script
  src="<?= base_url() ?>/template_admin/vendor/jquery-easing/jquery.easing.min.js">
</script>

<!-- Page level plugin JavaScript-->
<script src="<?= base_url() ?>/template_admin/vendor/chart.js/Chart.min.js">
</script>
<script
  src="<?= base_url() ?>/template_admin/vendor/datatables/jquery.dataTables.js">
</script>

<!-- Core plugin JavaScript-->
<script
  src="<?= base_url() ?>/template_admin/vendor/jquery-easing/jquery.easing.min.js">
</script>

<!-- Page level plugin JavaScript-->
<script
  src="<?= base_url() ?>/template_admin/vendor/datatables/jquery.dataTables.js">
</script>
<script
  src="<?= base_url() ?>/template_admin/vendor/datatables/dataTables.bootstrap4.js">
</script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url() ?>/template_admin/js/sb-admin.min.js"></script>

<!-- Demo scripts for this page-->
<script src="<?= base_url() ?>/template_admin/js/demo/datatables-demo.js">
</script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url() ?>/template_admin/js/sb-admin.min.js"></script>

<!-- Demo scripts for this page-->
<!-- <script src="<?= base_url() ?>/template_admin/js/demo/datatables-demo.js">
</script>
<script
  src="<?= base_url() ?>/template_admin/js/demo/chart-area-demo.js">
</script> -->
<script>
  function deleteConfirm(url) {
    $('#btn-delete').attr('href', url);
    $('#deleteModal').modal();
  }
</script>

</body>

</html>