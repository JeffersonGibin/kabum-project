<?php

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    $responseWS->addStatus("ERRO");
    $responseWS->getResponseCode(500);
    throw new Exception("Verbo HTTP não permitido");
}

$body = $service->getBody();
$usuarioDAO = new \Lib\DAO\UsuarioDAO($connection);

//verifico se o usuarioid foi informado
if (!isset($body["usuarioid"]) || empty($body["usuarioid"])) {
    $responseWS->addStatus("ERRO");
    $responseWS->getResponseCode(500);
    throw new Exception("Você não está logado no sistema!");
}

$usuarioid = isset($body["usuarioid"]) ? $body["usuarioid"] : null;
$nome = isset($body["nome"]) ? $body["nome"] : null;
$dataNascimento = isset($body["datanascimento"]) ? $body["datanascimento"] : null;
$telefone = isset($body["telefone"]) ? $body["telefone"] : null;
$celular = isset($body["celular"]) ? $body["celular"] : null;
$rg = isset($body["rg"]) ? $body["rg"] : null;
$cpf = isset($body["cpf"]) ? $body["cpf"] : null;

$usuarioExiste = $usuarioDAO->getById($usuarioid, array("id"));

//verifico se o usuário existe
if (empty($usuarioExiste["id"])) {
    $responseWS->addStatus("ERRO");
    $responseWS->getResponseCode(500);
    throw new Exception("Usuário inválido!");
}

if (!isset($body["nome"])) {
    $responseWS->getResponseCode(401);
    $responseWS->addStatus("REQUIRED_VALUE");
    throw new Exception("Nome é obrigatório!");
}

//VO
$clienteVO = new Lib\VO\Cliente();
$clienteVO->setNome($nome);
$clienteVO->setDatanascimento($dataNascimento);
$clienteVO->setTelefone($telefone);
$clienteVO->setCelular($celular);
$clienteVO->setCpf($cpf);
$clienteVO->setRg($rg);
$clienteVO->setUsuarioid($usuarioid);

//DAO
$clienteDAO = new \Lib\DAO\ClienteDAO($connection);
$clientesExistentes = $clienteDAO->findByName($clienteVO->getNome(), array("nome"));

if (!empty($clientesExistentes)) {
    $responseWS->addStatus("CLIENTE_EXISTS");
    throw new Exception("O cliente já está cadastrado! ");
}

$id = $clienteDAO->cadCliente($clienteVO);

if (!empty($id)) {
    $responseWS->addData(array("id" => $id), "data");
    $responseWS->getResponseCode(200);
} else {
    $responseWS->addStatus("ERRO");
    $responseWS->getResponseCode(500);
    throw new Exception("Erro ao cadastrar cliente!");
}
