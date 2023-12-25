
<h3>Listado de Plataformas</h3>

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
            <button class="button-dashboard-danger"> Eliminar </button>
            <button class="button-dashboard-secondary"> Actualizar </button>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
