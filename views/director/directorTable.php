
<h3 class="heading-3">Listado de Director</h3>
<table class="table">
  <tr class="table-header">
    <th>id</th>
    <th>Name</th>
    <th>Surname</th>
    <th>Birthdate</th>
    <th>Nationality</th>
    <th>Acciones</th>
  </tr>
  <?php  while ($director = $directors->fetch_object()):?>
  <tr class="table-body">
    <td><?= $director->id; ?></td>
    <td><?= $director->name; ?></td>
    <td><?= $director->surname; ?></td>
    <td><?= $director->birthdate; ?></td>
    <td><?= $director->nationality; ?></td>
    <td>
    <a class="button-dashboard-danger" href="<?=base_url?>Director/delete&id=<?=$director->id;?>"> Eliminar </a>
    <a class="button-dashboard-secondary" href="<?=base_url?>Director/update&id=<?=$director->id;?>"> Actualizar </a>
    </td>
  </tr>
  <?php endwhile;  ?>
</table>