<?php

if (!in_array($_SERVER["REQUEST_METHOD"], array("POST", "PUT", "GET"))) {
    $responseWS->addStatus("ERRO");
    $responseWS->getResponseCode(500);
    throw new Exception("Verbo HTTP não permitido");
}

$usuarioDAO = new \Lib\DAO\UsuarioDAO($connection);
$usuarioid = isset($data["param"]) ? $data["param"] : null;

$clienteVO = new Lib\VO\Cliente();
$clienteVO->setUsuarioid($usuarioid);
//verifico se o usuarioid foi informado
if (!isset($usuarioid) || empty($usuarioid)) {
    $responseWS->addStatus("ERRO");
    $responseWS->getResponseCode(500);
    throw new Exception("Você não está logado no sistema!");
}

$usuarioExiste = $usuarioDAO->getById($usuarioid, array("id"));

//verifico se o usuário existe
if (empty($usuarioExiste["id"])) {
    $responseWS->addStatus("ERRO");
    $responseWS->getResponseCode(500);
    throw new Exception("Usuário inválido!");
}

//DAO
$clienteDAO = new \Lib\DAO\ClienteDAO($connection);

$responseWS->addData(array("clientes" => $clienteDAO->listAll($clienteVO->getUsuarioid())));
$responseWS->getResponseCode(200);
