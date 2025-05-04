<?php
require_once __DIR__ . '/../dao/ContactMeDao.php';
require_once 'BaseService.php';

class ContactMeService extends BaseService {
    public function __construct() {
        $dao = new ContactMeDao();
        parent::__construct($dao);
    }

    // Ensure message content is not empty
    public function createMessage($data) {
        if (empty($data['message'])) {
            throw new Exception('Message content cannot be empty.');
        }
        return $this->create($data);
    }

    public function getAllMessages() {
        return $this->getAll();
    }

    public function getMessageById($contactId) {
        return $this->getById($contactId);
    }

    public function getMessagesByUserId($userId) {
        return $this->dao->getMessagesByUserId($userId);
    }

    public function updateMessage($contactId, $data) {
        return $this->update($contactId, $data);
    }

    public function deleteMessage($contactId) {
        return $this->delete($contactId);
    }
}
?>
