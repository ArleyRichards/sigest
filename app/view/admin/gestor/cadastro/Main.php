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
                    <a href="<?= DIRPAGE . 'admin' ?>" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Painel
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= DIRPAGE . 'instituicao' ?>" class="nav-link active">
                        <i class="nav-icon fas fa-school"></i>
                        <p>
                            Instituições
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= DIRPAGE . 'gestor' ?>" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Gestores
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
                    <h1 class="m-0">Cadastrar Gestor</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?= DIRPAGE . 'admin' ?>">Painel Admin</a></li>
                            <li class="breadcrumb-item"><a href="<?= DIRPAGE . 'gestor' ?>">Gestores</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Cadastro</li>
                        </ol>
                    </nav>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <!--<h3 class="card-title">Relação de Instituições Cadastradas</h3>-->
                            <a class="btn btn-outline-info" href="<?= DIRPAGE.'gestor'?>"> <i class="fas fa-arrow-left"></i> Voltar</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="salvar" method="post">
                                <hr class="mb-0">
                                <small class="text-muted mt-0">Dados de Pessoais</small>
                                <hr class="mt-0">             
                                
                                <div class="form-group mb-3">
                                    <label for="campo-nome">Nome Completo</label>
                                    <input type="text" name="nome" id="campo-nome" class="form-control" required>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12 col-lg-3 mb-3">
                                        <label for="campo-nascimento">Nascimento</label>
                                        <input type="date" name="nascimento" id="campo-nascimento" class="form-control" required>
                                    </div>
                                    <div class="form-group col-12 col-lg-3 mb-3">
                                        <label for="select-sexo">Sexo</label>                                        
                                        <select class="form-control" name="sexo" required>
                                            <option value="M">Masculino</option>
                                            <option value="F">Feminino</option>
                                            <option value="O">Outro</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3 col-12 col-lg-3">
                                        <label for="campo-cpf">CPF</label>
                                        <input type="text" name="cpf" id="campo-cpf" class="form-control" required>
                                    </div>
                                    <div class="form-group mb-3 col-12 col-lg-3">
                                        <label for="campo-rg">RG</label>
                                        <input type="text" name="campo-rg" id="campo-rg" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group mb-3 col-12 col-lg-12">
                                        <label for="campo-nome-mae">Nome da Mãe</label>
                                        <input type="text" name="nome-mae" id="campo-nome-mae" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group mb-3 col-12 col-lg-12">
                                        <label for="campo-nome-pai">Nome do Pai</label>
                                        <input type="text" name="nome-pai" id="campo-nome-pai" class="form-control" required>
                                    </div>
                                </div>
                                
                                <hr class="mb-0">
                                <small class="text-muted mt-0">Dados de Acesso</small>
                                <hr class="mt-0">
                                                                
                                <div class="row">
                                    <div class="form-group mb-3 col-12 col-lg-12">
                                        <label for="campo-email">Email</label>
                                        <input type="email" name="email" id="campo-email" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group mb-3 col-12 col-lg-6">
                                        <label for="campo-senha">Senha</label>
                                        <input type="password" name="senha" id="campo-senha" class="form-control" required>
                                    </div>
                                    <div class="form-group mb-3 col-12 col-lg-6">
                                        <label for="campo-senha-confirmacao">Confirme a Senha</label>
                                        <input type="password" name="senha-confirmacao" id="campo-senha-confirmacao" class="form-control" required>
                                    </div>
                                </div>
                                <hr class="mb-0">
                                <small class="text-muted mt-0">Instituição de Ensino</small>
                                <hr class="mt-0">
                                
                                <div class="row">
                                    <div class="form-group mb-3 col-12 col-lg-12">
                                        <label for="select-instituicao">Instituição</label>
                                        <select class="form-control" name="instituicao" id="select-instituicao" required>
                                            <option value="">SELECIONE</option>                                            
                                            <?php
                                                $instituicoes = $this->getData()['instituicoes'];
                                                foreach ($instituicoes as $key => $instituicao) {
                                                    echo '<option value="'.$instituicao['id'].'">'.$instituicao['nome_fantasia'].'</option>';
                                                }
                                            ?>
                                        </select>
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