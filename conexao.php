<?php
//Variáveis de acesso ao banco de dados
define('DB_SERVER','localhost');
define('DB_NAME','biblioteca');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');

//inicio da classe de conexao
class Conexao{
	var $db, $conn;

	public function __construct($server, $database, $username, $password){
		$this->conn = mysqli_connect($server, $username, $password, $database);
		//$this->db = mysql_select_db($database, $this->conn);
	}

	//Função para inserir dados na tabela 
	//@param array $dados - Array contendo os dados a serem inseridos
	//@param string $tabela - Tabela que será inserida os dados

	public function insert($tabela, $dados) {
		//$key = colunas
		//$value = valores das colunas
		foreach ($dados as $key => $value) {
			$keys[] = $key;
			$insertvalues[] = '\'' . $value . '\'';
		}
		//junta os elementos da matriz $keys[] em uma única string, separando-os por vírgula
		$keys = implode(',', $keys);
		//junta os elementos da matriz $insertvalues[] em uma única string, separando-os por vírgula
		$insertvalues = implode(',', $insertvalues);
		$sql = "INSERT INTO $tabela ($keys) VALUES ($insertvalues)";
		return mysqli_query(($this->conn),$sql);
	}

	//Função para alterar os dados da tabela
	//@param string $tabela - Tabela onde os dados serão alterados
	//@param string $colunaPrimary - Nome da coluna que contem a chave primária
	//@param int $id - ID do dado a ser alterado
	//@param array $dados - Dados que serão inseridos
	//@return boolean verdadeiro ou falso
	public function update($tabela, $colunaPrimary, $id, $dados){
		foreach ($dados as $key => $value) {
			$sets[] = $key . '=\'' . $value . '\'';
		}
		$sets = implode(',', $sets);
		$sql = "UPDATE $tabela SET $sets WHERE $colunaPrimary = '$id'";
		return mysqli_query(($this->conn), $sql);
	}

	//Função de seleção dos registros da tabela
	//@param string $tabela Description
	//@param string $colunas - String contendo as colunas separadas por vírgula para seleção. Se null, busca por todas *
	public function select($tabela, $coluna = "*"){
		$sql = "SELECT $coluna FROM $tabela";
		$result = mysqli_query(($this->conn),$sql);
		//if (! $result){
		//	throw new My_Db_Exception('Database error: ' . mysql_error());
		//}
		while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
			$return[] = $row;
		}
		return $return;
	} 
}
?>