<?php
include_once("db.php");
session_start();

$id_coautor = $_GET['id'];
$id_projeto = $_GET['projeto'];
$apres = mysqli_query($conexao,"SELECT coautores_projeto.id,projetos.apresentador_projeto,projetos.id FROM projetos,coautores_projeto WHERE projetos.apresentador_projeto = $id_coautor AND projetos.id = $id_projeto");
$result = mysqli_num_rows($apres);
if($result > 0){
    echo "<script>alert('Você não pode desvincular esse coautor desse projeto, ele é apresentador do projeto projeto!');window.location='listar_coautor.php'</script>";
}else{
    $query2 = mysqli_query($conexao,"DELETE FROM projeto_coautores WHERE id_coautores = id_coautor AND id_projeto = id_projeto'");
echo "<script>alert('Coautor desvinculado com sucesso!');window.location='listar_coautor.php'</script>";
}


?>