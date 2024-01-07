<?php
if (isset($edit) && isset($serieFoundIt) && is_object($serieFoundIt)) {
  $url_action = base_url . "Serie/create&id=" . $serieFoundIt->getId();
} else {
  $url_action = base_url . "Serie/create";
}

$found = isset($serieFoundIt) && is_object($serieFoundIt);
?>

<form action="<?= $url_action ?>" method="POST" class="form" style=" width: 60%">
  <p class="form-group">
    <label for="name">Nombre </label>
    <input type="text" name="name" required class="form-input" placeholder="Ingrese el nombre de la serie" value="<?= isset(
      $serieFoundIt
    ) && is_object($serieFoundIt)
      ? $serieFoundIt->getName()
      : "" ?>" />
  </p>
    <p class="form-group">
        <label for="platform">Plataforma </label>
        <div class="select-container">
            <select name="platform" class="custom-select">
              <?php foreach ($platforms as $platform): ?>
                  <option value="<?= $platform->getId(); ?>" >
                    <?= $platform->getName(); ?>
                  </option>
              <?php endforeach; ?>
            </select>
            <span class="select-arrow">&#9660;</span>
        </div>
    </p>


    <p class="form-group">
    <label for="actors[]">Actores y Actrices </label>
    <div class="custom-select">
        <select  name="actors[]" multiple class="custom-multiple-select">
          <?php foreach ($actors as $actor): ?>
              <option value="<?= $actor->getId(); ?>">
                <?= $actor->getName(); ?>
              </option>
          <?php endforeach; ?>
        </select>
    </div>

  </p>

  <p class="form-group">
    <label for="director">Director </label>
    <div class="select-container">
        <select  name="director" class="custom-select" >
          <?php foreach ($directors as $director): ?>
              <option value="<?= $director->getId(); ?>"  >
                <?= $director->getName(); ?>
              </option>
          <?php endforeach; ?>
        </select>
        <span class="select-arrow">&#9660;</span>
    </div>
  </p>

  <p class="form-group">
    <div class="textarea-container">
        <label for="review" class="textarea-label">Escriba la review:</label>
        <textarea id="review" name="review" class="custom-textarea" rows="4" placeholder="Ingrese su review aquí..."></textarea>
    </div>
  </p>
  <p>
    <br>
    <input type="submit" value="Crear Serie" class="button-dashboard-primary">
    <br>
  </p>
</form>
