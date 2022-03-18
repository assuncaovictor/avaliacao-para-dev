<?php

namespace Assuncaovictor\Leilao\Controller\Operation;

use Assuncaovictor\Leilao\Controller\InterfaceControladorRequisicao;
use Assuncaovictor\Leilao\Helper\{FlashMessageTrait, RetornaInput, Sql};
use Assuncaovictor\Leilao\Infra\ConnectDatabase;
use Assuncaovictor\Leilao\Model\cliente;
use PDO;

class Excluir implements InterfaceControladorRequisicao
{
    use FlashMessageTrait;

    private PDO $pdo;

    /**
     * Cria uma conexão com o banco de danos MySQL
     */
    public function __construct()
    {
        $this->pdo = ConnectDatabase::createConnection();
    }

    /**
     * @method Faz a verificação dos inputs do usuário. Realiza a operação no banco de dados e retorna um feedback visual quando a alteração é realizada com sucesso ou se ela falhar
     */
    public function processaRequisicao(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (!$id) {
            $this->defineMensagem('erro', 'ID inválido!');
            header('location: /');
            return;
        }

        $sql = new Sql();
        $sucesso = $sql->excluir($id);

        if (!$sucesso) {
            $this->defineMensagem('erro', 'Ocorreu um erro ao excluir o cliente');
            header('location: /');
            return;
        }

        $this->defineMensagem('sucesso', 'Cliente Excluido com sucesso');
        header('location: /');
        return;
    }
}
