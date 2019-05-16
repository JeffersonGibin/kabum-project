<?php

if ($_SERVER["REQUEST_METHOD"] != "PUT") {
    $responseWS->addStatus("ERRO");
    $responseWS->getResponseCode(500);
    throw new Exception("Verbo HTTP não permitido");
}

$body = $service->getBody();

if (empty($data["param"])) {
    $responseWS->addStatus("REQUIRED_VALUE");
    throw new Exception("O ID é obrigatório!");
}

$id = isset($data["param"]) ? $data["param"] : "";
$nome = isset($body["nome"]) ? $body["nome"] : "";
$dataNascimento = isset($body["datanascimento"]) ? $body["datanascimento"] : null;
$telefone = isset($body["telefone"]) ? $body["telefone"] : "";
$celular = isset($body["celular"]) ? $body["celular"] : "";
$rg = isset($body["rg"]) ? $body["rg"] : "";
$cpf = isset($body["cpf"]) ? $body["cpf"] : "";

//VO
$clienteVO = new Lib\VO\Cliente();
$clienteVO->setId($id);
$clienteVO->setNome($nome);
$clienteVO->setDatanascimento($dataNascimento);
$clienteVO->setTelefone($telefone);
$clienteVO->setCelular($celular);
$clienteVO->setRg($rg);
$clienteVO->setCpf($cpf);
//
//DAO
$clienteDAO = new \Lib\DAO\ClienteDAO($connection);
$clientesExistente = $clienteDAO->getById($clienteVO->getId(), array("id, nome"));


//verifico se o id informado na rota existe é de um cliente existente
if (empty($clientesExistente["id"])) {
    $responseWS->addStatus("USER_NOT_EXISTS");
    throw new Exception("O usuário que você está tentando editar não existe ! ");
}

// se existir um cliente e o nome for igual ao nome setado na rota eu seto nome para vazio para nao cadastrar de novo.
if (isset($clientesExistente["nome"]) && $clientesExistente["nome"] == $clienteVO->getNome()) {
    $clienteVO->setNome("");
}


if($clienteDAO->editarCliente($clienteVO)){
    $responseWS->getResponseCode(200);
}


