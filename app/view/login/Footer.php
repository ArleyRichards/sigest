<footer class="fixed-bottom p-3 bg-light">
    <div class="text-center">
        &copy;SIGEST - Sistema de Gestão Escolar<br>
        <?= date("Y"); ?>
    </div>
</footer>

<?php
if (isset($_GET['msg'])) {
    if ($_GET['msg'] == 'error') {
        echo '<script>Command: toastr["error"]("' . $this->getData()["msg"] . '")</script>';
        echo '<script>$("#campo-email").focus();</script>';
    }
}
?>