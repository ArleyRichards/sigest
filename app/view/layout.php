<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Arley Richards">
    <meta name="description" content="<?php echo $this->getDescription(); ?>">
    <meta name="keywords" content="<?php echo $this->getKeywords(); ?>">
    <title><?php echo $this->getTitle(); ?></title>
    <link rel="icon" href="<?php echo DIRIMG . 'icone.png'; ?>">
    <link rel="sortcut icon" href="<?php echo DIRIMG . 'icone.png'; ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/b088a41f1f.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?= DIRASSETS . 'plugins/toastr/toastr.min.css'?>">
    </script>
    <link rel="stylesheet" href=" <?= DIRCSS . 'style.css' ?>">
    <!-- Início do Head -->
    <?php echo $this->addHead(); ?>
    <!-- Fimo do Head -->
</head>

<body  class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
    <!-- Início do Header -->
    <?php echo $this->addHeader(); ?>
    <!-- Fim do Header -->

    <!-- Início do Main -->
    <?php echo $this->addMain(); ?>
    <!-- Fim do Main -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="<?= DIRASSETS.'plugins/toaStr/toastr.min.js'?>" crossorigin="anonymous"></script>
    <script>        
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "500",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }        
    </script>    
    <!-- Início do Footer -->
    <?php echo $this->addFooter(); ?>
    <!-- Fim do Footer -->
    </div>
</body>

</html>