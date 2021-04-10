<?php
include ("config.php");
header("Access-Control-Allow-Origin: *");
$conexao = mysqli_connect(HOST_DB, LOGIN_DB, PASS_DB, NAME_DB) or die ("Error na conexão com o servidor! " . mysqli_connect_error());

if (count($_POST)) {
    if (isset($_POST["action"])&& $_POST["action"]== "delete"){
        $id = mysqli_real_escape_string($conexao, $_POST["id"]);
        $sql = "DELETE FROM contatos_agenda WHERE id = '{$id}'";
        
        mysqli_query($conexao, $sql) or die("Erro ao excluir o contato" . mysqli_error($conexao));
        echo "Contato excluído com sucesso!";
    }else {
        $nomeContato = mysqli_real_escape_string($conexao, $_POST["name"]);
        $sobrenomeContato = mysqli_real_escape_string($conexao, $_POST["sobrenome"]);
        $telefoneContato = mysqli_real_escape_string($conexao, $_POST["telefone"]);
        $emailContato = mysqli_real_escape_string($conexao, $_POST["email"]);
        $sql = "INSERT INTO contatos_agenda (
            nome,
            sobrenome,
            telefone,
            email)
            VALUES(
                '{$nomeContato}',
                '{$sobrenomeContato}',
                '{$telefoneContato}',
                '{$emailContato}'
            )
            ";
            mysqli_query($conexao, $sql) or die ("Erro ao inserir contato. ".mysqli_error($conexao));
    
            $id = mysqli_insert_id($conexao);
            echo ($id);
    }
    
    exit;
}
$sql = "SELECT * FROM contatos_agenda";
$resut = mysqli_query($conexao, $sql) or die("Erro ao executar a consulta!" . mysqli_error($conexao));
$arr=array();
while ($dados = mysqli_fetch_assoc($resut)) {
    $dados["name"]=$dados["nome"]; //Criando indice name esperando pelo front!  
    $arr[]=$dados;        
} 

echo $_GET['callback'] . "(" . json_encode($arr) . ");";
