<?php
include_once("db.php");

$id = $_GET['id'];

$query = mysqli_query($conexao,"DELETE FROM usuarios_pesq WHERE id_pesq = '$id'");
echo "<script>alert('Avaliador DELETADO com sucesso!');window.location='listar_avaliador.php'</script>";

?>