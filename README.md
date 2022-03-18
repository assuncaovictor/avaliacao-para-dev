# AVALIAÇÃO PARA DESENVOLVEDOR - LEILÃO CONFIANÇA

## Como utilizar do site

### Para o aplicativo funcionar é necessário que o banco de dados confianca_leiloes exista no servidor, para tal deve-se rodar os seguinte comandos no MySQL:

drop database if exists confianca_leiloes;
create database confianca_leiloes char set utf8mb4 collate utf8mb4_unicode_ci default collate utf8mb4_unicode_ci;
use confianca_leiloes;

create table if not exists clientes(
id bigint auto_increment not null,
nome varchar(70) not null,
telefone bigint not null,
email varchar(255) not null,
data date not null,
constraint PK_clientes primary key (id)
)engine=InnoDB character set=utf8mb4 collate=utf8mb4_unicode_ci;

### Em seguida é necessário fazer as seguintes configurações no arquivo ConnectDatabase.php, localizado em src/Infra:

        // Configura o host
        $host = 'localhost';

        // O nome do banco de dados
        $dbnome = 'confianca_leiloes';

        // O nome do usuário que vai fazer a conexão
        $usuario = "root";

        // A senha do usuário que vai realizar a conexão
        $senha = "null";

### Para rodar o site basta entrar na pasta com o termal e digitar o seguinte comando:

php -S localhost:8080 -t public

### Por fim, acesse na URL de qualquer navegador o site http://localhost:8080/
