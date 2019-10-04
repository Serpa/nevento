<?php
include "db.php";

include "header.php";

$query = mysqli_query($conexao, "SELECT 
   projetos.nome_projeto,
   projetos.id,
   projetos.autor_projeto,
   projetos.instituicao_autor,
   projetos.apresentador_projeto,
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
   GROUP BY projetos.nome_projeto");
?>

<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

<!-- Begin Page Content -->
<div class="container-fluid">


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <center>
          <h3 class="m-0 font-weight-bold text-primary">Listar Projetos</h3>
        </center>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped " id="lista_projetos" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Informações</th>
                <th>Nome</th>
                <th>Autor</th>
                <th>Instituição</th>
                <th>Apresentador</th>
                <th>Categoria</th>
                <th>Orientador</th>
                <th>Área</th>
                <th>Subárea</th>
                <th>Ações</th>
              </tr>
            </thead>

            <tbody>
              <?php
              while ($result = mysqli_fetch_array($query)) {
                if ($result['apresentador_projeto'] == 0) {
                  echo "<tr>
                <td><a class='btn btn-success btn-sm'>+</a></td>
                <td>" . utf8_encode($result['nome_projeto']) . "</td>
                <td>" . utf8_encode($result['autor_projeto']) . "</td>
                <td>" . utf8_encode($result['instituicao_autor']) . "</td>
                <td>" . utf8_encode($result['autor_projeto']) . "</td>
                <td>" . utf8_encode($result['nome_categoria']) . "</td>
                <td>" . utf8_encode($result['nome_orientador']) . "</td>
                <td>" . utf8_encode($result['nome_area']) . "</td>
                <td>" . utf8_encode($result['nome_subarea']) . "</td>
                <td><a class='btn btn-warning btn-sm'  href='EditarProjeto.php?id=" . $result['id'] . "'>Editar</a>
                <a  class='btn btn-danger btn-sm' href='ExcluirProjeto.php?id=" . $result['id'] . "' onclick=\"return confirm('Você deseja realmente excluir esse projeto?');\"> Excluir</a></td>
                </tr>";
                } else {
                  echo "<tr>
                <td><a class='btn btn-success btn-sm'>+</a></td>
                <td>" . utf8_encode($result['nome_projeto']) . "</td>
                <td>" . utf8_encode($result['autor_projeto']) . "</td>
                <td>" . utf8_encode($result['instituicao_autor']) . "</td>
                <td>" . utf8_encode($result['nome_coautor']) . "</td>
                <td>" . utf8_encode($result['nome_categoria']) . "</td>
                <td>" . utf8_encode($result['nome_orientador']) . "</td>
                <td>" . utf8_encode($result['nome_area']) . "</td>
                <td>" . utf8_encode($result['nome_subarea']) . "</td>
                <td><a class='btn btn-warning btn-sm'  href='EditarProjeto.php?id=" . $result['id'] . "'>Editar</a>
                <a  class='btn btn-danger btn-sm' href='ExcluirProjeto.php?id=" . $result['id'] . "' onclick=\"return confirm('Você deseja realmente excluir esse projeto?');\"> Excluir</a></td>
                </tr>";
                }
              }
              ?>
            </tbody>
          </table>
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

<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"></script>

<!-- Page level plugins -->
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>


<script type="text/javascript">
  $(document).ready(function() {
    $('#lista_projetos').DataTable({
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
      },responsive: true
    });
  });
</script>


</body>

</html>