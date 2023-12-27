
<?php
if(isset($edit) && isset($platformFoundIt) && is_object($platformFoundIt)){
    $url_action = base_url."Platform/create&id=".$platformFoundIt->id;
} else {
    $url_action = base_url."Platform/create";
}
?>

<form action="<?=$url_action?>" method="POST" class="form" style="height: 20rem; width: 40%">
    <p class="form-group">
        <label for="name">Nombre </label>
        <input type="text" name="name" required class="form-input" placeholder="Ingrese el nombre de la plataforma" value="<?= isset($platformFoundIt) && is_object($platformFoundIt) ? $platformFoundIt->name : ''; ?>"/>
    </p>
    <p class="form-group">
        <label for="image">Image url </label>
        <input type="text" name="image" required class="form-input" placeholder="Ingrese la url de la imagen de la plataforma" value="<?= isset($platformFoundIt) && is_object($platformFoundIt) ? $platformFoundIt->image : ''; ?>"/>
    </p>
    <?php if(isset($edit)): ?>
        <p>
            <input type="submit" value="Editar plataforma" class="button-dashboard-primary">
        </p>
    <?php else: ?>
        <p>
            <input type="submit" value="Crear plataforma" class="button-dashboard-primary">
        </p>
    <?php endif; ?>

</form>
