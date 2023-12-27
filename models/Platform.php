<?php
class Platform
{
    private readonly string $id;
    private readonly string $name;
    private readonly string $image;
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

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): void
    {
        $this->image = $this->db->real_escape_string($image);
    }

    public function save(): bool
    {
        $sql = "INSERT INTO platform VALUES(NULL, '{$this->getName()}', '{$this->getImage()}')";
        $plaform = $this->db->query($sql);

        if(!$plaform) {
            return false;
        }
        return true;
    }

    public function findAll()
    {
        return $this->db->query("SELECT * FROM platform");
    }
}