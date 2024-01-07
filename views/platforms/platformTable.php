<h3 class="heading-3">Listado de Plataformas</h3>

<table class="table">
    <tr class="table-header">
        <th>Logo</th>
        <th>Nombre</th>
        <th>Acción</th>
    </tr>

  <?php foreach ($platforms as $platform): ?>
      <tr class="table-body">
          <td><?= $platform->getImage(); ?></td>
          <td><?= $platform->getName(); ?></td>
          <td>
              <a class="button-dashboard-danger" href="<?= base_url ?>Platform/delete&id=<?= $platform->getId(); ?>"> Eliminar </a>
              <a class="button-dashboard-secondary" href="<?= base_url ?>Platform/update&id=<?= $platform->getId(); ?>"> Actualizar </a>
          </td>
      </tr>
  <?php endforeach; ?>
</table>
