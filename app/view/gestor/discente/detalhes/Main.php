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
           <a href="<?= DIRPAGE . 'docente' ?>" class="nav-link">
             <i class="nav-icon fas fa-user-tie"></i>
             <p>
               Docentes
             </p>
           </a>
         </li>
         <li class="nav-item">
           <a href="<?= DIRPAGE . 'discente' ?>" class="nav-link active">
             <i class="nav-icon fas fa-graduation-cap"></i>
             <p>
               Discentes
             </p>
           </a>
         </li>
         <li class="nav-item">
           <a href="<?= DIRPAGE . 'classe' ?>" class="nav-link">
             <i class="nav-icon fas fa-chalkboard"></i>
             <p>
               Classes
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
               <li class="breadcrumb-item"><a href="<?= DIRPAGE . 'admin' ?>">Painel Admin</a></li>
               <li class="breadcrumb-item"><a href="<?= DIRPAGE . 'discente' ?>">Discentes</a></li>
               <li class="breadcrumb-item active" aria-current="page">Detalhes</li>
             </ol>
           </nav>
         </div>
       </div>
     </div><!-- /.container-fluid -->
   </section>

   <!-- Main content -->
   <section class="content">
     <div class="container-fluid">
       <div class="row">
         <div class="col-md-4">

           <!-- Profile Image -->
           <div class="card card-primary card-outline">
             <div class="card-body box-profile">
               <div class="text-center">
                 <img class="profile-user-img img-fluid img-circle" src="https://img.icons8.com/external-xnimrodx-lineal-color-xnimrodx/64/null/external-graduate-education-xnimrodx-lineal-color-xnimrodx.png" alt="User profile picture">
               
               </div>

               <?php
                $docente = $this->getData()['discente'][0];
                $instituicao = $this->getData()['instituicao'][0];
                //var_dump($this->getData());
               ?>

               <h3 class="profile-username text-center"><?=$docente['nome']?></h3>
               <p class="text-center mb-0">Matrícula: <strong><?=$docente['id']?></strong></p>
               <p class="text-muted text-center mt-0">[<?=$docente['id_instituicao'].'] - '.$instituicao['nome_fantasia']?></p>

               <a href="<?=DIRPAGE.'discente/edicao/'.$docente['id']?>" class="btn btn-primary btn-block"><b>Editar</b></a>
             </div>
             <!-- /.card-body -->
           </div>
           <!-- /.card -->

           <!-- About Me Box -->
           <div class="card card-primary">
             <div class="card-header">
               <h3 class="card-title">Informações Gerais</h3>
             </div>
             <!-- /.card-header -->
             <div class="card-body">
               <strong><i class="fas fa-phone mr-1"></i> Telefone</strong>

               <p class="text-muted">
                 <span class="tag tag-danger"><?=$docente['telefone']?></span></br>                 
               </p>
               <hr>
               <strong><i class="fas fa-at mr-1"></i> Email</strong>

               <p class="text-muted"><?=$docente['email']?></p>
             </div>
             <!-- /.card-body -->
           </div>
           <!-- /.card -->
         </div>
         <!-- /.col -->
         <div class="col-md-8">
           <div class="card">
             <div class="card-header p-2">
               <ul class="nav nav-pills">
                 <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Atividades</a></li>
                 <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>
                 <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Outros</a></li>
               </ul>
             </div><!-- /.card-header -->
             <div class="card-body">
               <div class="tab-content">
                 <div class="active tab-pane" id="activity">
                   
                 </div>
                 <!-- /.tab-pane -->
                 <div class="tab-pane" id="timeline">
                   
                 </div>
                 <!-- /.tab-pane -->

                 <div class="tab-pane" id="settings">
                   <form class="form-horizontal">
                     
                   </form>
                 </div>
                 <!-- /.tab-pane -->
               </div>
               <!-- /.tab-content -->
             </div><!-- /.card-body -->
           </div>
           <!-- /.card -->
         </div>
         <!-- /.col -->
       </div>
       <!-- /.row -->
     </div><!-- /.container-fluid -->
   </section>
   <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->

 <footer class="main-footer">
   <strong>Copyright &copy; <?=date("Y")?> <a href="#">SIGEST - Sistema de Gestão Escolar</a>.</strong>
   All rights reserved.
   <div class="float-right d-none d-sm-inline-block">
     <b>Version</b> BETA-0.1
   </div>
 </footer>

 <!-- Control Sidebar -->
 <aside class="control-sidebar control-sidebar-dark">
   <!-- Control sidebar content goes here -->
 </aside>