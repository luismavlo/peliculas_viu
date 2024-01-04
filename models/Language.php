<?php
class Language
{
    private readonly string $id;
    private readonly string $name;
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
}