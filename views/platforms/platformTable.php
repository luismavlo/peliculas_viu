
<h3 class="heading-3">Listado de Plataformas</h3>

<table class="table">
    <tr class="table-header">
        <th>Logo</th>
        <th>Nombre</th>
        <th>Acción</th>
    </tr>
    <?php while ($platform = $platforms->fetch_object()): ?>
        <tr class="table-body">
            <td><?= $platform->image; ?></td>
            <td><?= $platform->name; ?></td>
            <td>
                <a class="button-dashboard-danger" href="<?=base_url?>Platform/delete&id=<?=$platform->id;?>"> Eliminar </a>
                <a class="button-dashboard-secondary" href="<?=base_url?>Platform/update&id=<?=$platform->id;?>"> Actualizar </a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
