
<main class="container container_dash">
    <h2 class="title-2">Ingreso de Actor</h2>

    <?php if(isset($_SESSION['create_actor']) && $_SESSION['create_actor'] == 'completed' ): ?>
        <strong class="text-success"> Registro completado correctamente </strong>
    <?php elseif(isset($_SESSION['create_actor']) && $_SESSION['create_actor'] == 'failed' ): ?>
        <strong class="text-danger"> Registro fallido </strong>
    <?php endif; ?>


    <?php Util::deleteSession('create_actor') ?>

    <?php require_once 'createActorForm.php';?>

    <?php if(!isset($edit)): ?>
        <?php if(isset($_SESSION['delete_actor']) && $_SESSION['delete_actor'] == 'completed' ): ?>
            <strong class="text-success"> Registro eliminado correctamente </strong>
        <?php elseif(isset($_SESSION['delete_actor']) && $_SESSION['delete_actor'] == 'failed' ): ?>
            <strong class="text-danger"> Eliminación de registro fallida </strong>
        <?php endif; ?>

        <?php Util::deleteSession('delete_actor') ?>


        <?php require_once 'actorTable.php';?>
    <?php endif; ?>
</main>