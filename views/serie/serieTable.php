<h3 class="heading-3">Listado de Series</h3>

<table class="table">
    <tr class="table-header">
        <th>Nombre</th>
        <th>Plataformas <br> Disponibles </th>
        <th>Reviews </th>
        <th>Idioma Audios disponibles </th>
        <th>Idioma Subtitulos disponibles </th>
        <th>Actores </th>
        <th>Director </th>
        <th>Acciones</th>
    </tr>

  <?php foreach ($series as $serie): ?>
      <tr class="table-body">
          <td><?= $serie->getName(); ?></td>
          <td><?= $serie->getPlatform()->getName(); ?></td>
          <td><?= $serie->getReview(); ?></td>
          <td><?= SerieController::findLanguagesInSerie($serie); ?></td>
          <td><?= SerieController::findLanguagesSubtitulosInSerie($serie); ?></td>
          <td><?= SerieController::findActorsInSerie($serie); ?></td>
          <td><?= $serie->getDirector()->getName() . ' ' . $serie->getDirector()->getsurname(); ?></td>
          <td>
              <a class="button-dashboard-danger" href="<?= base_url ?>Serie/delete&id=<?= $serie->getId(); ?>"> Eliminar </a>
              <a class="button-dashboard-secondary" href="<?= base_url ?>Serie/update&id=<?= $serie->getId(); ?>"> Actualizar </a>
          </td>
      </tr>
  <?php endforeach; ?>
</table>
