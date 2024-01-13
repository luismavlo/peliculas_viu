<?php
    if(isset($edit) && isset($languageFoundIt) && is_object($languageFoundIt)){
        $url_action = base_url."Language/create&id=".$languageFoundIt->id;
    } else {
        $url_action = base_url."Language/create";
    }
?>

<form action="<?=$url_action?>" method="POST" class="form" style=" width: 40%">
<p class="form-group">
        <label for="name">Nombre </label>
        <input type="text" name="name" required class="form-input" placeholder="Ingrese el nombre del idioma" value="<?= isset($languageFoundIt) && is_object($languageFoundIt) ? $languageFoundIt->name : ''; ?>" />
    </p>
    <p class="form-group">
        <label for="isoCode">ISO CODE </label>
        <input type="text" name="isoCode" required class="form-input" placeholder="Ingrese el ISO CODE" value="<?= isset($languageFoundIt) && is_object($languageFoundIt) ? $languageFoundIt->ISO_code : ''; ?>" />
    </p>
    <?php if(isset($edit)): ?>
        <p>
            <input type="submit" value="Editar idioma" class="button-dashboard-primary">
        </p>
    <?php else: ?>
        <p>
            <input type="submit" value="Crear idioma" class="button-dashboard-primary">
        </p>
    <?php endif; ?>
</form>
