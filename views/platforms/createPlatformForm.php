

<form action="<?=base_url?>Platform/create" method="POST" class="form" style="height: 20rem; width: 40%">
    <p class="form-group">
        <label for="name">Nombre </label>
        <input type="text" name="name" required class="form-input" placeholder="Ingrese el nombre de la plataforma"/>
    </p>
    <p class="form-group">
        <label for="image">Image url </label>
        <input type="text" name="image" required class="form-input" placeholder="Ingrese la url de la imagen de la plataforma"/>
    </p>
    <p>
        <input type="submit" value="Crear plataforma" class="button-dashboard-primary">
    </p>
</form>
