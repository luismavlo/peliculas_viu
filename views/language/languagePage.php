
<main class="container container_dash">
    <h2 class="title-2">Ingreso de Idioma</h2>

    <?php if(isset($_SESSION['create_language']) && $_SESSION['create_language'] == 'completed' ): ?>
        <strong class="text-success"> Registro completado correctamente </strong>
    <?php elseif(isset($_SESSION['create_language']) && $_SESSION['create_language'] == 'failed' ): ?>
        <strong class="text-danger"> Registro fallido </strong>
    <?php endif; ?>


    <?php Util::deleteSession('create_language') ?>

    <?php require_once 'createLanguageForm.php';?>

    <?php if(!isset($edit)): ?>
        <?php if(isset($_SESSION['delete_language']) && $_SESSION['delete_language'] == 'completed' ): ?>
            <strong class="text-success"> Registro eliminado correctamente </strong>
        <?php elseif(isset($_SESSION['delete_language']) && $_SESSION['delete_language'] == 'failed' ): ?>
            <strong class="text-danger"> Eliminación de registro fallida </strong>
        <?php endif; ?>

        <?php Util::deleteSession('delete_language') ?>


        <?php require_once 'languageTable.php';?>
    <?php endif; ?>
</main>