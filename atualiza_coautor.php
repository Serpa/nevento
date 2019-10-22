<?php

include 'db.php';
session_start();


$id_coautor = $_POST['id_coautor'];
$nome_coautor = $_POST['nome_coautor'];

    mysqli_query($conexao, "UPDATE coautores_projeto SET nome_coautor = '$nome_coautor' WHERE id = '$id_coautor'");
    echo "<script>alert('Coautor atualizado com sucesso!');window.location='listar_coautor.php'</script>";
