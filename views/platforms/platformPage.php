
<main class="container container_dash">
    <h2 class="title-2">Administración de plataformas</h2>

    <?php if(isset($_SESSION['create_platform']) && $_SESSION['create_platform'] == 'completed' ): ?>
        <strong class="text-success"> Registro completado correctamente </strong>
    <?php elseif(isset($_SESSION['create_platform']) && $_SESSION['create_platform'] == 'failed' ): ?>
        <strong class="text-danger"> Registro fallido </strong>
    <?php endif; ?>

    <?php Util::deleteSession('create_platform') ?>

    <?= require_once 'createPlatformForm.php';?>

    <?= require_once 'platformTable.php';?>
</main>