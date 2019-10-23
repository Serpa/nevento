<?php 

include 'db.php';
session_start();

$nome_coautor = $_POST['nome_coautor'];
$projeto = $_POST['projeto'];

$sql = $conexao->query("SELECT * FROM coautores_projeto WHERE nome_coautor ='$nome_coautor'");

if(mysqli_num_rows($sql) > 0){
	echo "<script>alert('Coautor já cadastrado, por favor cadastre outro coautor!');window.location='listar_coautor.php'</script>";
exit();
} else {
    mysqli_query($conexao, "INSERT INTO coautores_projeto(nome_coautor) VALUES('$nome_coautor')");
    $lastidCoautor = mysqli_insert_id($conexao);
    mysqli_query($conexao,"INSERT INTO projeto_coautores(id_projeto, id_coautores) VALUES ('$projeto ', '$lastidCoautor')");
 echo "<script>alert('Cadastro realizado com sucesso!');window.location='listar_coautor.php'</script>";
}
$conexao->close();
?>