<?php
include "db.php";
include 'phpqrcode/qrlib.php';
include "header.php";

mysqli_query($conexao, "SET NAMES utf8");
?>

<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="css/buttons.dataTables.min.css" rel="stylesheet">

<!-- Begin Page Content -->
<div class="container-fluid">

  <div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <center>
          <h3 class="m-0 font-weight-bold text-primary">Resultado</h3>
        </center>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped " id="resultado" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Nome Projeto</th>
                <th>Categoria</th>
                <th>Área</th>
                <th>Autor do Projeto</th>
                <th>Instituição</th>
                <th>Orientador do Projeto</th>
                <th>Apresentador do Projeto</th>
                <th>Nota Final</th>
              </tr>
            </thead>

            <?php
            $query = mysqli_query($conexao, "SELECT 
            avaliacoes.projetos_id,
            projetos.nome_projeto,
            projetos.titulo_projeto,
            orientadores_projeto.id,
            orientadores_projeto.nome_orientador,
            projetos.autor_projeto,
            projetos.orientadores_projeto_id,
            projetos.apresentador_projeto,
            projetos.areas_projeto_id,
            projetos.instituicao_autor,
            areas_projeto.id,
            areas_projeto.nome_area,
            categorias_projetos.id,
            categorias_projetos.nome_categoria
            
         FROM 
            avaliacoes,projetos,orientadores_projeto,coautores_projeto,categorias_projetos,areas_projeto 
            WHERE avaliacoes.projetos_id = projetos.id AND projetos.areas_projeto_id = areas_projeto.id AND projetos.categorias_projetos_id = categorias_projetos.id AND projetos.orientadores_projeto_id = orientadores_projeto.id AND avaliacoes.projetos_id IN (SELECT avaliacoes.projetos_id FROM avaliacoes GROUP BY avaliacoes.projetos_id) GROUP BY avaliacoes.projetos_id");
            while ($result = mysqli_fetch_array($query)) {
              $query2 = mysqli_query($conexao, "SELECT 
   avaliacoes.projetos_id, 
   (SUM(avaliacoes.q11)/count(avaliacoes.avaliadores_id_avaliador)+
   SUM(avaliacoes.q12)/count(avaliacoes.avaliadores_id_avaliador)+
   SUM(avaliacoes.q13)/count(avaliacoes.avaliadores_id_avaliador)+
   SUM(avaliacoes.q14)/count(avaliacoes.avaliadores_id_avaliador)+
   SUM(avaliacoes.q21)/count(avaliacoes.avaliadores_id_avaliador)+
   SUM(avaliacoes.q22)/count(avaliacoes.avaliadores_id_avaliador)+
   SUM(avaliacoes.q23)/count(avaliacoes.avaliadores_id_avaliador)+
   SUM(avaliacoes.q24)/count(avaliacoes.avaliadores_id_avaliador)+
   SUM(avaliacoes.q25)/count(avaliacoes.avaliadores_id_avaliador)+
   SUM(avaliacoes.q31)/count(avaliacoes.avaliadores_id_avaliador)+
   SUM(avaliacoes.q32)/count(avaliacoes.avaliadores_id_avaliador)+
   SUM(avaliacoes.q33)/count(avaliacoes.avaliadores_id_avaliador)+
   SUM(avaliacoes.q34)/count(avaliacoes.avaliadores_id_avaliador))/13
   AS MEDIA   
FROM 
   avaliacoes
   WHERE avaliacoes.projetos_id = '" . $result['projetos_id'] . "'");
              $result2 = mysqli_fetch_array($query2);
              $result2['MEDIA'] = number_format($result2['MEDIA'], 2, '.', '');
              if ($result['apresentador_projeto'] == 0) {
                echo "<tr>
                <td>" . ($result['nome_projeto']) . "</td>
                <td>" . ($result['nome_categoria']) . "</td>
                <td>" . ($result['nome_area']) . "</td>
                <td>" . ($result['autor_projeto']) . "</td>
                <td>" . ($result['instituicao_autor']) . "</td>
                <td>" . ($result['nome_orientador']) . "</td>
                <td>" . ($result['autor_projeto']) . "</td>
                <td>" . ($result2['MEDIA']) . "</td>
                </tr>";
              } else {
                $apresentador = mysqli_query($conexao, "SELECT
                  *
                  FROM
                  coautores_projeto
                  WHERE
                  id = '" . $result['apresentador_projeto'] . "'");
                $result_apresentador = mysqli_fetch_array($apresentador);
                echo "<tr>
                <td>" . ($result['nome_projeto']) . "</td>
                <td>" . ($result['nome_categoria']) . "</td>
                <td>" . ($result['nome_area']) . "</td>
                <td>" . ($result['autor_projeto']) . "</td>
                <td>" . ($result['instituicao_autor']) . "</td>
                <td>" . ($result['nome_orientador']) . "</td>
                <td>" . ($result_apresentador['nome_coautor']) . "</td>
                <td>" . ($result2['MEDIA']) . "</td>
                </tr>";
              }
            }
            ?>
            <tbody>
            <tfoot>
              <tr>
                <th>Nome Projeto</th>
                <th>Categoria</th>
                <th>Área</th>
                <th>Autor do Projeto</th>
                <th>Instituição</th>
                <th>Orientador do Projeto</th>
                <th>Apresentador do Projeto</th>
                <th>Nota Final</th>
              </tr>
            </tfoot>
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


<script>
  $(document).ready(function() {
    $('#resultado').DataTable({
      initComplete: function() {
        this.api().columns([1, 2, 4]).every(function() {
          var column = this;
          var select = $('<select><option value="">Mostrar todos</option></select>')
            .appendTo($(column.footer()).empty())
            .on('change', function() {
              var val = $.fn.dataTable.util.escapeRegex(
                $(this).val()
              );

              column
                .search(val ? '^' + val + '$' : '', true, false)
                .draw();
            });

          column.data().unique().sort().each(function(d, j) {
            select.append('<option value="' + d + '">' + d + '</option>')
          });
        });
      },
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
      ],"order": [[ 7, "desc" ]],
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