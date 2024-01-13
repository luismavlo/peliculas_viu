<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=base_url?>/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Series de Plataforma</title>
</head>
<body>


<main class="container center-element">
    <div class="platform-details">
        <div class="platform-img">
        <a href="<?= base_url ?>Home/serieDetail&id=<?= $serie->getId(); ?>" style="text-decoration:none; color: white"><img src="<?= $platformFoundIt->getImage(); ?>" alt="imagen de la plataforma"></a>
        <section class="series">    
        <h2>Series de la Plataforma <?= $platformFoundIt->getName(); ?> :</h2>
           
           
            <section class="series__content">
            <?php 
            foreach($seriesList as $serie): ?>
             <article class="series__card">
                <h2> <?=$serie->getName();?></h2><br>
                <img src="<?=$serie->getSerieImg();?>" alt="imagen de la serie">
            </article>
           <?php endforeach;        ?>
            </section>
            </section>
        </div>
    </div>
</main>