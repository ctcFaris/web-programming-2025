<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/Database.php';


class BaseDao {
   protected $table;
   protected $connection;
   protected $primaryKey;

   public function __construct($table, $primaryKey) {
       $this->table = $table;
       $this->primaryKey = $primaryKey;  // Dynamically handle primary key
       $this->connection = Database::connect();
   }

   public function getAll() {
       $stmt = $this->connection->prepare("SELECT * FROM " . $this->table);
       $stmt->execute();
       return $stmt->fetchAll();
   }

   public function getById($id) {
       $stmt = $this->connection->prepare("SELECT * FROM " . $this->table . " WHERE " . $this->primaryKey . " = :id");
       $stmt->bindParam(':id', $id);
       $stmt->execute();
       return $stmt->fetch();
   }

   public function insert($data) {
       $columns = implode(", ", array_keys($data));
       $placeholders = ":" . implode(", :", array_keys($data));
       $sql = "INSERT INTO " . $this->table . " ($columns) VALUES ($placeholders)";
       $stmt = $this->connection->prepare($sql);
       return $stmt->execute($data);
   }

   public function update($id, $data) {
       $fields = "";
       foreach ($data as $key => $value) {
           $fields .= "$key = :$key, ";
       }
       $fields = rtrim($fields, ", ");
       $sql = "UPDATE " . $this->table . " SET $fields WHERE " . $this->primaryKey . " = :id";
       $stmt = $this->connection->prepare($sql);
       $data['id'] = $id;
       return $stmt->execute($data);
   }

   public function delete($id) {
       $stmt = $this->connection->prepare("DELETE FROM " . $this->table . " WHERE " . $this->primaryKey . " = :id");
       $stmt->bindParam(':id', $id);
       return $stmt->execute();
   }
}
?>
