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

$endereco = isset($body["endereco"]) ? $body["endereco"] : "";
$numero = isset($body["numero"]) ? $body["numero"] : "";
$cep = isset($body["cep"]) ? $body["cep"] : "";
$bairro = isset($body["bairro"]) ? $body["bairro"] : "";
$estadoid = isset($body["estadoid"]) ? $body["estadoid"] : "";
$cidadeid = isset($body["cidadeid"]) ? $body["cidadeid"] : "";

//VO
$clienteEnderecoVO = new Lib\VO\ClienteEndereco();
$clienteEnderecoVO->setId($data["param"]);
$clienteEnderecoVO->setEndereco($endereco);
$clienteEnderecoVO->setNumero($numero);
$clienteEnderecoVO->setCep($cep);
$clienteEnderecoVO->setBairro($bairro);
$clienteEnderecoVO->setEstadoID($estadoid);
$clienteEnderecoVO->setCidadeID($cidadeid);

//DAO
$clienteEnderecoDAO = new \Lib\DAO\ClienteEnderecoDAO($connection);
$clienteEnderecoExistente = $clienteEnderecoDAO->getById($clienteEnderecoVO->getId(), array("id, endereco"));

//verifico se o id informado na rota existe é de um cliente existente
if (empty($clienteEnderecoExistente["id"])) {
    $responseWS->addStatus("USER_NOT_EXISTS");
    throw new Exception("O endereço que você está tentando editar não existe ! ");
}

$clienteEnderecoDAO->editarEndereco($clienteEnderecoVO);
$responseWS->addData(array("id" => $clienteEnderecoVO->getId()), "data");

$responseWS->getResponseCode(200);
