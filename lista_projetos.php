<?php
include_once("db.php");

include_once("header.php");
mysqli_query($conexao, "SET NAMES utf8");
$result_consultaProjeto = "SELECT 
projetos.id AS projid,
projetos.nome_projeto,
projetos.titulo_projeto,
projetos.autor_projeto,
projetos.endereco_autor,
projetos.cidade_autor,
projetos.email_autor,
projetos.fone_autor,
projetos.instituicao_autor,
projetos.apresentador_projeto,
projetos.palavraschave_projeto,
categorias_projetos.nome_categoria,
orientadores_projeto.nome_orientador,
orientadores_projeto.id,
areas_projeto.nome_area,
subareas_projeto.nome_subarea,
categorias_projetos.id AS catid,
areas_projeto.id AS areaid,
subareas_projeto.id AS subid,
orientadores_projeto.instituicao_orientador,
orientadores_projeto.email_orientadorcol,
orientadores_projeto.email_orientadorcol1,
orientadores_projeto.fone_orientador
FROM 
projetos,
categorias_projetos,
areas_projeto,
subareas_projeto,
orientadores_projeto,
coautores_projeto
WHERE 
projetos.categorias_projetos_id = categorias_projetos.id
and projetos.areas_projeto_id = areas_projeto.id
and projetos.subarea_projeto_id = subareas_projeto.id
and projetos.orientadores_projeto_id = orientadores_projeto.id
GROUP BY projetos.nome_projeto";
$resultado_consultaProjeto = mysqli_query($conexao, $result_consultaProjeto);
?>

<style type="text/css">
  .carregando {
    color: #ff0000;
    display: none;
  }
</style>
<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="css/buttons.dataTables.min.css" rel="stylesheet">

<!-- Begin Page Content -->
<div class="container-fluid">

  <div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-10">
      <div class="card-header py-8">
        <center>
          <h3 class="m-0 font-weight-bold text-primary">Listar Projetos</h3>
        </center>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="lista-produto" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Nome</th>
                <th>Autor</th>
                <th>Instituição</th>
                <th>Categoria</th>
                <th>Orientador</th>
                <th>Área</th>
                <th>Subárea</th>
                <th>Ações</th>
              </tr>
            </thead>

            <tbody>

              <?php while ($rows_consultaProjeto = mysqli_fetch_array($resultado_consultaProjeto)) {
                ?>

                <tr>
                  <td><?php echo $rows_consultaProjeto['nome_projeto']; ?></td>
                  <td><?php echo $rows_consultaProjeto['autor_projeto']; ?></td>
                  <td><?php echo $rows_consultaProjeto['instituicao_autor']; ?></td>
                  <td><?php echo $rows_consultaProjeto['nome_categoria']; ?></td>
                  <td><?php echo $rows_consultaProjeto['nome_orientador']; ?></td>
                  <td><?php echo $rows_consultaProjeto['nome_area']; ?></td>
                  <td><?php echo $rows_consultaProjeto['nome_subarea']; ?></td>

                  <td>
                    <a class='btn-sm btn-success' href="#" data-toggle="modal" data-target="#infomodal<?php echo $rows_consultaProjeto['projid']; ?>"><i class="fas fa-info "></i></a>
                    <a class='btn-sm btn-warning' href="#" data-toggle="modal" data-target="#editmodal<?php echo $rows_consultaProjeto['projid']; ?>"><i class='fas fa-edit'></i></a>
                    <a class='btn-sm btn-danger' href="del_projeto.php?id=<?php echo $rows_consultaProjeto['projid']; ?>" onclick="return confirm('Você tem certeza que deseja deletar esse projeto?');"><i class='fas fa-trash-alt'></i></a>
                  </td>

                  <!-- Info Modal-->
                  <div class="modal fade" id="infomodal<?php $projid = $rows_consultaProjeto['projid'];
                                                          echo $rows_consultaProjeto['projid']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Informações do Projeto:<strong>
                              <font color="#3c6178"> <?php echo $rows_consultaProjeto['nome_projeto']; ?></font>
                            </strong></h5>
                          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <p><label for="recipient-name" class="col-form-label">Nome Projeto:</label>
                            <input class="form-control" type="text" disabled value="<?php echo $rows_consultaProjeto['nome_projeto']; ?>"></p>
                          <p><label for="recipient-name" class="col-form-label">Título Projeto:</label>
                            <textarea class="form-control" type="text" disabled><?php echo $rows_consultaProjeto['titulo_projeto']; ?></textarea></p>
                          <p><label for="recipient-name" class="col-form-label">Autor Projeto:</label>
                            <input class="form-control" type="text" disabled value="<?php echo $rows_consultaProjeto['autor_projeto']; ?>"></p>
                          <p><label for="recipient-name" class="col-form-label">Endereço Autor:</label>
                            <input class="form-control" type="text" disabled value="<?php echo $rows_consultaProjeto['endereco_autor']; ?>"></p>
                          <p><label for="recipient-name" class="col-form-label">Cidade Autor:</label>
                            <input class="form-control" type="text" disabled value="<?php echo $rows_consultaProjeto['cidade_autor']; ?>"></p>
                          <p><label for="recipient-name" class="col-form-label">E-mail Autor:</label>
                            <input class="form-control" type="mail" disabled value="<?php echo $rows_consultaProjeto['email_autor']; ?>"></p>
                          <p><label for="recipient-name" class="col-form-label">Telefone Autor:</label>
                            <input class="form-control" type="text" disabled value="<?php echo $rows_consultaProjeto['fone_autor']; ?>"></p>
                          <p><label for="recipient-name" class="col-form-label">Instituição Autor:</label>
                            <input class="form-control" type="text" disabled value="<?php echo $rows_consultaProjeto['instituicao_autor']; ?>"></p>
                          <p><label for="recipient-name" class="col-form-label">Coautores Projeto:</label>
                            <textarea class="form-control" type="text" disabled><?php $result_consultaCoautor = "SELECT 
projetos.id,
projeto_coautores.id_projeto,
projeto_coautores.id_coautores,
coautores_projeto.nome_coautor
FROM 
projetos,
coautores_projeto,
projeto_coautores
WHERE 
'$projid' = projeto_coautores.id_projeto AND
projeto_coautores.id_coautores = coautores_projeto.id
GROUP BY coautores_projeto.nome_coautor
";
                                                                                  $resultado_consultaCoautor = mysqli_query($conexao, $result_consultaCoautor);
                                                                                  while ($rows_consultaCoautor = mysqli_fetch_array($resultado_consultaCoautor)) {
                                                                                    echo $rows_consultaCoautor['nome_coautor'] . "\n";
                                                                                  } ?></textarea></p>
                          <p><label for="recipient-name" class="col-form-label">Apresentador do Projeto:</label>
                            <input class="form-control" type="text" disabled value="<?php if ($rows_consultaProjeto['apresentador_projeto'] == 0) {
                                                                                        echo $rows_consultaProjeto['autor_projeto'];
                                                                                      } else {
                                                                                        $idap = $rows_consultaProjeto['apresentador_projeto'];
                                                                                        $result_consultaApres = "SELECT * FROM coautores_projeto WHERE id = '$idap'";
                                                                                        $resultado_consultaApres = mysqli_query($conexao, $result_consultaApres);
                                                                                        $rows_consultaApres = mysqli_fetch_array($resultado_consultaApres);
                                                                                        echo $rows_consultaApres['nome_coautor'];
                                                                                      } ?>"></p>
                          <p><label for="recipient-name" class="col-form-label">Palavra-chave do Projeto:</label>
                            <input class="form-control" type="text" disabled value="<?php echo $rows_consultaProjeto['palavraschave_projeto']; ?>"></p>
                          <p><label for="recipient-name" class="col-form-label">Orientador do Projeto:</label>
                            <input class="form-control" type="text" disabled value="<?php echo $rows_consultaProjeto['nome_orientador']; ?>"></p>
                          <p><label for="recipient-name" class="col-form-label">Categoria do Projeto:</label>
                            <input class="form-control" type="text" disabled value="<?php echo $rows_consultaProjeto['nome_categoria']; ?>"></p>
                          <p><label for="recipient-name" class="col-form-label">Área do Projeto:</label>
                            <input class="form-control" type="text" disabled value="<?php echo $rows_consultaProjeto['nome_area']; ?>"></p>
                          <p><label for="recipient-name" class="col-form-label">Subárea do Projeto:</label>
                            <input class="form-control" type="text" disabled value="<?php echo $rows_consultaProjeto['nome_subarea']; ?>"></p>
                        </div>
                        <div class="modal-footer">
                          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Fim Modal -->
                  <!-- Edit Modal-->
                  <div class="modal fade" id="editmodal<?php echo $rows_consultaProjeto['projid']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Informações do Projeto:<strong>
                              <font color="#3c6178"> <?php echo $rows_consultaProjeto['nome_projeto']; ?></font>
                            </strong></h5>
                          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">

                          <form action="altera_projetos.php" id="edita<?php echo $rows_consultaProjeto['projid']; ?>" method="POST" class="form-horizontal form-label-left">

                            <h3>Projeto</h3>
                            <div class="item form-group">
                              <label class="control-label col-md-6 col-sm-3 col-xs-12" for="nome">Nome do Projeto:
                              </label>
                              <div class="col-md-10 col-sm-6 col-xs-12">
                                <input class="form-control col-md-10 col-xs-12" value="<?php echo $rows_consultaProjeto['nome_projeto']; ?>" required="required" type="text" name="nome_projeto" placeholder="Insira o nome do projeto">
                              </div>
                            </div>

                            <div class="item form-group">
                              <label class="control-label col-md-6 col-sm-3 col-xs-12" for="nome">Título do Projeto:
                              </label>
                              <div class="col-md-10 col-sm-6 col-xs-12">
                                <input class="form-control col-md-10 col-xs-12" value="<?php echo $rows_consultaProjeto['titulo_projeto']; ?>" name="titulo_projeto" placeholder="Insira a título do projeto" required="required" type="text">
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
                                    <option value="<?php echo $row_categorias_projeto['id']; ?>" <?php if ($rows_consultaProjeto['catid'] == $row_categorias_projeto['id']) {
                                                                                                        echo "selected";
                                                                                                      } ?>><?php echo $row_categorias_projeto['nome_categoria']; ?></option> <?php
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
                                    <option value="<?php echo $row_areas_projeto['id']; ?>" <?php if ($rows_consultaProjeto['areaid'] == $row_areas_projeto['id']) {
                                                                                                  echo "selected";
                                                                                                } ?>><?php echo $row_areas_projeto['nome_area']; ?></option> <?php
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
                                <input class="form-control col-md-10 col-xs-12" value="<?php echo $rows_consultaProjeto['palavraschave_projeto']; ?>" id="plchave" name="palavraschave_projeto" placeholder="Insira as palavras-chave referente ao projeto" required="required" type="text">
                              </div>
                            </div>

                            <div class="item form-group">
                              <div class="col-md-10 col-sm-6 col-xs-12">
                                <input class="form-control col-md-10 col-xs-12" name="id_projeto" type="hidden" value="<?php echo $rows_consultaProjeto['id']; ?>">
                              </div>
                            </div>


                            <div class="item form-group">
                              <label class="control-label col-md-6 col-sm-3 col-xs-12" for="nome">Apresentador do Projeto:
                              </label>
                              <div class="col-md-10 col-sm-6 col-xs-12">
                                <select class="form-control col-md-10 col-xs-12" name="apresentador_projeto" id="apresentador_projeto">
                                  <option value="0"><?php echo $rows_consultaProjeto['autor_projeto']; ?></option>
                                  <?php
                                    $idproj = $rows_consultaProjeto['projid'];
                                    $result_coautores2 = "SELECT coautores_projeto.id,coautores_projeto.nome_coautor,projeto_coautores.id_projeto,projeto_coautores.id_coautores,projetos.id FROM coautores_projeto,projeto_coautores,projetos WHERE projeto_coautores.id_projeto = $idproj AND projeto_coautores.id_coautores = coautores_projeto.id GROUP BY coautores_projeto.nome_coautor ";
                                    $resultado_coautores2 = mysqli_query($conexao, $result_coautores2);
                                    while ($row_coautores2 = mysqli_fetch_assoc($resultado_coautores2)) { ?>
                                    <option value="<?php echo $row_coautores2['id_coautores']; ?>" <?php if ($row_coautores2['id_coautores'] == $rows_consultaProjeto['apresentador_projeto']) {
                                                                                                          echo "selected";
                                                                                                        } ?>><?php echo $row_coautores2['nome_coautor']; ?></option> <?php
                                                                                                                                                                        }
                                                                                                                                                                        ?>
                                </select>
                              </div>
                            </div>

                            <h3>Autor</h3>

                            <div class="item form-group">
                              <label class="control-label col-md-6 col-sm-3 col-xs-12" for="nome">Autor do Projeto:
                              </label>
                              <div class="col-md-10 col-sm-6 col-xs-12">
                                <input class="form-control col-md-10 col-xs-12" value="<?php echo $rows_consultaProjeto['autor_projeto']; ?>" name="autor_projeto" placeholder="Insira o nome do autor do projeto" required="required" type="text">
                              </div>
                            </div>

                            <div class="item form-group">
                              <label class="control-label col-md-6 col-sm-3 col-xs-12" for="nome">Endereço do autor:
                              </label>
                              <div class="col-md-10 col-sm-6 col-xs-12">
                                <input class="form-control col-md-10 col-xs-12" value="<?php echo $rows_consultaProjeto['endereco_autor']; ?>" name="endereco_autor" placeholder="Insira o endereço do autor do projeto" required="required" type="text">
                              </div>
                            </div>

                            <div class="item form-group">
                              <label class="control-label col-md-6 col-sm-3 col-xs-12" for="nome">Cidade do autor:
                              </label>
                              <div class="col-md-10 col-sm-6 col-xs-12">
                                <input class="form-control col-md-10 col-xs-12" value="<?php echo $rows_consultaProjeto['cidade_autor']; ?>" name="cidade_autor" placeholder="Insira a cidade do autor do projeto" required="required" type="text">
                              </div>
                            </div>

                            <div class="item form-group">
                              <label class="control-label col-md-6 col-sm-3 col-xs-12" for="nome">E-mail do autor:
                              </label>
                              <div class="col-md-10 col-sm-6 col-xs-12">
                                <input class="form-control col-md-10 col-xs-12" value="<?php echo $rows_consultaProjeto['email_autor']; ?>" name="email_autor" placeholder="Insira o e-mail do autor do projeto" required="required" type="mail">
                              </div>
                            </div>

                            <div class="item form-group">
                              <label class="control-label col-md-6 col-sm-3 col-xs-12" for="nome">Telefone do autor:
                              </label>
                              <div class="col-md-10 col-sm-6 col-xs-12">
                                <input class="form-control col-md-10 col-xs-12" value="<?php echo $rows_consultaProjeto['fone_autor']; ?>" name="fone_autor" placeholder="Insira o telefone do autor do projeto" onkeyup="mascara('(##)#####-####',this,event,true)" required="required" type="text">
                              </div>
                            </div>

                            <div class="item form-group">
                              <label class="control-label col-md-6 col-sm-3 col-xs-12" for="nome">Instituição do autor:
                              </label>
                              <div class="col-md-10 col-sm-6 col-xs-12">
                                <input class="form-control col-md-10 col-xs-12" value="<?php echo $rows_consultaProjeto['instituicao_autor']; ?>" name="instituicao_autor" placeholder="Insira a instituição do autor do projeto" required="required" type="text">
                              </div>
                            </div>

                            <h3>Orientador</h3>


                            <div class="item form-group">
                              <div class="col-md-10 col-sm-6 col-xs-12">
                                <input class="form-control col-md-10 col-xs-12" name="id_orientador" type="hidden" value="<?php echo $resultado_Orientador['id']; ?>">
                              </div>
                            </div>

                            <div class="item form-group">
                              <label class="control-label col-md-6 col-sm-3 col-xs-12" for="nome">Nome do Orientador:
                              </label>
                              <div class="col-md-10 col-sm-6 col-xs-12">
                                <input class="form-control col-md-10 col-xs-12" value="<?php echo $rows_consultaProjeto['nome_orientador']; ?>" name="nome_orientador" placeholder="Insira o nome do orientador" required="required" type="text">
                              </div>
                            </div>

                            <div class="item form-group">
                              <label class="control-label col-md-6 col-sm-3 col-xs-12" for="nome">Instituição do Orientador:
                              </label>
                              <div class="col-md-10 col-sm-6 col-xs-12">
                                <input class="form-control col-md-10 col-xs-12" value="<?php echo $rows_consultaProjeto['instituicao_orientador']; ?>" name="instituicao_orientador" placeholder="Insira a instituição do orientador" required="required" type="text">
                              </div>
                            </div>

                            <div class="item form-group">
                              <label class="control-label col-md-6 col-sm-3 col-xs-12" for="nome">E-mail do Orientador:
                              </label>
                              <div class="col-md-10 col-sm-6 col-xs-12">
                                <input class="form-control col-md-10 col-xs-12" value="<?php echo $rows_consultaProjeto['email_orientadorcol']; ?>" name="email_orientadorcol" placeholder="Insira o e-mail do orientador" required="required" type="mail">
                              </div>
                            </div>

                            <div class="item form-group">
                              <label class="control-label col-md-6 col-sm-3 col-xs-12" for="nome">E-mail do Orientador:
                              </label>
                              <div class="col-md-10 col-sm-6 col-xs-12">
                                <input class="form-control col-md-10 col-xs-12" value="<?php echo $rows_consultaProjeto['email_orientadorcol1']; ?>" name="email_orientadorcol1" placeholder="Insira o segundo e-mail do orientador, caso haja" type="mail">
                              </div>
                            </div>

                            <div class="item form-group">
                              <label class="control-label col-md-6 col-sm-3 col-xs-12" for="nome">Telefone do Orientador:
                              </label>
                              <div class="col-md-10 col-sm-6 col-xs-12">
                                <input class="form-control col-md-10 col-xs-12" value="<?php echo $rows_consultaProjeto['fone_orientador']; ?>" name="fone_orientador" required="required" placeholder="Insira o telefone do orientador" onkeyup="mascara('(##)#####-####',this,event,true)" required="required" type="text">
                              </div>
                            </div>

                            <div class="item form-group">
                              <label class="control-label col-md-6 col-sm-3 col-xs-12" for="nome">Instituição do Orientador:
                              </label>
                              <div class="col-md-10 col-sm-6 col-xs-12">
                                <input class="form-control col-md-10 col-xs-12" value="<?php echo $rows_consultaProjeto['instituicao_orientador']; ?>" name="instituicao_orientador" placeholder="Insira a instituição do orientador" required="required" type="text">
                              </div>
                            </div>

                        </div>

                        <div class="modal-footer">
                          <button class="btn btn-success" form="edita<?php echo $rows_consultaProjeto['projid']; ?>" type="submit">Salvar</button>
                          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <!-- Fim Modal -->
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>

  <!-- End of Main Content -->
</div>
</div>

<!-- Footer -->
<footer class="sticky-footer bg-white">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
      <span>Copyright &copy; NUPSI 2019</span>
    </div>
  </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>


<!-- Bootstrap core JavaScript-->
<!-- Subitens funcionar-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="js/jszip.min.js"></script>
<script type="text/javascript" src="js/pdfmake.min.js"></script>
<script type="text/javascript" src="js/vfs_fonts.js"></script>
<script type="text/javascript" src="js/vfs_fonts.js"></script>
<script type="text/javascript" src="js/buttons.html5.min.js"></script>
<script type="text/javascript" src="js/buttons.colVis.min.js"></script>
<script type="text/javascript" src="js/buttons.print.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"></script>

<!-- Page level plugins -->
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>


<script type="text/javascript">
  $(function() {
    $('#areas_projeto_id').change(function() {
      if ($(this).val()) {
        $('#id_sub_categoria').hide();
        $('.carregando').show();
        $.getJSON('subcategoria.php?search=', {
          areas_projeto_id: $(this).val(),
          ajax: 'true'
        }, function(j) {
          var options = '<option value="">Escolha Subárea</option>';
          for (var i = 0; i < j.length; i++) {
            options += '<option value="' + j[i].id + '">' + j[i].nome_subarea + '</option>';
          }
          $('#id_sub_categoria').html(options).show();
          $('.carregando').hide();
        });
      } else {
        $('#id_sub_categoria').html('<option value="">– Escolha Subárea –</option>');
      }
    });
  });
</script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#lista-produto').DataTable({
      dom: 'Bfrtip',
      columnDefs: [{
        targets: 1,
        className: 'noVis'
      }],
      "columnDefs": [{
        "width": "8%",
        "targets": 7
      }],
      buttons: [{
          extend: "print",
          text: 'Imprimir',
          exportOptions: {
            columns: ':visible',
            stripHtml: false
          },
          customize: function(win) {

            var last = null;
            var current = null;
            var bod = [];

            var css = '@page { size: landscape; }',
              head = win.document.head || win.document.getElementsByTagName('head')[0],
              style = win.document.createElement('style');

            style.type = 'text/css';
            style.media = 'print';

            if (style.styleSheet) {
              style.styleSheet.cssText = css;
            } else {
              style.appendChild(win.document.createTextNode(css));
            }

            head.appendChild(style);
          }
        },
        {
          extend: 'excelHtml5',
          text: 'Excel',
          orientation: 'landscape',
          exportOptions: {
            columns: ':visible'
          }
        },
        {
          extend: 'pdfHtml5',
          text: 'PDF',
          orientation: 'landscape',
          exportOptions: {
            columns: ':visible'
          }
        },
        {
          extend: 'colvis',
          text: 'Esconder Colunas'
        }
      ],
      "language": {
        "sEmptyTable": "Nenhum registro encontrado",
        "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
        "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
        "sInfoFiltered": "(Filtrados de _MAX_ registros)",
        "sInfoPostFix": "",
        "sInfoThousands": ".",
        "sLengthMenu": "_MENU_ resultados por página",
        "sLoadingRecords": "Carregando...",
        "sProcessing": "Processando...",
        "sZeroRecords": "Nenhum registro encontrado",
        "sSearch": "Pesquisar",
        "oPaginate": {
          "sNext": "Próximo",
          "sPrevious": "Anterior",
          "sFirst": "Primeiro",
          "sLast": "Último"
        },
        "oAria": {
          "sSortAscending": ": Ordenar colunas de forma ascendente",
          "sSortDescending": ": Ordenar colunas de forma descendente"
        }
      }
    });
  });
</script>

</body>

</html>