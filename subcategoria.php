<?php include_once("db.php");

	$id_categoria = $_REQUEST['areas_projeto_id'];
	
	$result_sub_cat = "SELECT * FROM subareas_projeto WHERE areas_projeto_id=$id_categoria ORDER BY nome_subarea";
	$resultado_sub_cat = mysqli_query($conexao, $result_sub_cat);
	
	while ($row_sub_cat = mysqli_fetch_assoc($resultado_sub_cat) ) {
		$sub_categorias_post[] = array(
			'id'	=> $row_sub_cat['id'],
			'nome_subarea' => utf8_encode($row_sub_cat['nome_subarea']),
		);
	}
	
	echo(json_encode($sub_categorias_post));
