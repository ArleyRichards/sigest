<?php
    if(!isset($_SESSION)) {
        session_start();
    }
?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Arley Richards">
    <meta name="description" content="<?php echo $this->getDescription();?>">
    <meta name="keywords" content="<?php echo $this->getKeywords();?>">
    <title><?php echo $this->getTitle(); ?></title>
    <link rel="icon" href="<?php echo DIRIMG.'icone.png';?>">
    <link rel="sortcut icon" href="<?php echo DIRIMG.'icone.png';?>"> 
    <link rel="stylesheet" href=" <?php echo DIRCSS .'style.css'; ?>">  

    <!-- Início do Head -->
    <?php echo $this->addHead(); ?>
    <!-- Fimo do Head -->    
</head >

<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Início do Header -->
    <?php echo $this->addHeader(); ?>
    <!-- Fim do Header -->

    <!-- Início do Main -->
    <?php echo $this->addMain(); ?>
    <!-- Fim do Main -->

    <!-- Início do Footer -->
    <?php echo $this->addFooter(); ?>
    <!-- Fim do Footer -->
</body>

</html>
