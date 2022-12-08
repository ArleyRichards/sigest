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
                    <a href="<?= DIRPAGE . 'curso' ?>" class="nav-link">
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
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Alterar Informações</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= DIRPAGE . 'dashboard' ?>">Painel Gestor</a></li>
                            <li class="breadcrumb-item"><a href="<?= DIRPAGE . 'turma' ?>">Turmas</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edição</li>
                        </ol>
                    </nav>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <?php
    $turma = $this->getData()['turma'][0];
    $curso = $this->getData()['curso'];
    $docente = $this->getData()['docente'];
//    echo '<pre>';
//    //var_dump($turma);
//    echo '</pre>';
    ?>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <!--<h3 class="card-title">Relação de Instituições Cadastradas</h3>-->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="../atualizar" method="post">
                                <input type="hidden" name="id_instituicao" value="<?= $_SESSION['id_instituicao'] ?>">                                   
                                <input type="hidden" name="id_turma" value="<?= $turma['id'] ?>">                                   
                                <div class="row">
                                    <div class="form-group mb-3 col-12 col-lg-3">
                                        <label for="campo-codigo">Código<span class="text-danger"> *</span></label>
                                        <input type="text" name="codigo" id="campo-ch" maxlength="20" class="form-control" value="<?=$turma['codigo']?>" required>
                                    </div>
                                    <div class="form-group mb-3 col-12 col-lg-9">
                                        <label for="select-curso">Curso<span class="text-danger"> *</span></label>
                                        <select class="form-control" name="curso" disabled>
                                            <?php
                                            foreach ($curso as $key => $c) {
                                                echo '<option value="' . $c['id'] . '" selected>[' . $c['id'] . '] - ' . $c['nome'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>                                    
                                </div>                 
                                <div class="row">
                                    <div class="form-group mb-3 col-12 col-lg-3">
                                        <label for="campo-vagas">Número de Vagas</label>
                                        <input type="number" class="form-control" name="vagas" value="<?=$turma['vagas']?>" required>
                                    </div>
                                    <div class="form-group mb-3 col-12 col-lg-9">
                                        <label for="select-docente">Docente<span class="text-danger"> *</span></label>
                                        <select class="form-control" name="docente">
                                            <option value="<?=$turma['id_docente']?>" selected>Selecione</option>       
                                            <?php
                                            foreach ($docente as $key => $d) {
                                                echo '<option value="' . $d['id'] . '">[' . $d['id'] . '] - ' . $d['nome'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>  
                                </div>     
                                <div class="row justify-content-between">
                                    <div class="form-group mb-3 col-6 col-lg-3">
                                        <label for="data-inicio">Data de Início</label>
                                        <input type="date" class="form-control" name="data_inicio" value="<?=$turma['data_inicio']?>" required>
                                    </div>  
                                    <div class="form-group mb-3 col-6 col-lg-3">
                                        <label for="data-fim">Data de Término</label>
                                        <input type="date" class="form-control" name="data_fim" value="<?=$turma['data_fim']?>" required>
                                    </div> 
                                    <div class="form-group mb-3 col-6 col-lg-3">
                                        <label for="data-inicio">Horário de Início</label>
                                        <input type="time" class="form-control" name="horario_inicio" value="<?=$turma['horario_inicio']?>" required>
                                    </div>  
                                    <div class="form-group mb-3 col-6 col-lg-3">
                                        <label for="data-fim">Horário de Término</label>
                                        <input type="time" class="form-control" name="horario_fim" value="<?=$turma['horario_fim']?>" required>
                                    </div> 
                                </div>

                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary"> <i class="fas fa-save"></i> Salvar</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
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