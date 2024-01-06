<?php
class Actor
{
    private readonly string $id;
    private readonly string $name;
    private readonly string $surname;
    private readonly string $birthdate;
    private readonly string $nationality;
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
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


    public function getSurname(): string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): void
    {
        $this->surname = $this->db->real_escape_string($surname);
    }


    public function getBirthDate(): string
    {
        return $this->birthdate;
    }

    public function setBirthDate(string $birthdate): void
    {
        $this->birthdate = $this->db->real_escape_string($birthdate);
    }


    public function getNationality(): string
    {
        return $this->nationality;
    }

    public function setNationality(string $nationality): void
    {
        $this->nationality = $this->db->real_escape_string($nationality);
    }

    public function save(): bool
    {
        $sql = "INSERT INTO actor VALUES(NULL, '{$this->getName()}', '{$this->getSurname()}', '{$this->getBirthDate()}', '{$this->getNationality()}')";
        $actor = $this->db->query($sql);

        if(!$actor) {
            return false;
        }
        return true;
    }

     public function findAll()
    {
        return $this->db->query("select * from actor");
    }


    public function update(): bool
    {
        $sql = "UPDATE actor SET name = '{$this->getName()}', surname = '{$this->getSurname()}', birthdate = '{$this->getBirthDate()}', nationality = '{$this->getNationality()}' WHERE id={$this->getId()}";
        $director = $this->db->query($sql);

        if(!$director) {
            return false;
        }
        return true;
    }

    public function delete()
    {
        $sql = "DELETE FROM actor WHERE id={$this->id}";
        $actor = $this->db->query($sql);

        if(!$actor) {
            return false;
        }
        return true;
    }

    public function findOne()
    {
        $actor = $this->db->query("SELECT * FROM actor WHERE id = {$this->getId()}");
        return $actor->fetch_object();
    }

    function convertToActor(Object $a):Actor{
        $actor=new Actor();
        $actor->setId($a->id);
        $actor->setName($a->name);
        $actor->setSurname($a->surname);
        $actor->setBirthDate($a->birthdate);
        $actor->setNationality($a->nationality);
        return $actor;
    
    }
    public function findAllActors() : ArrayObject
    {
        $allActors=new ArrayObject();
        $all= $this->db->query("SELECT * FROM actor");
        $actor=new Actor();
        while ($a=$all->fetch_object()):
            $actor= $actor->convertToActor($a);
            $allActors->append($actor);
        endwhile;
        return $allActors;
    }
    public function findActor(string $i):Actor
    {
        $actor=new Actor();
        $a = $this->db->query("SELECT * FROM actor WHERE id = {$i}");
        $a=$a->fetch_object();
        $actor=$actor->convertToActor($a);
    
        return $actor;
    }
    public function printActors(ArrayObject $a): String{
       $i=0;
       $lista= [];
       for($i=0;$i<$a->count();$i++){
        array_push($lista, $a->offsetGet($i)->getName().' '.$a->offsetGet($i)->getSurname()) ;
       }
       return implode(', ', $lista);
    }


}