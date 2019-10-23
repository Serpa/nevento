<?php 

include 'db.php';
session_start();

$nome_avaliador = $_POST['nome_avaliador'];
$email_avaliador = $_POST['email_avaliador'];
$fone_avaliador = $_POST['fone_avaliador'];
$instituicao_avaliador = $_POST['instituicao_avaliador'];
$usuario_avaliador = $_POST['usuario_avaliador'];
$senha_avaliador = $_POST['senha_avaliador'];

$sql = $conexao->query("SELECT * FROM avaliadores WHERE usuario_avaliador ='$usuario_avaliador'");

if(mysqli_num_rows($sql) > 0){
	echo "<script>alert('Usuário já cadastrado, por favor use outro usuário!');window.location='cadastrar_avaliador.php'</script>";
exit();
} else {
    mysqli_query($conexao, "INSERT INTO avaliadores(nome_avaliador,email_avaliador,fone_avaliador,instituicao_avaliador,usuario_avaliador,senha_avaliador) VALUES('$nome_avaliador','$email_avaliador','$fone_avaliador','$instituicao_avaliador','$usuario_avaliador','$senha_avaliador')");
 echo "<script>alert('Cadastro realizado com sucesso!');window.location='cadastrar_avaliador.php'</script>";
}
$conexao->close();
?>