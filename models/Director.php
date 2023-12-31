<?php
class Director
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
        $sql = "INSERT INTO director VALUES(NULL, '{$this->getName()}', '{$this->getSurname()}', '{$this->getBirthDate()}', '{$this->getNationality()}')";
        $director = $this->db->query($sql);

        if(!$director) {
            return false;
        }
        return true;
    }

     public function findAll()
    {
        return $this->db->query("select * from director");
    }


    public function update(): bool
    {
        $sql = "UPDATE director SET name = '{$this->getName()}', surname = '{$this->getSurname()}', birthdate = '{$this->getBirthDate()}', nationality = '{$this->getNationality()}' WHERE id={$this->getId()}";
        $director = $this->db->query($sql);

        if(!$director) {
            return false;
        }
        return true;
    }

    public function delete()
    {
        $sql = "DELETE FROM director WHERE id={$this->id}";
        $director = $this->db->query($sql);

        if(!$director) {
            return false;
        }
        return true;
    }

    public function findOne()
    {
        $director = $this->db->query("SELECT * FROM director WHERE id = {$this->getId()}");
        return $director->fetch_object();
    }

  public function convertToDirector(object $directorData): Director {
    $director = new Director();
    $director->setId($directorData->id ?? null);
    $director->setName($directorData->name ?? '');
    $director->setSurname($directorData->surname ?? '');
    $director->setBirthDate($directorData->birthdate ?? null);
    $director->setNationality($directorData->nationality ?? '');

    return $director;
  }
    
    public function findAllDirectors() : ArrayObject
    {

        $allDirectors=new ArrayObject();
        $all= $this->db->query("SELECT * FROM director");
        $director=new Director();
        while ($a=$all->fetch_object()):
            $director= $director->convertToDirector($a);
            $allDirectors->append($director);
        endwhile;
        return $allDirectors;
    }
    public function findDirector(int $directorId):Director
    {
        $director= new Director();
        $directorFoundId = $this->db->query("SELECT * FROM director WHERE id = {$directorId}");
        $directorFoundId= $directorFoundId->fetch_object();
        return $director->convertToDirector($directorFoundId);
    }




}