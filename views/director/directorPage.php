
<main class="container container_dash">
    <h2 class="title-2">Ingreso de Director</h2>

    <?php if(isset($_SESSION['create_director']) && $_SESSION['create_director'] == 'completed' ): ?>
        <strong class="text-success"> Registro completado correctamente </strong>
    <?php elseif(isset($_SESSION['create_director']) && $_SESSION['create_director'] == 'failed' ): ?>
        <strong class="text-danger"> Registro fallido </strong>
    <?php endif; ?>


    <?php Util::deleteSession('create_director') ?>

    <?php require_once 'createDirectorForm.php';?>

    <?php if(!isset($edit)): ?>
        <?php if(isset($_SESSION['delete_director']) && $_SESSION['delete_director'] == 'completed' ): ?>
            <strong class="text-success"> Registro eliminado correctamente </strong>
        <?php elseif(isset($_SESSION['delete_director']) && $_SESSION['delete_director'] == 'failed' ): ?>
            <strong class="text-danger"> Eliminación de registro fallida </strong>
        <?php endif; ?>

        <?php Util::deleteSession('delete_director') ?>


        <?php require_once 'directorTable.php';?>
    <?php endif; ?>
</main>