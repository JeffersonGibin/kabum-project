<?php
$info = array(
    "nome" => "Webservice Kabum",
    "vercao" => " V1.0",
);
echo json_encode(str_replace('"', '', $info));