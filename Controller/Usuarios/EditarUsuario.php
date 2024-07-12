<?php

require_once('../../Configuracao/Conexao.php');
require_once('../../Model/UsuarioModel.php');

$json = file_get_contents('php://input');
$reqbody = json_decode($json);
$nome = $reqbody->nome;
$dataNasc = $reqbody->dataNasc;
$email = $reqbody->email;
$telefone = $reqbody->telefone;
$id = $reqbody->id;

$conexao = new Conexao();
$banco = $conexao->abrirConexao();
$m = new UsuarioModel($banco);
$m->nome = $nome;
$m->dataNasc = $dataNasc;
$m->email = $email;
$m->telefone = $telefone;
$m->id = $id;
$retorno = $m->editarUsuarios();

echo json_encode($retorno);
?>