<?php
include_once("db.php");
session_start();

$id_coautor = $_POST['id_coautor'];
$id_projeto = $_POST['projeto'];
$projeto = mysqli_query($conexao,"SELECT * FROM projeto_coautores WHERE projeto_coautores.id_projeto = $id_projeto AND projeto_coautores.id_coautores = $id_coautor");
$result = mysqli_num_rows($projeto);
if($result > 0){
    echo "<script>alert('Você não pode vincular esse coautor, ele já é coautor desse projeto!');window.location='listar_coautor.php'</script>";
}else{
    mysqli_query($conexao, "INSERT INTO projeto_coautores(id_projeto, id_coautores) VALUES ($id_projeto, $id_coautor)");
echo "<script>alert('Coautor vinculado com sucesso!');window.location='listar_coautor.php'</script>";
}


?>