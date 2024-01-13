<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=base_url?>/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Detalles serie</title>
</head>
<body>


<main class="container center-element">
    <div class="serie-details">
        <div class="serie-img">
            <img src="<?= $serieFoundIt->getSerieImg(); ?>" alt="imagen de la serie">
        </div>
        <div class="info-container">
                <span>
                    <h2>Título: </h2><?=$serieFoundIt->getName();?>
                </span>
            <span>
                    <h2>Subtítulos: </h2>
                    <?php foreach ($serieFoundIt->getLanguagesSubtitulos() as $l ) : ?>
                      <?= $l->getName();?>
                    <?php endforeach; ?>
                </span>
            <span>
                    <h2> Director: </h2><?=$serieFoundIt->getDirector()->getName() ." ".$serieFoundIt->getDirector()->getSurname() ;?>
                </span>
            <span>
                    <h2>Actores: </h2>
                    <?php foreach ($serieFoundIt->getActors() as $a ) : ?>
                      <?= $a->getName() ." ". $a->getSurname();?>
                    <?php endforeach; ?>
                </span>
            <span>
                    <h2>Plataforma: </h2><?=$serieFoundIt->getPlatform()->getName();?>
                </span>
            <span>
                    <h2>Idiomas: </h2>
                    <?php foreach ($serieFoundIt->getLanguages() as $l ) : ?>
                      <?= $l->getName();?>
                    <?php endforeach; ?>
                </span>

            <span>
                    <h2>Review: </h2><?=$serieFoundIt->getReview();?>
                </span>
        </div>
    </div>
</main>