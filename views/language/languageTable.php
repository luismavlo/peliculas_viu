
<h3 class="heading-3">Listado de Idiomas</h3>
<table class="table">
  <tr class="table-header">
    <th>id</th>
    <th>Nombre</th>
    <th>Iso Code</th>
    <th>Acciones</th>
  </tr>
  <?php  while ($language = $languages->fetch_object()):?>
  <tr class="table-body">
    <td><?= $language->id; ?></td>
    <td><?= $language->name; ?></td>
    <td><?= $language->ISO_code; ?></td>
   
    <td>
    <a class="button-dashboard-danger" href="<?=base_url?>Language/delete&id=<?=$language->id;?>"> Eliminar </a>
    <a class="button-dashboard-secondary" href="<?=base_url?>Language/update&id=<?=$language->id;?>"> Actualizar </a>
    </td>
  </tr>
  <?php endwhile;  ?>
</table>