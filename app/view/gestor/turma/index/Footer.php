<!-- jQuery -->
<script src="<?=DIRASSETS.'plugins/jquery/jquery.min.js'?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?=DIRASSETS.'plugins/jquery-ui/jquery-ui.min.js'?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=DIRASSETS.'dist/js/adminlte.js'?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=DIRASSETS.'dist/js/pages/dashboard.js'?>"></script>

<!-- DataTables  & Plugins -->

<script src="<?=DIRASSETS.'plugins/datatables/jquery.dataTables.min.js'?>"></script>
<script src="<?=DIRASSETS.'plugins/datatables-bs4/js/dataTables.bootstrap4.min.js'?>"></script>
<script src="<?=DIRASSETS.'plugins/datatables-responsive/js/dataTables.responsive.min.js'?>"></script>
<script src="<?=DIRASSETS.'plugins/datatables-responsive/js/responsive.bootstrap4.min.js'?>"></script>
<script src="<?=DIRASSETS.'plugins/datatables-buttons/js/dataTables.buttons.min.js'?>"></script>
<script src="<?=DIRASSETS.'plugins/datatables-buttons/js/buttons.bootstrap4.min.js'?>"></script>
<script src="<?=DIRASSETS.'plugins/jszip/jszip.min.js'?>"></script>
<script src="<?=DIRASSETS.'plugins/pdfmake/pdfmake.min.js'?>"></script>
<script src="<?=DIRASSETS.'plugins/pdfmake/vfs_fonts.js'?>"></script>
<script src="<?=DIRASSETS.'plugins/datatables-buttons/js/buttons.html5.min.js'?>"></script>
<script src="<?=DIRASSETS.'plugins/datatables-buttons/js/buttons.print.min.js'?>"></script>
<script src="<?=DIRASSETS.'plugins/datatables-buttons/js/buttons.colVis.min.js'?>"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<?php
if (isset($_GET['msg'])) {
  if ($_GET['msg'] == 'create_success') {
    echo '<script>Command: toastr["success"]("' . $this->getData()["msg"] . '")</script>';    
  }else if ($_GET['msg'] == 'update_success') {
    echo '<script>Command: toastr["success"]("' . $this->getData()["msg"] . '")</script>';    
  }else if ($_GET['msg'] == 'update_error') {
    echo '<script>Command: toastr["danger"]("' . $this->getData()["msg"] . '")</script>';    
  }
}else{
  echo '<script> console.log("variável $msg vazia!")</script>';
}
?>