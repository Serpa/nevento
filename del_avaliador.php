<?php
include_once("db.php");

$id = $_GET['id'];

$query = mysqli_query($conexao,"DELETE FROM avaliadores WHERE id_avaliador = '$id'");
echo "<script>alert('Avaliador DELETADO com sucesso!');window.location='listar_avaliador.php'</script>";

?>