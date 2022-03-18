<?php

namespace Assuncaovictor\Leilao\Controller\Redirect;

use Assuncaovictor\Leilao\Controller\InterfaceControladorRequisicao;
use Assuncaovictor\Leilao\Helper\RenderizaHtml;

class Cadastro implements InterfaceControladorRequisicao
{
    use RenderizaHtml;

    public function processaRequisicao(): void
    {
        echo $this->renderizaHtml('cadastro.php', ['titulo' => 'Cadastro']);

        session_unset();
    }
}
