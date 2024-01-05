<main class="container container_dash">
    <h2 class="title-2">Administración de Series</h2>
    <?php if(isset($_SESSION['create_serie']) && $_SESSION['create_serie'] == 'completed' ): ?>
        <strong class="text-success"> Registro de serie completado correctamente </strong>
    <?php elseif(isset($_SESSION['create_serie']) && $_SESSION['create_serie'] == 'failed' ): ?>
        <strong class="text-danger"> Registro fallido </strong>
    <?php endif; ?>
    <?php Util::deleteSession('create_serie') ?>

    <?php require_once 'createSerieForm.php';?>
    
    <?php if(!isset($edit)): ?>
        <?php if(isset($_SESSION['delete_serie']) && $_SESSION['delete_serie'] == 'completed' ): ?>
            <strong class="text-success"> Registro eliminado correctamente </strong>
        <?php elseif(isset($_SESSION['delete_serie']) && $_SESSION['delete_serie'] == 'failed' ): ?>
            <strong class="text-danger"> Eliminación de registro fallida </strong>
        <?php endif; ?>

        <?php Util::deleteSession('delete_serie') ?>

    <?php require_once 'serieTable.php';?>
    <?php endif; ?>


</main>