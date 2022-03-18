<?php

namespace Assuncaovictor\Leilao\Controller\Redirect;

use Assuncaovictor\Leilao\Controller\InterfaceControladorRequisicao;
use Assuncaovictor\Leilao\Helper\RenderizaHtml;
use Assuncaovictor\Leilao\Helper\Sql;

class PaginaInicial implements InterfaceControladorRequisicao
{
    use RenderizaHtml;

    public function processaRequisicao(): void
    {
        $sql = new Sql();
        $dados = $sql->vizualizar($_GET['pag'] ? $_GET['pag'] : 0);
        echo $this->renderizaHtml('inicial.php', [
            'titulo' => 'Clientes cadastrados',
            'dados' => $dados
        ]);

        session_unset();
    }
}
