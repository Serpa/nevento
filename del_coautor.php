<?php
include_once("db.php");
session_start();

$id = $_GET['id'];
$apres = mysqli_query($conexao,"SELECT coautores_projeto.id,projetos.apresentador_projeto FROM projetos,coautores_projeto WHERE projetos.apresentador_projeto = $id");
$result = mysqli_num_rows($apres);
if($result > 0){
    echo "<script>alert('Você não pode deletar esse coautor, ele é apresentador de um projeto!');window.location='lista_projetos.php'</script>";
}else{
    $query = mysqli_query($conexao,"DELETE FROM coautores_projeto WHERE id = '$id'");
    $query2 = mysqli_query($conexao,"DELETE FROM projeto_coautores WHERE id_coautores = '$id'");
echo "<script>alert('Coautor DELETADO com sucesso!');window.location='listar_coautor.php'</script>";
}


?>