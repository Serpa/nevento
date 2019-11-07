<?php
include "db.php";
include 'phpqrcode/qrlib.php';
include "header.php";

mysqli_query($conexao, "SET NAMES utf8");
$result_coautor = "SELECT coautores_projeto.id,coautores_projeto.nome_coautor,projeto_coautores.id_projeto,projeto_coautores.id_coautores,projetos.id AS pid,projetos.nome_projeto FROM coautores_projeto,projeto_coautores,projetos WHERE projeto_coautores.id_projeto = projetos.id AND coautores_projeto.id = projeto_coautores.id_coautores";
$resultado_coautor = mysqli_query($conexao, $result_coautor);
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
                    <h3 class="m-0 font-weight-bold text-primary">Listar Coautores</h3>
                </center>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped " id="coautor" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Projeto</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($rows_coautor = mysqli_fetch_array($resultado_coautor)) {
                                ?>

                                <tr>
                                    <td><?php echo $rows_coautor['nome_coautor']; ?></td>
                                    <td><?php echo $rows_coautor['nome_projeto']; ?></td>
                                    <td>
                                        <a class='btn-sm btn-warning' href="#" data-toggle="modal" data-target="#editmodal<?php echo $rows_coautor['id']; ?>"><i class='fas fa-edit'></i></a>
                                        <a class='btn-sm btn-danger' href="del_coautor.php?id=<?php echo $rows_coautor['id']; ?>" onclick="return confirm('Você tem certeza que deseja deletar esse coautor?');"><i class='fas fa-trash-alt'></i></a>
                                        <a class='btn-sm btn-success' href="#" data-toggle="modal" data-target="#addmodal"><i class="fas fa-plus"></i></a>
                                        <a class='btn-sm btn-primary' href="#" data-toggle="modal" data-target="#linkmodal<?php echo $rows_coautor['id']; ?>"><i class="fas fa-link"></i></a>
                                        <a class='btn-sm btn-danger' href="unlink_coautor.php?id=<?php echo $rows_coautor['id']; ?>&projeto=<?php echo $rows_coautor['pid']; ?>" onclick="return confirm('Você tem certeza que deseja desvincular esse coautor?');"><i class="fas fa-unlink"></i></a>
                                    </td>
                                    <!-- Edit Modal-->
                                    <div class="modal fade" id="editmodal<?php echo $rows_coautor['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Coautor:<strong>
                                                            <font color="#3c6178"> <?php echo $rows_coautor['nome_coautor']; ?></font>
                                                        </strong></h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="atualiza_coautor.php" method="POST" id="form<?php echo $rows_coautor['id']; ?>" class="form-horizontal form-label-left">

                                                        <div class="item form-group">
                                                            <div class="col-md-10 col-sm-6 col-xs-12">
                                                                <input class="form-control col-md-10 col-xs-12" name="id_coautor" type="hidden" value="<?php echo $rows_coautor['id']; ?>">
                                                            </div>
                                                        </div>

                                                        <div class="item form-group">
                                                            <label class="control-label col-md-6 col-sm-3 col-xs-12" for="nome">Nome Coautor
                                                            </label>
                                                            <div class="col-md-10 col-sm-6 col-xs-12">
                                                                <input class="form-control col-md-10 col-xs-12" name="nome_coautor" required="required" type="text" value="<?php echo $rows_coautor['nome_coautor']; ?>">
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-primary" form="form<?php echo $rows_coautor['id']; ?>" type="submit">Salvar</button>
                                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Fim Modal -->

                                    <!-- ADD Modal-->
                                    <div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel"><strong>
                                                            <font color="#3c6178"> Cadastrar Novo Coautor</font>
                                                        </strong></h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="processa_coautor.php" method="POST" id="formadd" class="form-horizontal form-label-left">

                                                        <div class="item form-group">
                                                            <label class="control-label col-md-6 col-sm-3 col-xs-12" for="nome">Projetos:
                                                            </label>
                                                            <div class="col-md-10 col-sm-6 col-xs-12">
                                                                <select class="form-control col-md-10 col-xs-12" name="projeto" required>
                                                                    <option value="">Selecione o Projeto</option>
                                                                    <?php
                                                                        $result_projeto = "SELECT * FROM projetos";
                                                                        $resultado_projeto = mysqli_query($conexao, $result_projeto);
                                                                        while ($row_projeto = mysqli_fetch_assoc($resultado_projeto)) { ?>
                                                                        <option value="<?php echo utf8_encode($row_projeto['id']); ?>"><?php echo $row_projeto['nome_projeto']; ?></option> <?php
                                                                                                                                                                                                }
                                                                                                                                                                                                ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="item form-group">
                                                            <label class="control-label col-md-6 col-sm-3 col-xs-12" for="nome">Nome Coautor
                                                            </label>
                                                            <div class="col-md-10 col-sm-6 col-xs-12">
                                                                <input class="form-control col-md-10 col-xs-12" name="nome_coautor" required="required" type="text">
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-success" form="formadd" type="submit">Cadastrar</button>
                                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Fim Modal -->

                                    <!-- Link Modal-->
                                    <div class="modal fade" id="linkmodal<?php echo $rows_coautor['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Coautor:<strong>
                                                            <font color="#3c6178"> <?php echo $rows_coautor['nome_coautor']; ?></font>
                                                        </strong></h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="linka_coautor.php" method="POST" id="formlinka<?php echo $rows_coautor['id']; ?>" class="form-horizontal form-label-left">                                          

                                                        <div class="item form-group">
                                                            <div class="col-md-10 col-sm-6 col-xs-12">
                                                                <input class="form-control col-md-10 col-xs-12" name="id_coautor" type="hidden" value="<?php echo $rows_coautor['id']; ?>">
                                                            </div>
                                                        </div>

                                                        <div class="item form-group">
                                                            <label class="control-label col-md-6 col-sm-3 col-xs-12" for="nome">Projetos:
                                                            </label>
                                                            <div class="col-md-10 col-sm-6 col-xs-12">
                                                                <select class="form-control col-md-10 col-xs-12" name="projeto" required>
                                                                    <option value="">Selecione o Projeto</option>
                                                                    <?php
                                                                        $result_projeto = "SELECT * FROM projetos";
                                                                        $resultado_projeto = mysqli_query($conexao, $result_projeto);
                                                                        while ($row_projeto = mysqli_fetch_assoc($resultado_projeto)) { ?>
                                                                        <option value="<?php echo utf8_encode($row_projeto['id']); ?>"><?php echo $row_projeto['nome_projeto']; ?></option> <?php
                                                                                                                                                                                                }
                                                                                                                                                                                                ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="item form-group">
                                                            <label class="control-label col-md-6 col-sm-3 col-xs-12" for="nome">Nome Coautor
                                                            </label>
                                                            <div class="col-md-10 col-sm-6 col-xs-12">
                                                                <input class="form-control col-md-10 col-xs-12" name="nome_coautor" disabled type="text" value="<?php echo $rows_coautor['nome_coautor']; ?>">
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-primary" form="formlinka<?php echo $rows_coautor['id']; ?>" type="submit">Vincular Coautor</button>
                                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Fim Modal -->
                                </tr>
                            <?php } ?>
                        <tfoot>
                            <tr>
                                <th>Nome</th>
                                <th>Projeto</th>
                                <th>Ações</th>
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
<script src="js/mascaras.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"></script>

<!-- Page level plugins -->
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>


<script>
    $(document).ready(function() {
        $('#coautor').DataTable({
            initComplete: function() {
                this.api().columns([0, 1]).every(function() {
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
            ],
            "columnDefs": [{
                "width": "15%",
                "targets": 2
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