<?php

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    $responseWS->addStatus("ERRO");
    $responseWS->getResponseCode(500);
    throw new Exception("Verbo HTTP não permitido");
}

$body = $service->getBody();

if (!isset($body["clienteid"])) {
    $responseWS->getResponseCode(401);
    $responseWS->addStatus("REQUIRED_VALUE");
    throw new Exception("Informe o id do cliente!");
}

if (!isset($body["endereco"])) {
    $responseWS->getResponseCode(401);
    $responseWS->addStatus("REQUIRED_VALUE");
    throw new Exception("Endereco é obrigatório!");
}

if (!isset($body["numero"])) {
    $responseWS->getResponseCode(401);
    $responseWS->addStatus("REQUIRED_VALUE");
    throw new Exception("Número é obrigatório!");
}

if (!isset($body["bairro"])) {
    $responseWS->getResponseCode(401);
    $responseWS->addStatus("REQUIRED_VALUE");
    throw new Exception("Bairro é obrigatório!");
}

if (!isset($body["cep"])) {
    $responseWS->getResponseCode(401);
    $responseWS->addStatus("REQUIRED_VALUE");
    throw new Exception("Cep é obrigatório!");
}

$endereco = isset($body["endereco"]) ? $body["endereco"] : "";
$numero = isset($body["numero"]) ? $body["numero"] : "";
$cep = isset($body["cep"]) ? $body["cep"] : "";
$bairro = isset($body["bairro"]) ? $body["bairro"] : "";
$clienteid = isset($body["clienteid"]) ? $body["clienteid"] : "";
$estadoid = isset($body["estadoid"]) ? $body["estadoid"] : "";
$cidadeid = isset($body["cidadeid"]) ? $body["cidadeid"] : "";

$clienteEnderecoVO = new Lib\VO\ClienteEndereco();

$clienteEnderecoVO->setClienteID($clienteid);
$clienteEnderecoVO->setEndereco($endereco);
$clienteEnderecoVO->setNumero($numero);
$clienteEnderecoVO->setCep($cep);
$clienteEnderecoVO->setBairro($bairro);
$clienteEnderecoVO->setEstadoID($estadoid);
$clienteEnderecoVO->setCidadeID($cidadeid);
$clienteEnderecoVO->setClienteID($clienteid);


//DAO Cliente
$clienteDAO = new \Lib\DAO\ClienteDAO($connection);
$clientesExistentes = $clienteDAO->getById($clienteEnderecoVO->getClienteID(), array("nome"));

if (empty($clientesExistentes)) {
    throw new Exception("O id do cliente é inválido!");
}

//DAO Endereço
$clienteEnderecoDAO = new \Lib\DAO\ClienteEnderecoDAO($connection);
$id = $clienteEnderecoDAO->cadEndereco($clienteEnderecoVO);

if (!empty($id)) {
    $responseWS->addData(array("id" => $id), "data");
}

$responseWS->getResponseCode(200);
