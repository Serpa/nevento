<?php
include_once "header.php";

include 'db.php';
?>



<div class="col-lg-6 mb-4">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Cadastro de Usuário</h4>
        </div>
        <div class="card-body">

            <form action="processa_userpeqs.php" method="POST" class="form-horizontal form-label-left">

                <div class="item form-group">
                    <label class="control-label col-md-6 col-sm-3 col-xs-12" for="nome">Usuário
                    </label>
                    <div class="col-md-10 col-sm-6 col-xs-12">
                        <input class="form-control col-md-10 col-xs-12" name="usuario_pesq" required="required" type="text">
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-6 col-sm-3 col-xs-12" for="nome">Senha
                    </label>
                    <div class="col-md-10 col-sm-6 col-xs-12">
                        <input class="form-control col-md-10 col-xs-12" name="senha_pesq" required="required" type="password">
                    </div>
                </div>


                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-3">
                        <input type="button" name="cancelar" class="btn btn-primary" onClick="window.location.href='index.php'" value="Cancelar">
                        <input type="submit" name="enviar" class="btn btn-success" value="Cadastrar">
                    </div>
                </div>
            </form>




        </div>
    </div>
</div>

<script src="js/mascaras.js"></script>

<?php
include_once "footer.php";
?>