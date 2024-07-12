<?php

require_once ('../Configuracao/Conexao.php');
require_once ('../Model/ModelUsuario.php');

$json = file_get_contents('php://input');
$reqbody = json_decode($json);
$nome = $reqbody->nome;
$dataNasc = $reqbody->dataNasc;
$email = $reqbody->email;
$telefone = $reqbody->telefone;
$senha = $reqbody->senha;

$conexao = new Conexao();
$banco = $conexao ->abrirConexao();
$m = new ModelUsuario($banco);
$m->nome = $nome;
$m->dataNasc = $dataNasc;
$m->email = $email;
$m->telefone = $telefone;
$m->senha = $senha;
$retorno = $m->cadastro();

echo json_encode($retorno);
?>