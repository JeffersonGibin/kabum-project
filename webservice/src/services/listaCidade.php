<?php
if ($_SERVER["REQUEST_METHOD"] != "GET") {
    $responseWS->addStatus("ERRO");
    $responseWS->getResponseCode(500);
    throw new Exception("Verbo HTTP não permitido");
}

if (empty($data["param"])) {
    $responseWS->addStatus("REQUIRED_VALUE");
    throw new Exception("O ID é obrigatório!");
}

$cidadeDAO = new \Lib\DAO\CidadeDAO($connection);

$responseWS->addData(
    array(
        "cidades" => $cidadeDAO->listAll($data["param"])
    )
);

$responseWS->getResponseCode(200);