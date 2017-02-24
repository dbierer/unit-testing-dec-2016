<?php

class User
{
    protected $db;

    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    public function getAll()
    {
        $stmt = $this->db->prepare('SELECT * FROM users');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getAllActive()
    {
        $rows = $this->getAll();
        $active = [];

        foreach ($rows as $row) {
            if ($row['is_active'] == 1) {
                $active[] = ['id' => $row['id'], 'email' => $row['email']];
            }
        }

        return $active;
    }
}
