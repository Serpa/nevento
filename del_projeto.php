<?php
include_once("db.php");

$id = $_GET['id'];

$query = mysqli_query($conexao,"DELETE FROM `projetos` WHERE id = '$id'");

$query2 = mysqli_query($conexao,"DELETE FROM `projeto_coautores` WHERE id_projeto = '$id'");
?>