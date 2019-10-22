<?php 

include 'db.php';
session_start();
mysqli_query($conexao, "SET NAMES utf8");

$id_projeto = $_POST['id_projeto'];
#orientador
$nome_orientador = $_POST['nome_orientador'];
$instituicao_orientador = $_POST['instituicao_orientador'];
$email_orientadorcol = $_POST['email_orientadorcol'];
$email_orientadorcol1 = $_POST['email_orientadorcol1'];
$fone_orientador = $_POST['fone_orientador'];

$updateOrientador = mysqli_query($conexao, "UPDATE orientadores_projeto SET nome_orientador = '$nome_orientador',instituicao_orientador = '$instituicao_orientador',email_orientadorcol = '$email_orientadorcol',email_orientadorcol1 = '$email_orientadorcol1',fone_orientador = '$fone_orientador' WHERE id = '$id_projeto'");