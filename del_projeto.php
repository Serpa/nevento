<?php
include_once("db.php");

$id = $_GET['id'];

$query3 = mysqli_query($conexao,"DELETE FROM `avaliacoes` WHERE projetos_id = '$id'");

$query2 = mysqli_query($conexao,"DELETE FROM `projeto_coautores` WHERE id_projeto = '$id'");

$query = mysqli_query($conexao,"DELETE FROM `projetos` WHERE id = '$id'");

echo "<script>alert('Projeto Excluido com sucesso!');window.location='lista_projetos.php'</script>";
?>