<?php
if ($_SERVER["REQUEST_METHOD"] != "GET") {
    $responseWS->addStatus("ERRO");
    $responseWS->getResponseCode(500);
    throw new Exception("Verbo HTTP não permitido");
}

$estadoDAO = new \Lib\DAO\EstadoDAO($connection);


$responseWS->addData(
    array(
        "estados" => $estadoDAO->listAll()
    )
);

$responseWS->getResponseCode(200);