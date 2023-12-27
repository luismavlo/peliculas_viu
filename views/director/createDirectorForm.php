
<?php
    if(isset($edit) && isset($directorFoundIt) && is_object($directorFoundIt)){
        $url_action = base_url."Director/create&id=".$directorFoundIt->id;
    } else {
        $url_action = base_url."Director/create";
    }
?>

<form action="<?=$url_action?>" method="POST" class="form" style=" width: 40%">
<p class="form-group">
        <label for="name">Nombre </label>
        <input type="text" name="name" required class="form-input" placeholder="Ingrese el nombre del director" value="<?= isset($directorFoundIt) && is_object($directorFoundIt) ? $directorFoundIt->name : ''; ?>" />
    </p>
    <p class="form-group">
        <label for="surname">Apellido </label>
        <input type="text" name="surname" required class="form-input" placeholder="Ingrese el apellido del director" value="<?= isset($directorFoundIt) && is_object($directorFoundIt) ? $directorFoundIt->surname : ''; ?>" />
    </p>
    <p class="form-group">
        <label for="birthdate">Fecha de Nacimiento </label>
        <input type="date" name="birthdate" required class="form-input" placeholder="Ingrese la fecha de nacimiento del director" value="<?= isset($directorFoundIt) && is_object($directorFoundIt) ? $directorFoundIt->birthdate : ''; ?>"/>
    </p>
    <p class="form-group">
        <label for="nationality">Nacionalidad</label>
        <input type="text" name="nationality" required class="form-input" placeholder="Ingrese la nacionalidad del director" value="<?= isset($directorFoundIt) && is_object($directorFoundIt) ? $directorFoundIt->nationality : ''; ?>"/>
    </p>
    <p>
        <input type="submit" value="Crear Director" class="button-dashboard-primary">
    </p>
</form>
