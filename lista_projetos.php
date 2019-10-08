<?php
include_once("db.php");

include_once("header.php");
mysqli_query($conexao, "SET NAMES utf8");
$result_consultaProjeto = "SELECT 
projetos.id,
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
areas_projeto.nome_area,
subareas_projeto.nome_subarea,
coautores_projeto.nome_coautor
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
and projetos.apresentador_projeto = coautores_projeto.id
or(projetos.apresentador_projeto = 0)
GROUP BY projetos.nome_projeto";
$resultado_consultaProjeto = mysqli_query($conexao, $result_consultaProjeto);
?>

<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="css/buttons.dataTables.min.css" rel="stylesheet">

<!-- Begin Page Content -->
<div class="container-fluid">

  <div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-5">
      <div class="card-header py-3">
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
                    <a class='btn-sm btn-success' href="#" data-toggle="modal" data-target="#infomodal<?php echo $rows_consultaProjeto['id']; ?>"><i class="fas fa-info "></i></a>
                    <a class='btn-sm btn-warning' href="#" data-toggle="modal" data-target="#editmodal<?php echo $rows_consultaProjeto['id']; ?>"><i class='fas fa-edit'></i></a>
                    <a class='btn-sm btn-danger' href="del_projeto.php?id=<?php echo $rows_consultaProjeto['id']; ?>" onclick="return confirm('Você tem certeza que deseja deletar esse projeto?');"><i class='fas fa-trash-alt'></i></a>
                  </td>

                  <!-- Info Modal-->
                  <div class="modal fade" id="infomodal<?php $id = $rows_consultaProjeto['id'];
                                                          echo $rows_consultaProjeto['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
'$id' = projeto_coautores.id_projeto AND
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
                                                                                        echo $rows_consultaProjeto['nome_coautor'];
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
                  <div class="modal fade" id="editmodal<?php echo $rows_consultaProjeto['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <input class="form-control" type="text" value="<?php echo $rows_consultaProjeto['nome_projeto']; ?>"></p>
                          <p><label for="recipient-name" class="col-form-label">Título Projeto:</label>
                            <textarea class="form-control" type="text"><?php echo $rows_consultaProjeto['titulo_projeto']; ?></textarea></p>
                          <p><label for="recipient-name" class="col-form-label">Autor Projeto:</label>
                            <input class="form-control" type="text" value="<?php echo $rows_consultaProjeto['autor_projeto']; ?>"></p>
                          <p><label for="recipient-name" class="col-form-label">Endereço Autor:</label>
                            <input class="form-control" type="text" value="<?php echo $rows_consultaProjeto['endereco_autor']; ?>"></p>
                          <p><label for="recipient-name" class="col-form-label">Cidade Autor:</label>
                            <input class="form-control" type="text" value="<?php echo $rows_consultaProjeto['cidade_autor']; ?>"></p>
                          <p><label for="recipient-name" class="col-form-label">E-mail Autor:</label>
                            <input class="form-control" type="mail" value="<?php echo $rows_consultaProjeto['email_autor']; ?>"></p>
                          <p><label for="recipient-name" class="col-form-label">Telefone Autor:</label>
                            <input class="form-control" type="text" value="<?php echo $rows_consultaProjeto['fone_autor']; ?>"></p>
                          <p><label for="recipient-name" class="col-form-label">Instituição Autor:</label>
                            <input class="form-control" type="text" value="<?php echo $rows_consultaProjeto['instituicao_autor']; ?>"></p>
                          <p><label for="recipient-name" class="col-form-label">Apresentador do Projeto:</label>
                            <input class="form-control" type="text" value="<?php if ($rows_consultaProjeto['apresentador_projeto'] == 0) {
                                                                                echo $rows_consultaProjeto['autor_projeto'];
                                                                              } else {
                                                                                echo $rows_consultaProjeto['nome_coautor'];
                                                                              } ?>"></p>
                          <p><label for="recipient-name" class="col-form-label">Palavra-chave do Projeto:</label>
                            <input class="form-control" type="text" value="<?php echo $rows_consultaProjeto['palavraschave_projeto']; ?>"></p>
                          <p><label for="recipient-name" class="col-form-label">Orientador do Projeto:</label>
                            <input class="form-control" type="text" value="<?php echo $rows_consultaProjeto['nome_orientador']; ?>"></p>
                          <p><label for="recipient-name" class="col-form-label">Categoria do Projeto:</label>
                            <input class="form-control" type="text" value="<?php echo $rows_consultaProjeto['nome_categoria']; ?>"></p>
                          <p><label for="recipient-name" class="col-form-label">Área do Projeto:</label>
                            <input class="form-control" type="text" value="<?php echo $rows_consultaProjeto['nome_area']; ?>"></p>
                          <p><label for="recipient-name" class="col-form-label">Subárea do Projeto:</label>
                            <input class="form-control" type="text" value="<?php echo $rows_consultaProjeto['nome_subarea']; ?>"></p>
                        </div>
                        <div class="modal-footer">
                          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                        </div>
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
  $(document).ready(function() {
    $('#lista-produto').DataTable({
      dom: 'Bfrtip',
      columnDefs: [{
        targets: 1,
        className: 'noVis'
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
<script type="text/javascript">
  $('#infomodal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var recipient = button.data('whatever') // Extract info from data-* attributes
    var recipientnome = button.data('whatevernome')
    var recipientdetalhes = button.data('whateverdetalhes')
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    modal.find('.modal-title').text('ID ' + recipient)
    modal.find('#id-curso').val(recipient)
    modal.find('#recipient-name').val(recipientnome)
    modal.find('#detalhes').val(recipientdetalhes)

  })
</script>

</body>

</html>