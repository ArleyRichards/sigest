<!-- jQuery -->
<script src="<?= DIRASSETS . 'plugins/jquery/jquery.min.js' ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= DIRASSETS . 'plugins/jquery-ui/jquery-ui.min.js' ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= DIRASSETS . 'dist/js/adminlte.js' ?>"></script>
<!-- AdminLTE for demo purposes 
<script src="<?= DIRASSETS . 'dist/js/pages/dashboard.js' ?>"></script>-->

<!-- DataTables  & Plugins -->
<script src="<?= DIRASSETS . 'plugins/datatables-buttons/js/dataTables.buttons.min.js' ?>"></script>
<script src="<?= DIRASSETS . 'plugins/datatables-buttons/js/buttons.bootstrap4.min.js' ?>"></script>
<script src="<?= DIRASSETS . 'plugins/datatables-buttons/js/buttons.html5.min.js' ?>"></script>
<?php
if (isset($_GET['msg'])) {
  if ($_GET['msg'] == 'error') {
    echo '<script>Command: toastr["error"]("' . $this->getData()["msg"] . '")</script>';    
  }else if ($_GET['msg'] == 'incomplete_fields'){
    echo '<script>Command: toastr["warning"]("' . $this->getData()["msg"] . '")</script>';    
  }
}else{
  echo '<script> console.log("variável $msg vazia!")</script>';
}
?>