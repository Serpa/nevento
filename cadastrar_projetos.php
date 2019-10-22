<?php
include_once "header.php";

include 'db.php';
mysqli_query($conexao, "SET NAMES utf8");
?>


<style type="text/css">
    .carregando {
        color: #ff0000;
        display: none;
    }
</style>
<title>Inserir Novo Projeto</title>
<link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" href="css/jquery.steps.css">
<div class="col-lg-6 mb-4">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Cadastro de Avaliador</h4>
        </div>
        <div class="card-body">

            <form action="processa_projetos.php" method="POST" class="form-horizontal form-label-left">

                <h3>Cadastro do Projeto</h3>
                <div class="item form-group">
                    <label class="control-label col-md-6 col-sm-3 col-xs-12" for="nome">Nome do Projeto:
                    </label>
                    <div class="col-md-10 col-sm-6 col-xs-12">
                        <input class="form-control col-md-10 col-xs-12" required="required" type="text" name="nome_projeto" placeholder="Insira o nome do projeto">
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-6 col-sm-3 col-xs-12" for="nome">Título do Projeto:
                    </label>
                    <div class="col-md-10 col-sm-6 col-xs-12">
                        <input class="form-control col-md-10 col-xs-12" name="titulo_projeto" placeholder="Insira a título do projeto" required="required" type="text">
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-6 col-sm-3 col-xs-12" for="nome">Categoria do Projeto:
                    </label>
                    <div class="col-md-10 col-sm-6 col-xs-12">
                        <select class="form-control col-md-10 col-xs-12" name="categorias_projetos_id">
                            <option value="">Selecione</option>
                            <?php
                            $result_categorias_projeto = "SELECT * FROM categorias_projetos";
                            $resultado_categorias_projeto = mysqli_query($conexao, $result_categorias_projeto);
                            while ($row_categorias_projeto = mysqli_fetch_assoc($resultado_categorias_projeto)) { ?>
                                <option value="<?php echo utf8_encode($row_categorias_projeto['id']); ?>"><?php echo $row_categorias_projeto['nome_categoria']; ?></option> <?php
                                                                                                                                                                                            }
                                                                                                                                                                                            ?>
                        </select>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-6 col-sm-3 col-xs-12" for="nome">Área do Projeto:
                    </label>
                    <div class="col-md-10 col-sm-6 col-xs-12">
                        <select class="form-control col-md-10 col-xs-12" name="areas_projeto_id" id="areas_projeto_id">
                            <option value="">Selecione</option>
                            <?php
                            $result_areas_projeto = "SELECT * FROM areas_projeto";
                            $resultado_areas_projeto = mysqli_query($conexao, $result_areas_projeto);
                            while ($row_areas_projeto = mysqli_fetch_assoc($resultado_areas_projeto)) { ?>
                                <option value="<?php echo $row_areas_projeto['id']; ?>"><?php echo $row_areas_projeto['nome_area']; ?></option> <?php
                                                                                                                                                                            }
                                                                                                                                                                            ?>
                        </select>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-6 col-sm-3 col-xs-12" for="nome">Subárea do Projeto:
                    </label>
                    <div class="col-md-10 col-sm-6 col-xs-12">
                        <span class="carregando">Aguarde, carregando...</span>
                        <select class="form-control col-md-10 col-xs-12" name="id_sub_categoria" id="id_sub_categoria">
                            <option value="">Escolha a Subárea</option>
                        </select>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-6 col-sm-3 col-xs-12" for="nome">Palavras chave:
                    </label>
                    <div class="col-md-10 col-sm-6 col-xs-12">
                        <input class="form-control col-md-10 col-xs-12" id="plchave" name="palavraschave_projeto" placeholder="Insira as palavras-chave referente ao projeto" required="required" type="text">
                    </div>
                </div>

                <h3>Cadastro do Autor</h3>

                <div class="item form-group">
                    <label class="control-label col-md-6 col-sm-3 col-xs-12" for="nome">Autor do Projeto:
                    </label>
                    <div class="col-md-10 col-sm-6 col-xs-12">
                        <input class="form-control col-md-10 col-xs-12" name="autor_projeto" placeholder="Insira o nome do autor do projeto" required="required" type="text">
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-6 col-sm-3 col-xs-12" for="nome">Endereço do autor:
                    </label>
                    <div class="col-md-10 col-sm-6 col-xs-12">
                        <input class="form-control col-md-10 col-xs-12" name="endereco_autor" placeholder="Insira o endereço do autor do projeto" required="required" type="text">
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-6 col-sm-3 col-xs-12" for="nome">Cidade do autor:
                    </label>
                    <div class="col-md-10 col-sm-6 col-xs-12">
                        <input class="form-control col-md-10 col-xs-12" name="cidade_autor" placeholder="Insira a cidade do autor do projeto" required="required" type="text">
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-6 col-sm-3 col-xs-12" for="nome">E-mail do autor:
                    </label>
                    <div class="col-md-10 col-sm-6 col-xs-12">
                        <input class="form-control col-md-10 col-xs-12" name="email_autor" placeholder="Insira o e-mail do autor do projeto" required="required" type="mail">
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-6 col-sm-3 col-xs-12" for="nome">Telefone do autor:
                    </label>
                    <div class="col-md-10 col-sm-6 col-xs-12">
                        <input class="form-control col-md-10 col-xs-12" name="fone_autor" placeholder="Insira o telefone do autor do projeto" onkeyup="mascara('(##)#####-####',this,event,true)" required="required" type="text">
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-6 col-sm-3 col-xs-12" for="nome">Instituição do autor:
                    </label>
                    <div class="col-md-10 col-sm-6 col-xs-12">
                        <input class="form-control col-md-10 col-xs-12" name="instituicao_autor" placeholder="Insira a instituição do autor do projeto" required="required" type="text">
                    </div>
                </div>

                <h3>Orientador</h3>

                <div class="item form-group">
                    <label class="control-label col-md-6 col-sm-3 col-xs-12" for="nome">Nome do Orientador:
                    </label>
                    <div class="col-md-10 col-sm-6 col-xs-12">
                        <input class="form-control col-md-10 col-xs-12" name="nome_orientador" placeholder="Insira o nome do orientador" required="required" type="text">
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-6 col-sm-3 col-xs-12" for="nome">Instituição do Orientador:
                    </label>
                    <div class="col-md-10 col-sm-6 col-xs-12">
                        <input class="form-control col-md-10 col-xs-12" name="instituicao_orientador" placeholder="Insira a instituição do orientador" required="required" type="text">
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-6 col-sm-3 col-xs-12" for="nome">E-mail do Orientador:
                    </label>
                    <div class="col-md-10 col-sm-6 col-xs-12">
                        <input class="form-control col-md-10 col-xs-12" name="email_orientadorcol" placeholder="Insira o e-mail do orientador" required="required" type="mail">
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-6 col-sm-3 col-xs-12" for="nome">E-mail do Orientador:
                    </label>
                    <div class="col-md-10 col-sm-6 col-xs-12">
                        <input class="form-control col-md-10 col-xs-12" name="email_orientadorcol1" placeholder="Insira o segundo e-mail do orientador, caso haja" type="mail">
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-6 col-sm-3 col-xs-12" for="nome">Telefone do Orientador:
                    </label>
                    <div class="col-md-10 col-sm-6 col-xs-12">
                        <input class="form-control col-md-10 col-xs-12" name="fone_orientador" required="required" placeholder="Insira o telefone do orientador" onkeyup="mascara('(##)#####-####',this,event,true)" required="required" type="text">
                    </div>
                </div>

                <h3>Coautor</h3>

                <div id="coautor">
                    <div class="coautor_cloned">
                        <table border="1" width="100%">
                            <tr>
                                <th>
                                    <center><label class="badge badge-secondary">Nome Coautor:</label></center>
                                </th>
                                <th>
                                    <center><label class="badge badge-secondary">Apresentador do Projeto
                                </th>
                                </center>
                            </tr>
                            <tr>
                                <th><input class="form-control" type="text" id="nome_coautor" name="Coautor[]" required />
                                    <a class="badge badge-success" style="cursor: pointer;" onclick="duplicarCampos();">+</a>
                                    <a class="badge badge-danger" style="cursor: pointer;" onclick="removerCampos(this);">-</a>
                                <td>
                                    <center><input type="radio" name="apresentador_projeto" value='1'></center>
                                </td>
                                </th>
                            </tr>
                        </table>
                    </div>
                </div>

                <div id="coautor2">
                </div><br>
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
<script src="js/jquery.js"></script>
<script src="js/jquery.validate.js"></script>
<script src="js/jquery.steps.js"></script>
<script src="js/script.js"></script>
<script src="js/states.js"></script>
<script src="js/mascaras.js"></script>
<script>
    $('input').on("input", function(e) {
        $(this).val($(this).val().replace(/,/g, ""));
    });

    $('#plchave').on("input", function(e) {
        $(this).val($(this).val().replace(/ /g, ";"));
    });
</script>

<?php
include_once "footer.php";
?>