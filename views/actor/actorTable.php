
<h3 class="heading-3">Listado de Actores</h3>
<table class="table">
  <tr class="table-header">
    <th>id</th>
    <th>Name</th>
    <th>Surname</th>
    <th>Birthdate</th>
    <th>Nationality</th>

  </tr>
  <?php  while ($actor = $actors->fetch_object()):?>
  <tr class="table-body">
    <td><?= $actor->id; ?></td>
    <td><?= $actor->name; ?></td>
    <td><?= $actor->surname; ?></td>
    <td><?= $actor->birthdate; ?></td>
    <td><?= $actor->nationality; ?></td>
    <td>
    <a class="button-dashboard-danger" href="<?=base_url?>Actor/delete&id=<?=$actor->id;?>"> Eliminar </a>
    <a class="button-dashboard-secondary" href="<?=base_url?>Actor/update&id=<?=$actor->id;?>"> Actualizar </a>
    </td>
  </tr>
  <?php endwhile;  ?>
</table>