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
           <a href="<?= DIRPAGE . 'instituicao' ?>" class="nav-link">
             <i class="nav-icon fas fa-school"></i>
             <p>
               Instituições
             </p>
           </a>
         </li>
         <li class="nav-item">
           <a href="<?= DIRPAGE . 'gestor' ?>" class="nav-link active">
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
           <h1 class="m-0">Atualizar Informações</h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
           <nav aria-label="breadcrumb">
             <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="<?= DIRPAGE . 'admin' ?>">Painel Admin</a></li>
               <li class="breadcrumb-item"><a href="<?= DIRPAGE . 'gestor' ?>">Gestores</a></li>
               <li class="breadcrumb-item active" aria-current="page">Edição</li>
             </ol>
           </nav>
         </div><!-- /.col -->
       </div><!-- /.row -->
     </div><!-- /.container-fluid -->
   </div>
   <!-- /.content-header -->

   <?php
    $gestor = $this->getData()['gestor'][0];
    $rowInstituicao = $this->getData()['instituicao'];
    $readInstituicao = $this->getData()['readInstituicao'][0];    
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
                 <input type="hidden" name="id" value="<?= $gestor['id'] ?>">
                 <div class="form-group mb-3">
                   <label for="campo-nome">Nome</label>
                   <input type="text" name="nome" id="campo-nome" class="form-control" value="<?= $gestor['nome'] ?>" required>
                 </div>
                 <div class="form-group mb-3">
                   <label for="campo-email">Email</label>
                   <input type="email" name="email" id="campo-email" class="form-control" value="<?= $gestor['email'] ?>" required>
                 </div>
                 <div class="row">
                   <div class="form-group mb-3 col-12 col-lg-9">
                     <label for="select-instituicao">Instituição</label>
                     <select name="instituicao" id="select-instituicao" class="form-control" required>                    
                       <option value="<?= $gestor['instituicao']?>">[<?= $gestor['instituicao']?>] - <?= $readInstituicao['nome_fantasia']?></option>
                       <?php
                        foreach ($rowInstituicao as $key => $instituicao) { 
                          echo '<option value="'.$instituicao['nome_fantasia'].'"> ['.$instituicao['id'].'] - '.$instituicao['nome_fantasia'].'</option>';
                        }
                       ?>
                     </select>
                   </div>
                   <div class="form-group mb-3 col-12 col-lg-3">
                     <label for="select-nivel">Cargo</label>
                     <select name="nivel" id="select-nivel" class="form-control"  required>
                       <option value="<?= $gestor['nivel'] ?>" selected><?= $gestor['nivel'] ?></option>
                       <option value="COORDENADOR">GESTOR</option>
                       <option value="COORDENADOR">COORDENADOR</option>
                       <option value="SECRETARIO">SECRETARIO</option>
                       <option value="ALUNO">ALUNO</option>
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