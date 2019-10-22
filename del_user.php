<?php
include_once("db.php");
session_start();

$id = $_GET['id'];
if($_SESSION['usuario_pesq_id']==$id){
    echo "<script>alert('Você não pode deletar seu proprio usuário!');window.location='listar_pesquisa.php'</script>";
}else{
    $query = mysqli_query($conexao,"DELETE FROM usuarios_pesq WHERE id_pesq = '$id'");
echo "<script>alert('Usuário DELETADO com sucesso!');window.location='listar_pesquisa.php'</script>";
}


?>