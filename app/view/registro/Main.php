<div class="container-fluid">
  <div class="card col-lg-4 offset-lg-4 shadow mt-5 border-0">
    <div class="card-body bg-light ">
      <div class="text-center">
        <img style="border: none; border-radius: 50%; padding: 2%;" class="shadow" src="<?= DIRIMG.'profile/usuario.png' ?>"/>
        <h2 class="mt-2">Registre-se</h2>
      </div>
      <form action="login/autenticar" method="post">
        <div class="form-group mb-3">
          <label for="campo-email">Email</label>
          <input class="form-control" type="email" name="email" id="campo-email" maxlength="100" required>
        </div>
        <div class="form-group mb-3">
          <label for="campo-email">Senha</label>
          <input class="form-control" type="password" name="senha" id="campo-senha" maxlength="100" required>
        </div>
        <div class="form-group mb-5">
          <label for="campo-email">Confirme a Senha</label>
          <input class="form-control" type="password" name="senha-confirmacao" id="campo-senha-confirmacao" maxlength="100" required>
        </div>
        <div class="d-flex justify-content-between mt-2">
          <a href="login" class="btn btn-yellow-orange col-5 "><i class="fas fa-arrow-left"></i> Voltar</a>
          <button type="submit" class="btn btn-blue-saphire col-5 "><i class="fas fa-save"></i> Salvar</button>
        </div>
      </form>
    </div>
  </div>
</div>