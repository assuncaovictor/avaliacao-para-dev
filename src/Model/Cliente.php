<?php

namespace Assuncaovictor\Leilao\Model;

use Assuncaovictor\Leilao\Helper\FlashMessageTrait;
use Assuncaovictor\Leilao\Helper\RetornaInput;
use Error;

/**
 * Mapeia os dados do cliente para inserir no banco de dados
 */
class Cliente
{
    use RetornaInput;
    use FlashMessageTrait;

    private string $nome;
    private string $email;
    private int $telefone;
    private \DateTimeImmutable $data;

    public bool $prosseguir = true;

    public function setNome(string $nome): void
    {
        $nome = htmlspecialchars($nome, ENT_QUOTES, 'UTF-8');
        $this->retornaInput('nome', $nome);
        if (strlen($nome) < 3 or strlen($nome) > 70) {
            $this->defineMensagem('erro', 'O nome deve conter entre 3 a 70 caracteres', 'nome');
            $this->prosseguir = false;
        } else {
            $this->nome = $nome;
            unset($_SESSION['nome']);
        }
    }

    public function setEmail(string $email): void
    {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $this->retornaInput('email', $email);
        if (!$email) {
            $this->defineMensagem('erro', 'E-mail inválido', 'email');
            $this->prosseguir = false;
        } else {
            $this->email = $email;
            unset($_SESSION['email']);
        }
    }

    public function setTelefone($telefone): void
    {
        $telefone = filter_input(INPUT_POST, 'telefone', FILTER_VALIDATE_INT);
        $this->retornaInput('telefone', $telefone);
        if (!$telefone or strlen($telefone) < 8) {
            $this->defineMensagem('erro', 'apenas caracteres numéricos', 'telefone');
            $this->prosseguir = false;
        } else {
            $this->telefone = $telefone;
            unset($_SESSION['telefone']);
        }
    }

    public function setData($datatime): void
    {
        try {
            $data = new \DateTimeImmutable($datatime);
        } catch (Error) {
            $this->defineMensagem('erro', 'Data inválida', 'data');
        }

        $this->retornaInput('data', $datatime);

        if ($_SESSION['data']['erro']) {
            $this->prosseguir = false;
        } else {
            $this->data = $data;
            unset($_SESSION['data']);
        }
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getTelefone(): int
    {
        return $this->telefone;
    }

    public function getData(): \DateTimeImmutable
    {
        return $this->data;
    }

    public function getStatus(): bool
    {
        return $this->prosseguir;
    }
}
