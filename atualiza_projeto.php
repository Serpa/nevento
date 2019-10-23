<?php 

include 'db.php';
session_start();
mysqli_query($conexao, "SET NAMES utf8");


#orientador
$id_orientador = $_POST['id_orientador'];
$nome_orientador = $_POST['nome_orientador'];
$instituicao_orientador = $_POST['instituicao_orientador'];
$email_orientadorcol = $_POST['email_orientadorcol'];
$email_orientadorcol1 = $_POST['email_orientadorcol1'];
$fone_orientador = $_POST['fone_orientador'];

$updateOrientador = mysqli_query($conexao, "UPDATE orientadores_projeto SET nome_orientador = '$nome_orientador',instituicao_orientador = '$instituicao_orientador',email_orientadorcol = '$email_orientadorcol',email_orientadorcol1 = '$email_orientadorcol1',fone_orientador = '$fone_orientador' WHERE id = '$id_orientador'");

#projeto
$id_projeto = $_POST['id_projeto'];
$nome_projeto = $_POST['nome_projeto'];
$titulo_projeto = $_POST['titulo_projeto'];
$autor_projeto = $_POST['autor_projeto'];
$endereco_autor = $_POST['endereco_autor'];
$cidade_autor = $_POST['cidade_autor'];
$email_autor = $_POST['email_autor'];
$fone_autor = $_POST['fone_autor'];
$instituicao_autor = $_POST['instituicao_autor'];
$palavraschave_projeto = $_POST['palavraschave_projeto'];
$categorias_projetos_id = $_POST['categorias_projetos_id'];
$areas_projeto_id = $_POST['areas_projeto_id'];
$id_sub_categoria = $_POST['id_sub_categoria'];
$usuarios_pesq_id_pesq = $_SESSION['usuario_pesq_id'];
$apresentador_projeto = $_POST['apresentador_projeto'];

$updateProjetos = mysqli_query($conexao, "UPDATE projetos SET
nome_projeto = '$nome_projeto',
titulo_projeto = '$titulo_projeto',
autor_projeto = '$autor_projeto',
endereco_autor = '$endereco_autor',
cidade_autor = '$cidade_autor',
email_autor = '$email_autor',
fone_autor = '$fone_autor',
instituicao_autor = '$instituicao_autor',
apresentador_projeto = '$apresentador_projeto',
palavraschave_projeto = '$palavraschave_projeto',
categorias_projetos_id = $categorias_projetos_id,
orientadores_projeto_id = $id_orientador,
usuarios_pesq_id_pesq = $usuarios_pesq_id_pesq,
areas_projeto_id = $areas_projeto_id,
subarea_projeto_id = $id_sub_categoria
WHERE id =$id_projeto");

echo "<script>alert('Projeto atualizado com sucesso!');window.location='lista_projetos.php'</script>";