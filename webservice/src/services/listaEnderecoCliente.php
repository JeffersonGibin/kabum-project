<?php

if (!in_array($_SERVER["REQUEST_METHOD"], array("POST", "PUT", "GET"))) {
    $responseWS->addStatus("ERRO");
    $responseWS->getResponseCode(500);
    throw new Exception("Verbo HTTP não permitido");
}

if (empty($data["param"])) {
    $responseWS->addStatus("REQUIRED_VALUE");
    throw new Exception("O ID é obrigatório!");
}

$id = $data["param"];

$clienteEnderecoVO = new Lib\VO\ClienteEndereco();
$clienteEnderecoVO->setClienteid($id);

//DAO
$clienteEnderecoDAO = new \Lib\DAO\ClienteEnderecoDAO($connection);
$responseWS->addData(
        array(
            "enderecos" => $clienteEnderecoDAO->getAllEnderecoCliente($clienteEnderecoVO->getClienteid())
        )
);

$responseWS->getResponseCode(200);
