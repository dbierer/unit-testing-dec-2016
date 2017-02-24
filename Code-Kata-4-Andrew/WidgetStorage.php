<?php

class WidgetStorage
{
    protected $db;

    /**
     * @param PDO $db
     */
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    /**
     * Stores info in local database
     *
     * @param array $data
     * @param int $rowsAffected = # rows affected
     */
    public function save($data)
    {
        $result = FALSE;
        try {
            $stmt = $this->db->prepare(
                'INSERT INTO widgettracker (widget, price, date) VALUES(:widget, :price, :date)');
            $stmt->bindParam(':widget', $data['widget']);
            $stmt->bindParam(':price', $data['price']);
            $stmt->bindParam(':date', $data['date']);
            $result = $stmt->execute();
        } catch (PDOException $e) {
            error_log(__METHOD__ . ':' . $e->getMessage());
        }
        return $result;
    }

    /**
     * Retrieve information from the local database
     *
     * @param string $name = name of widget
     * @param string $date = date info
     * @return array $row
     */
    public function getByNameAndDate($name, $date)
    {
        $stmt = $this->db->prepare("SELECT * FROM widgettracker WHERE name = :name and date = :date");
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":date", $date);
        $stmt->execute();
        return $stmt->fetch();
    }
}
