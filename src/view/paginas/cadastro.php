<!DOCTYPE html>
<html lang="pt-BR">

<?php require_once __DIR__ . '/../_components/head.php' ?>

<body>
    <?php require_once __DIR__ . '/../_components/header.php' ?>
    <main class="principal">
        <h1 class="titulo"><?= $titulo ?></h1>
        <form action="<?= isset($cliente) ? '/alterar' : '/cadastrar' ?>" class="formulario" method="post">
            <?= isset($cliente) ? "<input type='hidden' name='id' value='{$cliente['id']}'>" : '' ?>
            <input class="input <?= isset($_SESSION['nome']) ? 'borda-vermelha' : '' ?>" type="text" name="nome" id="nome" placeholder="Nome do cliente" <?php
                                                                                                                                                            if (isset($cliente['nome'])) {
                                                                                                                                                                echo "value='{$cliente['nome']}'";
                                                                                                                                                            } else if (isset($_SESSION['input']['nome'])) {
                                                                                                                                                                echo "value='{$_SESSION['input']['nome']}'";
                                                                                                                                                            } else {
                                                                                                                                                                echo '';
                                                                                                                                                            }
                                                                                                                                                            ?> required>
            <?php if (isset($_SESSION['nome'])) { ?>
                <span class="<?= $_SESSION['nome']['erro']  ?>"> <?= $_SESSION['nome']['mensagem'] ?></span>
            <?php } ?>
            <input class="input <?= isset($_SESSION['email']) ? 'borda-vermelha' : '' ?>" type="email" name="email" id="email" placeholder="Email" required <?php
                                                                                                                                                            if (isset($cliente['email'])) {
                                                                                                                                                                echo "value='{$cliente['email']}'";
                                                                                                                                                            } else if (isset($_SESSION['input']['email'])) {
                                                                                                                                                                echo "value='{$_SESSION['input']['email']}'";
                                                                                                                                                            } else {
                                                                                                                                                                echo '';
                                                                                                                                                            }
                                                                                                                                                            ?>>
            <?php if (isset($_SESSION['email'])) { ?>
                <span class="<?= $_SESSION['email']['erro']  ?>"> <?= $_SESSION['email']['mensagem'] ?></span>
            <?php } ?>
            <div class="divisao-input-2">
                <input class="input <?= isset($_SESSION['telefone']) ? 'borda-vermelha' : '' ?>" type="tel" name="telefone" id="telefone" placeholder="Telefone" required <?php
                                                                                                                                                                            if (isset($cliente['telefone'])) {
                                                                                                                                                                                echo "value='{$cliente['telefone']}'";
                                                                                                                                                                            } else if (isset($_SESSION['input']['telefone'])) {
                                                                                                                                                                                echo "value='{$_SESSION['input']['telefone']}'";
                                                                                                                                                                            } else {
                                                                                                                                                                                echo '';
                                                                                                                                                                            }
                                                                                                                                                                            ?>>
                <input class="input <?= isset($_SESSION['data']) ? 'borda-vermelha' : '' ?>" type="date" name="data" id="data" placeholder="Nascimento" required <?php
                                                                                                                                                                    if (isset($cliente['data'])) {
                                                                                                                                                                        echo "value='{$cliente['data']}'";
                                                                                                                                                                    } else if (isset($_SESSION['input']['data'])) {
                                                                                                                                                                        echo "value='{$_SESSION['input']['data']}'";
                                                                                                                                                                    } else {
                                                                                                                                                                        echo '';
                                                                                                                                                                    }
                                                                                                                                                                    ?>>
            </div>
            <div class="divisao-input-2">
                <span class="erro-2"><?= isset($_SESSION['telefone']['mensagem']) ? $_SESSION['telefone']['mensagem'] : '' ?></span>
                <span class="erro-2"><?= isset($_SESSION['data']['mensagem']) ? $_SESSION['data']['mensagem'] : '' ?></span>
            </div>
            <input class="input-submit" type="submit" value="<?= isset($cliente) ? 'Alterar' : 'Cadastrar' ?>">
        </form>
    </main>
    <?php require_once __DIR__ . '/../_components/footer.php' ?>
</body>

</html>