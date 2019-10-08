<?php
include "db.php";
include 'phpqrcode/qrlib.php';
include "header.php";
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
          <h3 class="m-0 font-weight-bold text-primary">Listar Projetos</h3>
        </center>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped " id="lista_qrcode" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Título Projeto</th>
                <th>QrCode</th>
              </tr>
            </thead>

            <tbody>
              <?php
              mysqli_query($conexao, "SET character_set_results = 'utf8'");
              $query = mysqli_query($conexao, "SELECT id,nome_projeto FROM PROJETOS");

              while ($result = mysqli_fetch_array($query)) {
                $nome = $result['nome_projeto'];
                $id = $result['id'];
                QRcode::png($id, $id . '.png', QR_ECLEVEL_L, 10);
                echo "<tr>";
                echo "<td>" . $nome . "</td>";
                echo '<td><img src="';
                echo $id . '.png" /></td>';
                echo "</tr>";
              }
              ?>
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
    $('#lista_qrcode').DataTable({
      dom: 'Bfrtip',
      buttons: [{
          extend: "print",
          text: 'Imprimir',
          exportOptions: {
            columns: ':visible',
            stripHtml: false
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
            columns: ':visible',
            stripHtml: false
          }
        },
        {
          extend: 'colvis',
          text: 'Esconder Colunas'
        }
      ],
      "columnDefs": [{
        "width": "80%",
        "targets": 0
      }],
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