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
   <div class="content-header">
     <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-6">
           <h1 class="m-0">Atualizar Informações</h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
           <nav aria-label="breadcrumb">
             <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="<?= DIRPAGE . 'admin' ?>">Painel Gestor</a></li>
               <li class="breadcrumb-item"><a href="<?= DIRPAGE . 'instituicao' ?>">Discentes</a></li>
               <li class="breadcrumb-item active" aria-current="page">Edição</li>
             </ol>
           </nav>
         </div><!-- /.col -->
       </div><!-- /.row -->
     </div><!-- /.container-fluid -->
   </div>
   <!-- /.content-header -->

   <?php
    $rowDiscente = $this->getData()['discente'][0];
    //var_dump($rowDiscente);
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
                  <input type="hidden" name="id_instituicao" value="<?= $_SESSION['id_instituicao']?>"> 
                  <input type="hidden" name="id_discente" value="<?= $_SESSION['id']?>"> 
                 <div class="form-group mb-3">
                   <label for="campo-nome">Nome <span class="text-danger"> *</span></label>
                   <input type="text" name="nome" id="campo-nome" class="form-control" maxlength="255" value="<?=$rowDiscente['nome']?>" required>
                 </div>
                 <div class="form-group mb-3">
                   <label for="campo-nome-mae">Nome da Mãe <span class="text-danger"> *</span></label>
                   <input type="text" name="nome-mae" id="campo-nome-mae" class="form-control" maxlength="255" value="<?=$rowDiscente['nome_mae']?>" required>
                 </div>
                 <div class="form-group mb-3">
                   <label for="campo-nome-pai">Nome do Pai</label>
                   <input type="text" name="nome-pai" id="campo-nome-pai" class="form-control" value="<?=$rowDiscente['nome_pai']?>" maxlength="255">
                 </div>
                 <div class="row">
                   <div class="form-group mb-3 col-12 col-lg-4">
                     <label for="campo-nascimento">Data de Nascimento<span class="text-danger"> *</span></label>
                     <input type="date" name="nascimento" id="campo-nascimento" class="form-control" value="<?=$rowDiscente['nascimento']?>">
                   </div>
                   <div class="form-group mb-3 col-12 col-lg-4">
                     <label for="campo-cpf">CPF<span class="text-danger"> *</span></label>
                     <input type="text" name="cpf" id="campo-cpf" maxlength="20" class="form-control" value="<?=$rowDiscente['cpf']?>">
                   </div>
                   <div class="form-group mb-3 col-12 col-lg-4">
                     <label for="campo-rg">RG<span class="text-danger"> *</span></label>
                     <input type="text" name="rg" id="campo-rg" maxlength="20" class="form-control" value="<?=$rowDiscente['rg']?>">
                   </div>
                 </div>                 
                 <div class="row">
                   <div class="form-group mb-3 col-12 col-lg-6">
                     <label for="campo-email">Email<span class="text-danger"> *</span></label>
                     <input type="email" name="email" id="campo-email" class="form-control" value="<?=$rowDiscente['email']?>" required>
                   </div>
                   <div class="form-group mb-3 col-12 col-lg-6">
                     <label for="campo-telefone">Telefone<span class="text-danger"> *</span></label>
                     <input type="tel" name="telefone" id="campo-telefone" class="form-control" value="<?=$rowDiscente['telefone']?>">
                   </div>
                 </div>
                 <div class="row">
                   <div class="form-group col-12 col-lg-6">
                     <label>Necessidades Especiais<span class="text-danger"> *</span></label>
                     <select id="select-pcd" name="pcd" class="form-control">
                       <option selected value="<?=$rowDiscente['pcd']?>"><?=$rowDiscente['pcd']?></option>
                       <option value="NENHUM">NENHUM</option>
                       <option value="DEFICIENCIA INTELECTUAL">DEFICIENCIA INTELECTUAL</option>
                       <option value="DEFICIENCIA FISICA">DEFICIENCIA FISICA</option>
                       <option value="BAIXA VISAO">BAIXA VISAO</option>
                       <option value="DEFICIENCIA AUDITIVA">DEFICIENCIA AUDITIVA</option>
                       <option value="SURDEZ">SURDEZ</option>
                       <option value="DEFICIENCIA MULTIPLA">DEFICIENCIA MULTIPLA</option>
                       <option value="TRANSTORNO DESINTEGRATIVO DA INFANCIA (DTI)">TRANSTORNO DESINTEGRATIVO DA INFANCIA (DTI)</option>
                       <option value="AUTISMO">AUTISMO</option>
                       <option value="CEGUEIRA">CEGUEIRA</option>
                       <option value="SINDROME DE ASPERGER">SINDROME DE ASPERGER</option>
                       <option value="SINDROME DE RETT">SINDROME DE RETT</option>
                       <option value="SURDOCEGUEIRA">SURDOCEGUEIRA</option>
                       <option value="OUTROS">OUTROS</option>
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