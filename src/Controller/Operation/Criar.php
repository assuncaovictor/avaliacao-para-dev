<?php

namespace Assuncaovictor\Leilao\Controller\Operation;

use Assuncaovictor\Leilao\Controller\InterfaceControladorRequisicao;
use Assuncaovictor\Leilao\Helper\{FlashMessageTrait, RetornaInput, Sql};
use Assuncaovictor\Leilao\Infra\ConnectDatabase;
use Assuncaovictor\Leilao\Model\cliente;
use PDO;

class Criar implements InterfaceControladorRequisicao
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
     * @method faz a verificação dos inputs do usuário. Realiza a operação no banco de dados e retorna um feedback visual quando a alteração é realizada com sucesso ou se ela falhar
     */
    public function processaRequisicao(): void
    {
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
        $sucesso =  $sql->inserir($cliente);

        if (!$sucesso) {
            $this->defineMensagem('erro', 'Não foi possível adicionar o cliente');
            header('location: cadastro');
            return;
        }

        $this->defineMensagem('sucesso', 'Usuário cadastrado com sucesso');
        header('location: /');
        return;
    }
}
