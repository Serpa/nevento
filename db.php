<?php

$servidor = "localhost";
$usuario = "root";
$senha = "";
$db = "avalia_app";

$conexao = mysqli_connect($servidor, $usuario, $senha, $db);


$query = "SELECT * FROM projetos";
$consulta_projetos = mysqli_query($conexao,$query);
$query = "SELECT * FROM areas_projeto";
$consulta = mysqli_query($conexao,$query);
$query = "SELECT * FROM avaliacoes";
$consulta = mysqli_query($conexao,$query);
$query = "SELECT * FROM avaliadores";
$consulta = mysqli_query($conexao,$query);
$query = "SELECT * FROM categorias_projetos";
$consulta_cat_projetos = mysqli_query($conexao,$query);
$query = "SELECT * FROM coautores_projeto";
$consulta = mysqli_query($conexao,$query);
$query = "SELECT * FROM orientadores_projeto";
$consulta = mysqli_query($conexao,$query);
$query = "SELECT * FROM projeto_coautores";
$consulta = mysqli_query($conexao,$query);
$query = "SELECT * FROM subareas_projeto";
$consulta = mysqli_query($conexao,$query);
$query = "SELECT * FROM usuarios_pesq";
$consulta = mysqli_query($conexao,$query);