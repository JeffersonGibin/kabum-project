<?php

if (!in_array($_SERVER["REQUEST_METHOD"], array("PUT", "DELETE"))) {
    $responseWS->addStatus("ERRO");
    $responseWS->getResponseCode(500);
    throw new Exception("Verbo HTTP não permitido");
}

if (empty($data["param"])) {
    $responseWS->addStatus("REQUIRED_VALUE");
    throw new Exception("O ID é obrigatório!");
}

$clienteEnderecoVO = new Lib\VO\ClienteEndereco();
$clienteEnderecoVO->setId($id);


//DAO
$clienteEnderecoDAO = new \Lib\DAO\ClienteEnderecoDAO($connection);
//
$enderecoExiste = $clienteEnderecoDAO->getById($clienteEnderecoVO->getId(), array("id"));

if (!empty($enderecoExiste["id"])) {
    $clienteEnderecoDAO->removeEndereco($clienteEnderecoVO->getId());
} else {
    $responseWS->addStatus("NOT_FOUND");
    throw new Exception("Endereço não encontrado");
}
$responseWS->getResponseCode(200);
