<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="txt/html"; charset="utf-8">
	<title></title>
</head>
<body>
	<?php
		require_once 'conexao.php';
		$conexao = new Conexao(DB_SERVER, DB_NAME, DB_USERNAME, DB_PASSWORD);
		$dados = array('cod_livro' => 01 , 'nome_livro' => 'livro exemplo 01', 'desc_livro' => 'Livro de exemplo');
		$insert = $conexao->insert('livro',$dados);
		if($insert == true){
			echo 'inserido';
		}
	?>
</body>
</html>