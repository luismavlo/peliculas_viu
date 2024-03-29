<?php
class Serie
{
    private readonly string $id;
    private readonly string $name;

    private readonly string $serieImg;
    private Platform $platform;
    private readonly string $review;
    private Director $director;
    private ArrayObject $actors;
    private ArrayObject $languages;
    private ArrayObject $languagesSubtitulos;
    

    public function __construct()
    {
        $this->db = Database::connect();
        $this->platform=new Platform();
        $this->director=new Director();
        $this->actors=new ArrayObject();
        $this->languages=new ArrayObject();
        $this->languagesSubtitulos=new ArrayObject();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $this->db->real_escape_string($name);
    }

    public function getPlatformId(): string
    {
        return $this->platform->getName();
    }
    public function getPlatform(): Platform
    {
        return $this->platform;
    }

    public function setPlatformId(string $idPlatform): void
    {
        $p=new Platform();
        $p=$p->findPlatform($idPlatform);
        $this->platform=$p;
            
    }
    public function setPlatform(Platform $platform): void
    {
            $this->platform=$platform;
            
    }

    public function getReview(): string
    {
        return $this->review;
    }

    public function setReview(string $review): void
    {
        $this->review = $this->db->real_escape_string($review);
    }

    public function getActors(): ArrayObject
    {
        return $this->actors;
    }
    public function setActors(ArrayObject $a): void
    {
        $this->actors=$a;
    }

    public function getLanguages(): ArrayObject
    {
        return $this->languages;
    }
    public function setLanguages(ArrayObject $a): void
    {
        $this->languages=$a;
    }



    public function getLanguagesSubtitulos(): ArrayObject
    {
        return $this->languagesSubtitulos;
    }
    public function setLanguagesSubtitulos(ArrayObject $a): void
    {
        $this->languagesSubtitulos=$a;
    }

    public function getSerieImg(): string
    {
      return $this->serieImg;
    }

    public function setSerieImg(string $serieImgUrl)
    {
      $this->serieImg = $serieImgUrl;
    }



    public function getDirector(): Director
    {
        return $this->director;
    }
    public function setDirector(Director $d) 
    {
         $this->director=$d;
    }

    public function addActor(Actor $a){
        $this->actors->append($a);
    }

    public function addActors(Array $a){
        $i=0;
        $index_actor='';
        $actor=new Actor();

        for($i=0;$i<count($a);$i++){
            $index_actor=$a[$i];
            $actor=$actor->findActor($index_actor);
            $this->addActor($actor);
        }
        
       
    }

    public function addLanguage(Language $a){
        $this->languages->append($a);
    }

    public function addLanguagesAudio(Array $a){
        $i=0;
        $index_language='';
        $language=new Language();

        for($i=0;$i<count($a);$i++){
            $index_language=$a[$i];
            $language=$language->findLanguage($index_language);
            $this->addLanguage($language);
        }
        
       
    }
    


    public function addLanguageSubtitulo(Language $a){
        $this->languagesSubtitulos->append($a);
    }

    public function addLanguagesSubtitulos(Array $a){
        $i=0;
        $index_language='';
        $language=new Language();

        for($i=0;$i<count($a);$i++){
            $index_language=$a[$i];
            $language=$language->findLanguage($index_language);
            $this->addLanguageSubtitulo($language);
        }
        
       
    }
   


    public function findSerieIdByName(string $name): string
    {
        $sql = "SELECT * FROM serie WHERE title in ('{$name}')";
        echo $sql;
        $sql=$this->db->query($sql);
        $id=$sql->fetch_object()->id;
        return $id;
    }
    public function save(): string
    {
        $sql = "INSERT INTO serie VALUES(NULL, '{$this->getName()}','{$this->getSerieImg()}','{$this->getPlatform()->getId()}' , '{$this->getReview()}')";
       
        $serie = $this->db->query($sql);
        $id=0;
      
       
        if(!$serie) {
            return '0';
        }
        return $sql;
    }

    public function findAll(): ArrayObject
    {
        $allSeries=new ArrayObject();
        $all= $this->db->query("SELECT * FROM serie");
        $serie=new Serie();
        while ($s=$all->fetch_object()):
            $serie= $serie->convertToSerie($s);
            $allSeries->append($serie);
        endwhile;
        return $allSeries;
    }
   

    public function update(): bool
    {
      
        $sql = "UPDATE serie SET title = '{$this->getName()}', review = '{$this->getReview()}' WHERE id={$this->getId()}";
       
        $serie = $this->db->query($sql);
     
        if(!$serie) {
            return false;
        }
        return true;
    }

    public function delete()
    {
        $sql = "DELETE FROM serie WHERE id={$this->id}";
        $serie = $this->db->query($sql);

        if(!$serie) {
            return false;
        }
        return true;
    }
    function convertToSerie(Object $s):Serie{
        $serie=new Serie();
        $serie->setId($s->id);
        $serie->setName($s->title);
        $serie->setSerieImg($s->serie_img);
        $serie->setReview($s->review);
        $p=$serie->getPlatform();
        $p=$p->findPlatform($s->platform_id);
        $serie->setPlatform($p);
        $serie->setActors($serie->findActorsOfSerie($s->id));
        $serie->setLanguages($serie->findLanguagesOfSerie($s->id));
        $serie->setLanguagesSubtitulos($serie->findLanguagesSubtitulosOfSerie($s->id));
        $serie->setDirector($serie->findDirectorOfSerie($s->id));
        return $serie;
    
    }
    public function findOne()
    {   $serie = $this->db->query("SELECT * FROM serie WHERE id = {$this->getId()}");
        return $serie->fetch_object();
    }

    public function findSerie(string $id): Serie{
        $serie=new Serie();
        $actorsList= new ArrayObject();
        $director = new Director;
        $s = $this->db->query("SELECT * FROM serie WHERE id = {$id}");
        $s=$s->fetch_object();
        $serie=$serie->convertToSerie($s);
        $actorsList=$serie->findActorsOfSerie($id);
        $serie->setActors($actorsList);
        $director=$serie->findDirectorOfSerie($id);
        $serie->setDirector($director);
         
        return $serie;
    }

    public function findActorsOfSerie(string $id): ArrayObject{
        $actorsList=new ArrayObject();
        $i=0;
        $actors=$this->db->query("SELECT * FROM actuacion WHERE serie_id = {$id}");
        while($actor=$actors->fetch_object()):
            $a=$this->db->query("SELECT * FROM actor WHERE id = {$actor->actor_id}");
            $actor=new Actor();
            $a=$a->fetch_object();
            $actor=$actor->convertToActor($a);
            $actorsList->append($actor);
        endwhile;
        return $actorsList;
    }

    public function findLanguagesOfSerie(string $id): ArrayObject{
        $languagesList=new ArrayObject();
        $i=0;
        $languages=$this->db->query("SELECT * FROM audio_languages WHERE serie_id = {$id}");
        while($language=$languages->fetch_object()):
            $a=$this->db->query("SELECT * FROM language WHERE id = {$language->language_id}");
            $language=new Language();
            $a=$a->fetch_object();
            $language=$language->convertToLanguage($a);
            $languagesList->append($language);
        endwhile;
        return $languagesList;
    }



    public function findLanguagesSubtitulosOfSerie(string $id): ArrayObject{
        $languagesList=new ArrayObject();
        $i=0;
        $languages=$this->db->query("SELECT * FROM subtitles_languages WHERE serie_id = {$id}");
        while($language=$languages->fetch_object()):
            $a=$this->db->query("SELECT * FROM language WHERE id = {$language->language_id}");
            $language=new Language();
            $a=$a->fetch_object();
            $language=$language->convertToLanguage($a);
            $languagesList->append($language);
        endwhile;
        return $languagesList;
    }


    public function saveLanguageAudio(): bool
    {
       $i=0;
       $languagesList=$this->getLanguages();
       $languages_audios =new ArrayObject();
       
        for($i=0;$i<$languagesList->count();$i++){
            $sql = "INSERT INTO audio_languages VALUES('{$this->getId()}','{$this->languages->offsetGet($i)->getId()}')";
            echo $sql;
            $languages_audios->append( $this->db->query($sql));
        }
        $i=0;
        while($i<$languages_audios->count()):
            $languages_audio= $languages_audios->offsetGet($i);
            if(!$languages_audio) {
                return false;
        }
        $i++;;
        endwhile;
        return true;
   
    }  



    public function saveLanguageSubtitulo(): bool
    {
       $i=0;
       $languagesList=$this->getLanguagesSubtitulos();
       $languages_subtitulos =new ArrayObject();
       
        for($i=0;$i<$languagesList->count();$i++){
            $sql = "INSERT INTO subtitles_languages VALUES('{$this->getId()}','{$this->languagesSubtitulos->offsetGet($i)->getId()}')";
            echo $sql;
            $languages_subtitulos->append( $this->db->query($sql));
        }
        $i=0;
        while($i<$languages_subtitulos->count()):
            $languages_subtitulo= $languages_subtitulos->offsetGet($i);
            if(!$languages_subtitulo) {
                return false;
        }
        $i++;;
        endwhile;
        return true;
   
    }  


    public function savePerformance(): bool
    {
       $i=0;
       $actorsList=$this->getActors();
       $performances =new ArrayObject();
       
        for($i=0;$i<$actorsList->count();$i++){
            $sql = "INSERT INTO actuacion VALUES('{$this->getId()}','{$this->actors->offsetGet($i)->getId()}')";
            echo $sql;
            $performances->append( $this->db->query($sql));
        }
        $i=0;
        while($i<$performances->count()):
            $performance= $performances->offsetGet($i);
            if(!$performance) {
                return false;
        }
        $i++;;
        endwhile;
        return true;
   
    }  



    public function saveDirect(): bool
    {
        $sql = "INSERT INTO direccion VALUES( '{$this->director->getId()}', '{$this->getId()}')";
       return $this->db->query($sql);
    }

    public function findDirectorOfSerie(string $id): Director{
        $d=new Director();
        $sql=$this->db->query("SELECT * FROM direccion WHERE serie_id = {$id}");

        $sql=$sql->fetch_object();
        $director_id=$sql->director_id;
        $sql=$this->db->query("SELECT * FROM director WHERE id = {$director_id}");
        $director=$sql->fetch_object();
        $d=$d->convertToDirector($director);


        return $d;
    }
        
}
       

       
   
    
