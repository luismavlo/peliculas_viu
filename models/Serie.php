<?php
class Serie
{
    private readonly string $id;
    private readonly string $name;
    private Platform $platform;
    private readonly string $review;
    private Director $director;
    private ArrayObject $actors;
    private ArrayObject $languages;
    

    public function __construct()
    {
        $this->db = Database::connect();
        $this->platform=new Platform();
        $this->director=new Director();
        $this->actors=new ArrayObject();
        $this->languages=new ArrayObject();
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
    
    public function findId(string $name): string
    {
        $sql = "SELECT * FROM serie WHERE title in ('{$name}')";
        echo $sql;
        $sql=$this->db->query($sql);
        $id=$sql->fetch_object()->id;
        return $id;
    }
    public function save(): string
    {
        $sql = "INSERT INTO serie VALUES(NULL, '{$this->getName()}', '{$this->getPlatform()->getId()}' , '{$this->getReview()}')";
       
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
      
        $sql = "UPDATE serie SET title = '{$this->getName()}', platform_id = '{$this->getPlatform()->getId()}', review = '{$this->getReview()}' WHERE id={$this->getId()}";
       
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
        $serie->setReview($s->review);
        $p=$serie->getPlatform();
        $p=$p->findPlatform($s->platform_id);
        $serie->setPlatform($p);
        $serie->setActors($serie->findActorsOfSerie($s->id));
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
        $actorsList=$serie->findDirectorOfSerie($id);
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
        $director=new Director();
        $d=new Director();
        $i=0;
        $sql=$this->db->query("SELECT * FROM direccion WHERE serie_id = {$id}");
       
        $sql=$sql->fetch_object();
        $director_id=$sql->director_id;
        $sql=$this->db->query("SELECT * FROM director WHERE id = {$director_id}");
        $director=$sql->fetch_object();
        $d=$d->convertToDirector($director);
      
        
        return $d;
    }
        
}
       

       
   
    
