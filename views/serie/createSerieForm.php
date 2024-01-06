<?php
    if(isset($edit) && isset($serieFoundIt) && is_object($serieFoundIt)){
      
        $url_action = base_url."Serie/create&id=".$serieFoundIt->getId();
    } else {
        $url_action = base_url."Serie/create";
    }
    
    $found=isset($serieFoundIt) && is_object($serieFoundIt);
?>

<form action="<?=$url_action?>" method="POST" class="form" style=" width: 60%">
<p class="form-group">
        <label for="name">Nombre </label>
        <input type="text" name="name" required class="form-input" placeholder="Ingrese el nombre de la serie" value="<?= isset($serieFoundIt) && is_object($serieFoundIt) ? $serieFoundIt->getName() : ''; ?>" />
    </p>
 <p class="form-group">
        <label for="platform">Plataforma </label>
       <select  name="platform" >
            <?php 
                $p=new Platform();
                $allPlatforms='';
                $allPlatforms=$p->findAll();
            ?>
                <option selected="true"  value="<?= $found ? ($serieFoundIt->getPlatform()->getId()):''; ?>"> " <?= isset($serieFoundIt) && is_object($serieFoundIt) ? ($serieFoundIt->getPlatform()->getName()) : 'Seleccione la plataforma'; ?>"
                </option> 

                <?php 
                for ($i=0;$i<$allPlatforms->count();$i++){ 
                    $p=$allPlatforms->offsetGet($i)?>
                    <option value=<?=$p->getId(); ?> > "<?=$p->getName(); ?>"</option>  
                        <?php }   ?>   
     
        </select>

</p>

<p class="form-group">
        <label for="actors[]">Actores y Actrices </label>
       <select  name="actors[]" multiple>
            <?php
             
                $a=new Actor();
                $allActors='';
                
                $allActors=$a->findAllActors();
               
               
                $actorsOfSerie=new ArrayObject();
                if($found){
                    $actorsOfSerie=$serieFoundIt->getActors();
                }
                $a->printActors($actorsOfSerie);
                $i=0;
                
             
                for ($i=0;$i<$actorsOfSerie->count();$i++){ 
                    $a=$actorsOfSerie->offsetGet($i) ;
                    $nameandsurname=$a->getName().' '.$a->getSurname();
                    echo $nameandsurname;
                ?>                   
                    
                    <option selected="true" value=<?= $found ? ($a->getId()):''; ?>> 
                    " <?= $found ? $nameandsurname  : 'Seleccione el actor o la actriz'; ?>"
                    </option> 

                <?php    }?>

                <?php
                for ($i=0;$i<$allActors->count();$i++){ 
                    $a=$allActors->offsetGet($i);
                ?>
                    <option name="actors[]" value=<?=$a->getId();?>> "<?=$a->getName().' ' .$a->getSurname(); ?>"</option>  
                <?php    }   ?>   
     
        </select>

</p>

<p class="form-group">
        <label for="director">Director </label>
       <select  name="director" >
            <?php 
                $d=new Director();
                $allDirectors='';
                $allDirectors=$d->findAllDirectors();
                echo $allDirectors->count();
           
               
            ?>
                <option selected="true"  value="<?= $found ? ($serieFoundIt->getDirector()->getId()):''; ?>"> " 
                <?= $found ? ($serieFoundIt->getDirector()->getName().' '.$serieFoundIt->getDirector()->getSurname()) : 'Seleccione el director'; ?>"
                </option> 

                <?php
                for ($i=0;$i<$allDirectors->count();$i++){ 
                    $a=$allDirectors->offsetGet($i);
                ?>
                    <option name="director" value=<?=$a->getId();?>> "<?=$a->getName().' ' .$a->getSurname(); ?>"</option>  
                <?php    }   ?>   


     
        </select>

</p>

    <p class="form-group">
        <fieldset>
            <legend>Review </legend>

            <?php 
            $greatseries='';
            $comedy='';
            $drama='';
            
            if(isset($serieFoundIt) && is_object($serieFoundIt) ){
                
                $reviews=$serieFoundIt->getReview();
                
                if(str_contains($reviews,"Great series!")) {
                    $greatseries = "checked";
                }
                if(str_contains($reviews,"Comedy")) {
                    $comedy = "checked";
                }
                if(str_contains($reviews,"Drama")) {
                    $drama = "checked";
                }
            }
            
            ?>

            <div>
                <input type="checkbox" id="greatseries" name="review[]"  value="Great series!" <?="$greatseries" ;?>>
                <label for="greatseries">Great Series! </label>
            </div>
            <div>
                <input type="checkbox" id="comedy" name="review[]"  value="Comedy" <?="$comedy" ;?>>
                <label for="comedy">Comedy </label>
            </div>
            <div>
                <input type="checkbox" id= "drama" name="review[]"  value="Drama" <?="$drama" ;?>>
                <label for="drama">Drama </label>
            </div> 
        </fieldset>
    </p>
    <p>
        <br>
        <input type="submit" value="Crear Serie" class="button-dashboard-primary">
        <br>
    </p>
</form>
