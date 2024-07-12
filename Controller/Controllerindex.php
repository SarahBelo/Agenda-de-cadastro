<?php

require_once('../Configuracao/Conexao.php');
require_once('../Model/ModelUsuario.php');

// entrada
$json = file_get_contents('php://input');
$reqbody = json_decode($json);
$login = $reqbody->usuario;
$senha = $reqbody->senha;

$conexao = new Conexao();
$banco = $conexao->abrirConexao();
$m = new ModelUsuario($banco);
$m->email = $login;
$m->senha = $senha;
$retorno = $m->logar();
// saida
echo json_encode($retorno);

?>