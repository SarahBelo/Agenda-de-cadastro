<?php

require_once('../../Configuracao/Conexao.php');
require_once('../../Model/UsuarioModel.php');

$json = file_get_contents('php://input');
$reqbody = json_decode($json);
$id = $reqbody->textID;

$conexao = new Conexao();
$db = $conexao->abrirConexao();
$m = new UsuarioModel($db);
$m->textID = $id;
$retorno = $m->deletarUsuarios();

echo json_encode($retorno);
?>