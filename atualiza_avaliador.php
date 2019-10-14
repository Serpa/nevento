<?php

include 'db.php';
session_start();


$id_avaliador = $_POST['id_avaliador'];
$nome_avaliador = $_POST['nome_avaliador'];
$email_avaliador = $_POST['email_avaliador'];
$fone_avaliador = $_POST['fone_avaliador'];
$instituicao_avaliador = $_POST['instituicao_avaliador'];
$usuario_avaliador = $_POST['usuario_avaliador'];
$senha_avaliador = $_POST['senha_avaliador'];

$sql = $conexao->query("SELECT * FROM avaliadores WHERE usuario_avaliador ='$usuario_avaliador' AND id_avaliador !='$id_avaliador'");

if (mysqli_num_rows($sql) > 0) {
    echo "<script>alert('Usuário já cadastrado, por favor use outro usuário!');window.location='listar_avaliador.php'</script>";
    exit();
} else {
    mysqli_query($conexao, "UPDATE avaliadores SET nome_avaliador = '$nome_avaliador', email_avaliador = '$email_avaliador',fone_avaliador = '$fone_avaliador',instituicao_avaliador = '$instituicao_avaliador',usuario_avaliador = '$usuario_avaliador',senha_avaliador = '$senha_avaliador'  WHERE id_avaliador = '$id_avaliador'");
    echo "<script>alert('Cadastro atualizado com sucesso!');window.location='listar_avaliador.php'</script>";
}
$con->close();
