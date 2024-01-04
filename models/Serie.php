<?php
class Serie
{
    private readonly string $id;
    private readonly string $name;
    private Platform $platform;
    private readonly string $review;
 //   private Director $director[];
 //   private Actor $actores[];
 //   private Languages $languages[];

    public function __construct()
    {
        $this->db = Database::connect();
        $this->platform=new Platform();
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

    public function save(): bool
    {
        $sql = "INSERT INTO serie VALUES(NULL, '{$this->getName()}', '{$this->getPlatform()->getId()}' , '{$this->getReview()}')";
        echo $sql;
        $serie = $this->db->query($sql);

        if(!$serie) {
            return false;
        }
        return true;
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
        return $serie;
    
    }
    public function findOne()
    {   $serie = $this->db->query("SELECT * FROM serie WHERE id = {$this->getId()}");
        return $serie->fetch_object();
    }

    public function findSerie(int $id): Serie{
        $serie=new Serie();
        $s = $this->db->query("SELECT * FROM serie WHERE id = {$id}");
        $s=$s->fetch_object();
        $serie=$serie->convertToSerie($s);
        return $serie;
    }
   
}