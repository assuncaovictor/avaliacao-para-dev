<?php

/**
 * Recebe a URL do usuário e verifica se essa URL existe a arquivo de rotas, 
 * se não exisitir retorna um erro 404, se existir, inicia uma sessão e faz o processamento de uma requisição
 */

require __DIR__ . '/../vendor/autoload.php';

$caminho = strtolower($_SERVER['PATH_INFO']);
$rotas = require __DIR__ . '/../config/rotas.php';

if (!array_key_exists($caminho, $rotas)) {
    http_response_code(404);
}

session_start();

$classeControladora = $rotas[$caminho];
$controlador = new $classeControladora();
$controlador->processaRequisicao();
