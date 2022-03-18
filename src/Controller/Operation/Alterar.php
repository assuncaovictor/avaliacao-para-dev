<?php

namespace Assuncaovictor\Leilao\Controller\Operation;

use Assuncaovictor\Leilao\Controller\InterfaceControladorRequisicao;
use Assuncaovictor\Leilao\Helper\{FlashMessageTrait, RetornaInput, Sql};
use Assuncaovictor\Leilao\Infra\ConnectDatabase;
use Assuncaovictor\Leilao\Model\cliente;
use PDO;

class Alterar implements InterfaceControladorRequisicao
{
    use FlashMessageTrait;

    private PDO $pdo;

    /**
     * Cria uma conexão com o banco de dados MySQL
     */
    public function __construct()
    {
        $this->pdo = ConnectDatabase::createConnection();
    }

    /**
     * @method faz a verificação dos inputs do usuário. Realiza a opreção no banco de dados e retorna um feedback visual quando a alteração é realizada com sucesso ou se ela falhar.
     */
    public function processaRequisicao(): void
    {
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        if (!$id) {
            $this->defineMensagem('erro', 'ID inválido!');
            header('location: /');
            return;
        }
        $cliente = new cliente();

        $cliente->setNome($_POST['nome']);
        $cliente->setEmail($_POST['email']);
        $cliente->setTelefone($_POST['telefone']);
        $cliente->setData($_POST['data']);

        if (!$cliente->getStatus()) {
            $this->defineMensagem('erro', 'Preencha os campos corretamente');
            header('location: /cadastro');
            return;
        }

        $sql = new Sql();
        $sucesso = $sql->editar($cliente, $id);

        if (!$sucesso) {
            $this->defineMensagem('erro', 'Ocorreu um erro ao alterar os valores');
            header('location: /');
            return;
        }

        $this->defineMensagem('sucesso', 'Usuário Alterado com sucesso');
        header('location: /');
        return;
    }
}
