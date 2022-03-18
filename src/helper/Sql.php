<?php

namespace Assuncaovictor\Leilao\Helper;

use PDO;
use Assuncaovictor\Leilao\Infra\ConnectDatabase;
use Assuncaovictor\Leilao\Helper\FlashMessageTrait;
use Assuncaovictor\Leilao\Model\Cliente;

/**
 * Classe responsável por realizar todas as operações no MySQL, seguindo os padrões SOLID
 */
class Sql
{
    private PDO $conn;
    use FlashMessageTrait;

    /**
     * Faz a conexão com o banco de dados MySQL
     */
    public function __construct()
    {
        $this->conn = ConnectDatabase::createConnection();
    }

    /**
     * @method responsável por inserir dados na tabela cliente
     * @param Cliente $cliente recebe um cliente com seus dados preenchidos
     * @return bool retorna se a operação foi ou não realizada com sucesso
     */
    public function inserir(Cliente $cliente): bool
    {
        $query = $this->conn->prepare(
            'INSERT INTO clientes (nome, email, telefone, data) VALUES (?, ?, ?, ?);'
        );

        $query->bindParam(1, $cliente->getNome());
        $query->bindParam(2, $cliente->getEmail());
        $query->bindParam(3, $cliente->getTelefone());
        $query->bindParam(4, $cliente->getData()->format('Y-m-d'));

        $sucesso = $query->execute();

        if (!$sucesso) {
            $this->defineMensagem('erro', 'Algo deu errado na inserção dos dados.');
        }

        return $sucesso;
    }

    /**
     * @method responsável por mostar dados de um cliente
     * @param int $id recebe o id do cliente que vai ser buscado no banco de dados
     * @return bool retorna se a operação foi ou não realizada com sucesso
     */
    public function cliente(int $id): bool
    {
        $cliente = $this->conn->prepare('SELECT * FROM clientes WHERE id = :id');
        $cliente->execute([':id' => $id]);
        return $cliente->fetch();
    }

    /**
     * @method responsável por editar dados de um cliente
     * @param Cliente $cliente recebe um cliente com seus dados preenchidos
     * @param int $id recebe o id do cliente que vai ser responsável pela operação de deleção
     * @return bool retorna se a operação foi ou não realizada com sucesso
     */
    public function editar(Cliente $cliente, int $id): bool
    {
        $query = $this->conn->prepare(
            "UPDATE clientes
        SET nome = :nome, email = :email, telefone = :telefone, data = :data
        WHERE id = :id"
        );

        $sucesso = $query->execute([
            ':nome' => $cliente->getNome(),
            ':email' => $cliente->getEmail(),
            ':telefone' => $cliente->getTelefone(),
            ':data' => $cliente->getData()->format('Y-m-d'),
            ':id' => $id
        ]);

        return $sucesso;
    }


    /**
     * @method responsável por exluir um cliente
     * @param int $id recebe o id do cliente que vai ser responsável pela operação de deleção
     * @return bool retorna se a operação foi ou não realizada com sucesso
     */
    public function excluir(int $id): bool
    {
        $query = $this->conn->prepare(
            "DELETE FROM clientes WHERE id = :id;"
        );

        $sucesso = $query->execute([':id' => $id]);

        return $sucesso;
    }

    /**
     * @method responsável por fazer a paginação da landpage
     * @param int $pag recebe a numeração da página
     * @return array retorna os dados necessários para a paginação
     */
    public function vizualizar(int $pag = 0): array
    {
        $line = $this->conn->prepare("SELECT * FROM clientes");
        $line->execute();

        $count = $pag * 10;

        $query = $this->conn->prepare(
            "SELECT * FROM clientes LIMIT $count, 10"
        );

        $query->execute();
        if (($line->rowCount() - $count) > 10 and $pag != 0) {
            return [
                'clientes' => $query->fetchAll(),
                'cadastros' => $line->rowCount(),
                'voltar' => true,
                'avancar' => true
            ];
        } else if ($line->rowCount() > 10 and $count == 0) {
            return [
                'clientes' => $query->fetchAll(),
                'cadastros' => $line->rowCount(),
                'voltar' => false,
                'avancar' => true
            ];
        } else if (($line->rowCount() - $count) < 10 and $pag != 0) {
            return [
                'clientes' => $query->fetchAll(),
                'cadastros' => $line->rowCount(),
                'voltar' => true,
                'avancar' => false
            ];
        } else {
            return [
                'clientes' => $query->fetchAll(),
                'cadastros' => $line->rowCount(),
                'voltar' => false,
                'avancar' => false
            ];
        }
    }
}
