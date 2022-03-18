<?php if (isset($dados)) { ?>
    <div></div>
    <table class="tabela" border="1">
        <thead>
            <tr>
                <th>Nome</th>
                <th class="hidden">Telefone</th>
                <th class="hidden">Data de nascimento</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dados['clientes'] as $cliente) { ?>
                <tr>
                    <td><?= $cliente['nome'] ?></td>
                    <td class="hidden"><?= $cliente['telefone'] ?></td>
                    <td class="hidden"><?= $cliente['email'] ?></td>
                    <td><a href="/vizualizar?id=<?= $cliente['id'] ?>">Vizualizar</a></td>
                    <td><a href="/editar?id=<?= $cliente['id'] ?>">Editar</a></td>
                    <td><a href="/excluir?id=<?= $cliente['id'] ?>">Excluir</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <div class="paginacao">

        <?php
        $voltar = "<a href='?pag=" . $_GET['pag'] - 1 . "'>Voltar</a>";
        $avancar = "<a href='?pag=" . $_GET['pag'] + 1 . "'>Avançar</a";
        ?>

        <?= $dados['voltar'] ? $voltar : '' ?>

        <?php if ((!$voltar and !$avancar)) { ?>
            <a href=""><?= $_GET['pag'] ?></a>
        <?php } ?>

        <?= $dados['avancar'] ? $avancar : '' ?>
    </div>
<?php } else { ?>
    <div>
        <span>Nenhum usuário cadastrados</span>
    </div>
<?php } ?>