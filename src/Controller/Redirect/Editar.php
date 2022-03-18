<?php

namespace Assuncaovictor\Leilao\Controller\Redirect;

use Assuncaovictor\Leilao\Controller\InterfaceControladorRequisicao;
use Assuncaovictor\Leilao\Helper\FlashMessageTrait;
use Assuncaovictor\Leilao\Helper\RenderizaHtml;
use Assuncaovictor\Leilao\Helper\Sql;

class Editar implements InterfaceControladorRequisicao
{
    use RenderizaHtml;
    use FlashMessageTrait;

    public function processaRequisicao(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (!$id) {
            $this->defineMensagem('erro', 'Usuário não cadastrado');
            header('location: /');
            return;
        }

        $sql = new Sql();
        $cliente = $sql->cliente($id);

        echo $this->renderizaHtml('cadastro.php', ['titulo' => 'Editar', 'cliente' => $cliente]);

        session_unset();
    }
}
