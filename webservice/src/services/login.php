<?php
$body = $service->getBody();

if(empty($body) && (empty($body["login"]) || empty($body["senha"]))) {
    $responseWS->addStatus("REQUIRED_VALUE");
    $responseWS->getResponseCode(401);
    throw new Exception("Login e senha são obrigatório!");
}

$usuarioVO =  new Lib\VO\Usuario();
$usuarioVO->setLogin($body["login"]);
$usuarioVO->setSenha($body["senha"]);

$login = $usuarioVO->getLogin();
$senha = $usuarioVO->getSenha();

//Token
$tokenUser = new Lib\Webservice\Token(array($login, time()));

//DAO
$usuarioDAO =  new \Lib\DAO\UsuarioDAO($connection);

$sessionToken = array();
if ($usuarioDAO->authenticate($login, $senha)) {
    $sessionToken = $tokenUser->generateToken();
    $responseWS->getResponseCode(200);
    $responseWS->addData(
        array(
            "token" => $sessionToken,
            "sessionData" => $usuarioDAO->getDataSession()
        )
    );
} else {
    $responseWS->addResponseMessage("Usuário ou senha inválidos!");
    $responseWS->getResponseCode(200);
    
}




