
<h3 class="heading-3">Listado de Directores</h3>
<table class="table">
  <tr class="table-header">
    <th>id</th>
    <th>Nombre</th>
    <th>Apellido</th>
    <th>Facha de Nacimiento</th>
    <th>Nacionalidad</th>
    <th>Acciones</th>
  </tr>
  <?php  while ($director = $directors->fetch_object()):?>
  <tr class="table-body">
    <td><?= $director->id; ?></td>
    <td><?= $director->name; ?></td>
    <td><?= $director->surname; ?></td>
    <td><?= date_format(date_create($director->birthdate),"d/m/Y"); ?></td>
    <td><?= $director->nationality; ?></td>
    <td>
    <a class="button-dashboard-danger" href="<?=base_url?>Director/delete&id=<?=$director->id;?>"> Eliminar </a>
    <a class="button-dashboard-secondary" href="<?=base_url?>Director/update&id=<?=$director->id;?>"> Actualizar </a>
    </td>
  </tr>
  <?php endwhile;  ?>
</table>