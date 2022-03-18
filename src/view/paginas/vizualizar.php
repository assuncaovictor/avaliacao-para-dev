<!DOCTYPE html>
<html lang="pt-BR">

<?php require_once __DIR__ . '/../_components/head.php' ?>

<body>
    <?php require_once __DIR__ . '/../_components/header.php' ?>
    <main>
        <h1 class="titulo"><?= $titulo ?></h1>
        <?php require_once __DIR__ . '/../_components/cliente.php' ?>
    </main>
    <?php require_once __DIR__ . '/../_components/footer.php' ?>
</body>

</html>

<?php if (isset($_SESSION['mensagem']['erro']) and isset($_SESSION['mensagem']['erro']) == 'sucesso') { ?>
    <script>
        alert("<?= $_SESSION['mensagem']['mensagem'] ?>")
    </script>
<?php } ?>