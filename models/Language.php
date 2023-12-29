<?php
class Language
{
    private readonly string $id;
    private readonly string $name;
    private readonly string $isoCode;
   
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


    public function getIsoCode(): string
    {
        return $this->isoCode;
    }

    public function setIsoCode(string $isoCode): void
    {
        $this->isoCode = $this->db->real_escape_string($isoCode);
    }


    public function save(): bool
    {
        $sql = "INSERT INTO language VALUES(NULL, '{$this->getName()}', '{$this->getIsoCode()}')";
        $language = $this->db->query($sql);

        if(!$language) {
            return false;
        }
        return true;
    }

     public function findAll()
    {
        return $this->db->query("select * from language");
    }


    public function update(): bool
    {
        $sql = "UPDATE language SET name = '{$this->getName()}', ISO_code = '{$this->getIsoCode()}' WHERE id={$this->getId()}";
        $language = $this->db->query($sql);

        if(!$language) {
            return false;
        }
        return true;
    }

    public function delete()
    {
        $sql = "DELETE FROM language WHERE id={$this->id}";
        $language = $this->db->query($sql);

        if(!$language) {
            return false;
        }
        return true;
    }

    public function findOne()
    {
        $language = $this->db->query("SELECT * FROM language WHERE id = {$this->getId()}");
        return $language->fetch_object();
    }


}