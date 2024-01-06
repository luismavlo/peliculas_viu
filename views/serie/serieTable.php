<br>
<h3 class="heading-3">Listado de Series</h3>

<table class="table">
  <tr class="table-header">
    <th>Nombre</th>
    <th>Plataformas <br> Disponibles </th>
    <th>Reviews </th>
    <th>Actores </th>
    <th>Director </th>
  </tr>
 
  <?php 
    $serie=new Serie();
    $allSeries=new ArrayObject();
    $allSeries = $serie->findAll();
    $actor=new Actor();
 
     for($i=0;$i<$allSeries->count();$i++){

        $serieObjeto=$allSeries->offsetGet($i);

 ?>
  <tr class="table-body">
    <td><?= $serieObjeto->getName(); ?></td>
    <td><?= $serieObjeto->getPlatform()->getName(); ?></td>
    <td><?= $serieObjeto->getReview(); ?></td>
    <td><?= $actor->printActors($serieObjeto->getActors()); ?></td>
    <td><?= $serieObjeto->getDirector()->getName().' '.$serieObjeto->getDirector()->getsurname() ; ?></td>
    <a class="button-dashboard-danger" href="<?=base_url?>Serie/delete&id=<?=$serieObjeto->getId();?>"> Eliminar </a>
    <a class="button-dashboard-secondary" href="<?=base_url?>Serie/update&id=<?=$serieObjeto->getId();?>"> Actualizar </a>
    </td>
    <?php ?>
</tr>
 
  <?php } ?>
</table>