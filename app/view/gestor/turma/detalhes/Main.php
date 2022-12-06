<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="admin/dashboard" class="brand-link">
        <img src="https://img.icons8.com/color/96/000000/octaedro.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">SIGEST</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= DIRIMG . 'profile/user-48.png' ?>" class="img-circle elevation-2" alt="User Image" />
            </div>
            <div class="info">
                <a href="#" class="d-block"><?= $_SESSION['nome'] ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="<?= DIRPAGE . 'dashboard' ?>" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Painel
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= DIRPAGE . 'docente' ?>" class="nav-link">
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>
                            Docentes
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= DIRPAGE . 'discente' ?>" class="nav-link ">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Discentes
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= DIRPAGE . 'curso' ?>" class="nav-link  ">
                        <i class="nav-icon fas fa-graduation-cap"></i>
                        <p>
                            Cursos
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= DIRPAGE . 'turma' ?>" class="nav-link active">
                        <i class="nav-icon fas fa-chalkboard"></i>
                        <p>
                            Turmas
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1></h1>
                </div>
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= DIRPAGE . 'dashboard' ?>">Painel Gestor</a></li>
                            <li class="breadcrumb-item"><a href="<?= DIRPAGE . 'turma' ?>">Turmas</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Detalhes</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <?php
    $turma = $this->getData()['turma'][0];
    $curso = $this->getData()['curso'][0];
    $docente = $this->getData()['docente'][0];
    ?>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!--
                    <div class="callout callout-info">
                        <h5><i class="fas fa-info"></i> Note:</h5>
                        This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
                    </div>
                    -->

                    <!-- Main content -->
                    <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="fas fa-users-cog"></i> <span class="text-muted">Turma </span>[<?= $turma['codigo'] ?>] - <?= $curso['nome'] ?>                                    
                                    <small class="float-right"><a href="<?=DIRPAGE.'turma/edicao/'.$turma['id']?>" class="btn btn-outline-info">Alterar Informações</a></small>
                                </h4>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                <p></p>
                                <address>
                                    <strong><?= $turma['vagas'] ?></strong> Vagas<br>                                    
                                    <span class="text-muted">Início em: </span> <?= date("d-m-Y", strtotime($turma['data_inicio'])) ?><br>
                                    <span class="text-muted">Término em: </span> <?= date("d-m-Y", strtotime($turma['data_fim'])) ?><br>                                    
                                    <span class="text-muted">Horário: </span> <?= date("H:i", strtotime($turma['horario_inicio'])) ?><br>                                    
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                <p></p>
                                <address>
                                    <span class="text-muted">Docente:</span><br>
                                    <strong><?= $docente['nome'] ?></strong><br>
                                    <?= $docente['email'] ?><br>
                                    <?= $docente['telefone'] ?><br>
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- Table row -->
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Matrícula</th>
                                            <th>ID</th>
                                            <th>Nome</th>
                                            <th>PCD</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>17</td>
                                            <td>José Joaquim Barbosa</td>
                                            <td>NENHUM</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <!-- accepted payments column -->
                            <div class="col-6">
                                <p class="lead">Observações</p>

                                <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
                                    plugg
                                    dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                                </p>
                            </div>
                            <!-- /.col -->
                            <div class="col-6">
                                <p class="lead">Informações Gerais</p>

                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:50%">Total Matrículas:</th>
                                            <td>35</td>
                                        </tr>
                                        <tr>
                                            <th>Andamento</th>
                                            <td>50%</td>
                                        </tr>
                                        <tr>
                                            <th>Evasão:</th>
                                            <td>5%</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- this row will not appear when printing -->
                        <div class="row no-print">
                            <div class="col-12">
                                <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Imprimir</a>
                                <button type="button" class="btn btn-success float-right"><i class="fas fa-user-plus"></i>
                                    Matricular
                                </button>
                                <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                    <i class="fas fa-download"></i> Download PDF
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- /.invoice -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<footer class="main-footer">
    <strong>Copyright &copy; <?= date("Y") ?> <a href="#">SIGEST - Sistema de Gestão Escolar</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> BETA-0.1
    </div>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>