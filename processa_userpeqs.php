<?php 

include 'db.php';
session_start();

$usuario_pesq = $_POST['usuario_pesq'];
$senha_pesq = $_POST['senha_pesq'];
$nivel_pesq = 1;

$sql = $conexao->query("SELECT * FROM usuarios_pesq WHERE usuario_pesq ='$usuario_pesq'");

if(mysqli_num_rows($sql) > 0){
	echo "<script>alert('Usuário já cadastrado, por favor use outro usuário!');window.location='cadastrar_pesquisa.php'</script>";
exit();
} else {
    mysqli_query($conexao, "INSERT INTO usuarios_pesq(usuario_pesq,senha_pesq,nivel_pesq) VALUES('$usuario_pesq','$senha_pesq','$nivel_pesq')");
 echo "<script>alert('Cadastro realizado com sucesso!');window.location='cadastrar_pesquisa.php'</script>";
}
$conexao->close();
?>