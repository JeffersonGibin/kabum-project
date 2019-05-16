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

$clienteVO = new Lib\VO\Cliente();
$clienteVO->setId($id);


//DAO
$clienteDAO = new \Lib\DAO\ClienteDAO($connection);
//
$clienteExiste = $clienteDAO->getById($clienteVO->getId(), array("id"));

if (!empty($clienteExiste["id"])) {
    $clienteDAO->removeCliente($clienteVO->getId());
} else {
    $responseWS->addStatus("NOT_FOUND");
    throw new Exception("Cliente não encontrado");
}
$responseWS->getResponseCode(200);
