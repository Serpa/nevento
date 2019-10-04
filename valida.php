<?php
include_once "db.php";

session_start();
$usuario_pesq = ($_POST['usuario_pesq']);

$senha_pesq = ($_POST['senha_pesq']);


$resultado = mysqli_query($conexao,"SELECT * FROM usuarios_pesq WHERE usuario_pesq = '$usuario_pesq' and senha_pesq = '$senha_pesq' ");

$result = mysqli_fetch_array($resultado);

$user = $result['usuario_pesq'];
$senha_db = $result['senha_pesq'];

if ($usuario_pesq == $user  && $senha_pesq == $senha_db) {
	$_SESSION['login'] = true;
	$_SESSION['usuario_pesq'] = $usuario_pesq;
	$_SESSION['usuario_pesq_id'] = $result['id_pesq'];

	header('location: index.php');
} else {
	header('location: login.php');
}
echo $_SESSION['usuario_pesq'];
echo $_SESSION['usuario_pesq_id'];