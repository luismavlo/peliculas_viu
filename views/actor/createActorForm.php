<?php
    if(isset($edit) && isset($actorFoundIt) && is_object($actorFoundIt)){
        $url_action = base_url."Actor/create&id=".$actorFoundIt->id;
    } else {
        $url_action = base_url."Actor/create";
    }
?>

<form action="<?=$url_action?>" method="POST" class="form" style=" width: 40%">
<p class="form-group">
        <label for="name">Nombre </label>
        <input type="text" name="name" required class="form-input" placeholder="Ingrese el nombre del actor" value="<?= isset($actorFoundIt) && is_object($actorFoundIt) ? $actorFoundIt->name : ''; ?>" />
    </p>
    <p class="form-group">
        <label for="surname">Apellido </label>
        <input type="text" name="surname" required class="form-input" placeholder="Ingrese el apellido del actor" value="<?= isset($actorFoundIt) && is_object($actorFoundIt) ? $actorFoundIt->surname : ''; ?>" />
    </p>
    <p class="form-group">
        <label for="birthdate">Fecha de Nacimiento </label>
        <input type="date" name="birthdate" required class="form-input" placeholder="Ingrese la fecha de nacimiento del actor" value="<?= isset($actorFoundIt) && is_object($actorFoundIt) ? $actorFoundIt->birthdate : ''; ?>"/>
    </p>
    <p class="form-group">
        <label for="nationality">Nacionalidad</label>
        <input type="text" name="nationality" required class="form-input" placeholder="Ingrese la nacionalidad del actor" value="<?= isset($actorFoundIt) && is_object($actorFoundIt) ? $actorFoundIt->nationality : ''; ?>"/>
    </p>
    <?php if(isset($edit)): ?>
        <p>
            <input type="submit" value="Editar Actor" class="button-dashboard-primary">
        </p>
    <?php else: ?>
        <p>
            <input type="submit" value="Crear Actor" class="button-dashboard-primary">
        </p>
    <?php endif; ?>
    
</form>
