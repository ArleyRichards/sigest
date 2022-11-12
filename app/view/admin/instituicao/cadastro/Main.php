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
           <h1 class="m-0">Cadastrar Instituição</h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
           <nav aria-label="breadcrumb">
             <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="<?= DIRPAGE . 'admin' ?>">Painel Admin</a></li>
               <li class="breadcrumb-item"><a href="<?= DIRPAGE . 'instituicao' ?>">Instituições</a></li>
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
             </div>
             <!-- /.card-header -->
             <div class="card-body">
               <form action="salvar" method="post">
                 <div class="form-group mb-3">
                   <label for="campo-razao">Razão Social</label>
                   <input type="text" name="razao-social" id="campo-razao" class="form-control" required>
                 </div>
                 <div class="form-group mb-3">
                   <label for="campo-fantasia">Nome Fantasia</label>
                   <input type="text" name="nome-fantasia" id="campo-fantasia" class="form-control" required>
                 </div>
                 <div class="row">
                   <div class="form-group mb-3 col-12 col-lg-6">
                     <label for="campo-cnpj">CNPJ</label>
                     <input type="text" name="cnpj" id="campo-cnpj" class="form-control" required>
                   </div>
                   <div class="form-group mb-3 col-12 col-lg-6">
                     <label for="campo-inscricao">Inscrição Estadual</label>
                     <input type="text" name="inscricao-estadual" id="campo-inscricao" class="form-control" required>
                   </div>
                 </div>
                 <div class="row">
                   <div class="form-group mb-3 col-12 col-lg-3">
                     <label for="select-regime">Regime</label>
                     <select name="regime" id="select-regime" class="form-control" required>
                       <option value="PUBLICO">PÚBLICO</option>
                       <option value="PUBLICO">PARTICULAR</option>
                       <option value="PUBLICO">MISTO</option>
                     </select>
                   </div>
                   <div class="form-group mb-3 col-12 col-lg-9">
                     <label for="campo-site">Site</label>
                     <input type="text" name="site" id="campo-site" class="form-control">
                   </div>
                 </div>
                 <div class="row">
                   <div class="form-group mb-3 col-12 col-lg-9">
                     <label for="campo-email">Email</label>
                     <input type="email" name="email" id="campo-email" class="form-control" required>
                   </div>
                   <div class="form-group col-12 col-lg-3">
                     <label>UF</label>
                     <select id="select-uf" name="uf" class="form-control" required>
                       <option value="">Selecione</option>
                       <option value="AC">AC</option>
                       <option value="AL">AL</option>
                       <option value="AP">AP</option>
                       <option value="AM">AM</option>
                       <option value="BA">BA</option>
                       <option value="CE">CE</option>
                       <option value="DF">DF</option>
                       <option value="ES">ES</option>
                       <option value="GO">GO</option>
                       <option value="MA">MA</option>
                       <option value="MS">MS</option>
                       <option value="MT">MT</option>
                       <option value="MG">MG</option>
                       <option value="PA">PA</option>
                       <option value="PB">PB</option>
                       <option value="PR">PR</option>
                       <option value="PE">PE</option>
                       <option value="PI">PI</option>
                       <option value="RJ">RJ</option>
                       <option value="RN">RN</option>
                       <option value="RS">RS</option>
                       <option value="RO">RO</option>
                       <option value="RR">RR</option>
                       <option value="SC">SC</option>
                       <option value="SP">SP</option>
                       <option value="SE">SE</option>
                       <option value="TO">TO</option>
                     </select>
                   </div>
                 </div>
                 <div class="row">
                   <div class="form-group mb-3 col-12 col-lg-6">
                     <label for="campo-cidade">Cidade</label>
                     <input type="text" name="cidade" id="campo-cidade" class="form-control" required>
                   </div>
                   <div class="form-group mb-3 col-12 col-lg-6">
                     <label for="campo-bairro">Bairro</label>
                     <input type="text" name="bairro" id="campo-bairro" class="form-control" required>
                   </div>
                 </div>
                 <div class="row">
                   <div class="form-group mb-3 col-12 col-lg-8">
                     <label for="campo-logradouro">Logradouro</label>
                     <input type="text" name="logradouro" id="campo-logradouro" class="form-control" required>
                   </div>
                   <div class="form-group mb-3 col-3 col-lg-1">
                     <label for="campo-numero">Número</label>
                     <input type="text" name="numero" id="campo-numero" class="form-control">
                   </div>
                   <div class="form-group mb-3 col-9 col-lg-3">
                     <label for="campo-cep">Cep</label>
                     <input type="text" name="cep" id="campo-cep" class="form-control" required>
                   </div>
                 </div>
                 <div class="row">
                   <div class="form-group mb-3 col-12 col-lg-6">
                     <label for="campo-telefone">Telefone</label>
                     <input type="tel" name="telefone" id="campo-telefone" class="form-control" required>
                   </div>
                   <div class="form-group mb-3 col-12 col-lg-6">
                     <label for="campo-telefone2">Telefone 2</label>
                     <input type="tel" name="telefone2" id="campo-telefone2" class="form-control">
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