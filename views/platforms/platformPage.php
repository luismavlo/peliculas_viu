
<main class="container container_dash">
    <h2 class="title-2">Administración de plataformas</h2>

    <?php if(isset($_SESSION['create_platform']) && $_SESSION['create_platform'] == 'completed' ): ?>
        <strong class="text-success"> Registro completado correctamente </strong>
    <?php elseif(isset($_SESSION['create_platform']) && $_SESSION['create_platform'] == 'failed' ): ?>
        <strong class="text-danger"> Registro fallido </strong>
    <?php endif; ?>

    <?php Util::deleteSession('create_platform') ?>

    <?= require_once 'createPlatformForm.php';?>

    <?php if(!isset($edit)): ?>
        <?php if(isset($_SESSION['delete_platform']) && $_SESSION['delete_platform'] == 'completed' ): ?>
            <strong class="text-success"> Registro eliminado correctamente </strong>
        <?php elseif(isset($_SESSION['delete_platform']) && $_SESSION['delete_platform'] == 'failed' ): ?>
            <strong class="text-danger"> Eliminación de registro fallida </strong>
        <?php endif; ?>

        <?php Util::deleteSession('delete_platform') ?>


        <?= require_once 'platformTable.php';?>
    <?php endif; ?>


</main>