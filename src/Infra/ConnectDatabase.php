<?php

namespace Assuncaovictor\Leilao\Infra;

use PDO;

class ConnectDatabase
{
    /**
     * @method reponsável por criar uma conexão no banco de dados através de PDO
     */
    public static function createConnection()
    {
        // Configura o host
        $host = 'localhost';

        // O nome do banco de dados
        $dbnome = 'confianca_leiloes';

        // O nome do usuário que vai fazer a conexão
        $usuario = "root";

        // A senha do usuário que vai realizar a conexão
        $senha = "null";

        $connection = new PDO(
            "mysql:host=$host;dbname=$dbnome;charset=utf8mb4",
            $usuario,
            $senha
        );

        // interface de acesso para banco de dados habilitando o modo Error em vez de exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $connection;
    }
}
