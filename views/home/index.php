
<main class="container">
    <section class="hero">
        <section class="hero__content-main-image">
            <div class="wrap">
                <div class="wrap-text">
                    Demon Slayer:
                    <p>Kimetsu no Yaiba</p>
                </div>
            </div>
        </section>
        <section class="hero__content-cards">
          <?php
          // Supongamos que $series es tu ArrayObject de series

          // Obtén los dos últimos elementos del array
          $ultimasDosSeries = array_slice($series->getArrayCopy(), -2);

          // Recorre solo los dos últimos registros
          foreach ($ultimasDosSeries as $serie):
            ?>
              <article class="hero_card">
                 <a href="<?= base_url ?>Home/serieDetail&id=<?= $serie->getId(); ?>" style="text-decoration:none"> <img src="<?= $serie->getSerieImg(); ?>" alt="imagen de la tarjeta" width="25%"></a>
                  <div>
                      <h2><?= $serie->getName(); ?></h2>
                      <p><?= $serie->getReview(); ?></p>
                      <button class="button-primary" disabled>
                          <i class="fa-solid fa-play"></i>
                          <a href="<?= base_url ?>Home/serieDetail&id=<?= $serie->getId(); ?>" style="text-decoration:none; color: white">Ver más</a>
                      </button>
                  </div>
              </article>
          <?php
          endforeach;
          ?>

        </section>
    </section>
    <section class="platforms">
        <?php foreach ($platforms as $platform): ?>
            <article class="platforms__card">
                <img src="<?=$platform['image']?>" alt="logo plataforma">
                <div>
                    <h3><?= isset($platform['name']) ? $platform['name'] : 'Nombre no disponible'; ?></h3>
                    <p><?= isset($platform['total_serie']) ? $platform['total_serie'] : '0'; ?>+ Series</p>
                </div>
            </article>
        <?php endforeach; ?>
    </section>
    <section class="series">
        <h2>Todas las series</h2>
        <section class="series__content">
            <?php foreach ($series as $serie): ?>
                <article class="series__card">
                <a href="<?= base_url ?>Home/serieDetail&id=<?= $serie->getId(); ?>" style="text-decoration:none"><img src="<?=$serie->getSerieImg()?>" alt="imagen de una serie"></a>
                    <div>
                        <h2><?= $serie->getName(); ?></h2>
                        <p><span>Audio:</span> <?= SerieController::findLanguagesInSerie($serie); ?> </p>
                        <p><span>Subtitulos:</span> <?=SerieController::findLanguagesSubtitulosInSerie($serie);  ?></p>
                        <button class="button-primary">
                            <i class="fa-solid fa-play"></i>
                            <a href="<?= base_url ?>Home/serieDetail&id=<?= $serie->getId(); ?>" style="text-decoration:none; color: white">Ver más</a>
                        </button>
                    </div>
                </article>
            <?php endforeach; ?>


        </section>
    </section>
</main>
