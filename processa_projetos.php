<?php 

include 'db.php';
session_start();
mysqli_query($conexao, "SET NAMES utf8");

#orientador
$nome_orientador = $_POST['nome_orientador'];
$instituicao_orientador = $_POST['instituicao_orientador'];
$email_orientadorcol = $_POST['email_orientadorcol'];
$email_orientadorcol1 = $_POST['email_orientadorcol1'];
$fone_orientador = $_POST['fone_orientador'];

$insertOrientador = mysqli_query($conexao, "INSERT INTO orientadores_projeto(nome_orientador,instituicao_orientador,email_orientadorcol,email_orientadorcol1,fone_orientador) VALUES('$nome_orientador','$instituicao_orientador','$email_orientadorcol','$email_orientadorcol1','$fone_orientador')");

$lastidOrientador = mysqli_insert_id($conexao);


#projeto
$nome_projeto = $_POST['nome_projeto'];
$titulo_projeto = $_POST['titulo_projeto'];
$autor_projeto = $_POST['autor_projeto'];
$endereco_autor = $_POST['endereco_autor'];
$estado_autor = $_POST['estado_autor'];
$city = $_POST['cidade_autor'];
$cidade_autor = $city.'-'.$estado_autor;
$email_autor = $_POST['email_autor'];
$fone_autor = $_POST['fone_autor'];
$instituicao_autor = $_POST['instituicao_autor'];
$palavraschave_projeto = $_POST['palavraschave_projeto'];
$categorias_projetos_id = $_POST['categorias_projetos_id'];
$areas_projeto_id = $_POST['areas_projeto_id'];
$id_sub_categoria = $_POST['id_sub_categoria'];
$usuarios_pesq_id_pesq = $_SESSION['usuario_pesq_id'];

$insertProjetos = mysqli_query($conexao, "INSERT INTO projetos
(nome_projeto,
titulo_projeto,
autor_projeto,
endereco_autor,
cidade_autor,
email_autor,
fone_autor,
instituicao_autor,
apresentador_projeto,
palavraschave_projeto,
categorias_projetos_id,
orientadores_projeto_id,
usuarios_pesq_id_pesq,
areas_projeto_id,
subarea_projeto_id)
VALUES
('$nome_projeto','$titulo_projeto','$autor_projeto','$endereco_autor','$cidade_autor','$email_autor','$fone_autor','$instituicao_autor',0,'$palavraschave_projeto',$categorias_projetos_id,$lastidOrientador,$usuarios_pesq_id_pesq,$areas_projeto_id,$id_sub_categoria)");

$lastidProjeto = mysqli_insert_id($conexao);

#coautor
$nome_coautor = $_POST['Coautor'];

$apresentador_projeto = $_POST['apresentador_projeto'];
foreach ($nome_coautor as $key => $value) {
	mysqli_query($conexao,"INSERT INTO coautores_projeto(nome_coautor) VALUES('$value')");

	$lastidCoautor = mysqli_insert_id($conexao);

	if($key+1==$apresentador_projeto){
		mysqli_query($conexao,"UPDATE projetos SET apresentador_projeto = '$lastidCoautor' WHERE id = '$lastidProjeto'");
	}

	mysqli_query($conexao,"INSERT INTO projeto_coautores(id_projeto, id_coautores) VALUES ('$lastidProjeto', '$lastidCoautor')");
}
echo "<script>alert('Cadastro realizado com sucesso!');window.location='cadastrar_projetos.php'</script>";

