<?php

include 'db.php';
session_start();


$apresentador_projeto = $_POST['apresentador_projeto'];
$id_projeto = $_POST['id_projeto'];

    mysqli_query($conexao, "UPDATE projetos SET apresentador_projeto = '$apresentador_projeto' WHERE id = '$id_projeto'");
    echo "<script>alert('Apresentador atualizado com sucesso!');window.location='lista_projetos.php'</script>";
