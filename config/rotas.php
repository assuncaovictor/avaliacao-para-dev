<?php

use Assuncaovictor\Leilao\Controller\Redirect\{Cadastro, Editar, PaginaInicial,  Vizualizar};
use Assuncaovictor\Leilao\Controller\Operation\{Alterar, Criar, Excluir};

require __DIR__ . '/../vendor/autoload.php';

return [
    '' => PaginaInicial::class,
    '/cadastro' => Cadastro::class,
    '/cadastrar' => Criar::class,
    '/editar' => Editar::class,
    '/alterar' => Alterar::class,
    '/excluir' => Excluir::class,
    '/vizualizar' => Vizualizar::class
];
