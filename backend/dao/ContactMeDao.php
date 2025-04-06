<?php
require_once 'BaseDao.php';

class ContactMeDao extends BaseDao {
    public function __construct() {
        parent::__construct("ContactMe", "contact_id");
    }

   
    public function createMessage($data) {
        return $this->insert($data);
    }

    public function getAllMessages() {
        return $this->getAll();
    }

  
    public function getMessageById($contactId) {
        return $this->getById($contactId);
    }


    public function getMessagesByUserId($userId) {
        $stmt = $this->connection->prepare("SELECT * FROM ContactMe WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        return $stmt->fetchAll();
    }

   
    public function updateMessage($contactId, $data) {
        return $this->update($contactId, $data);
    }

   
    public function deleteMessage($contactId) {
        return $this->delete($contactId);
    }
}
?>
