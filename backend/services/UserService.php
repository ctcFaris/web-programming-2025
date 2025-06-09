<?php
require_once __DIR__ . '/../dao/UserDao.php';
require_once 'BaseService.php';

class UserService extends BaseService {
    public function __construct() {
        $dao = new UserDao();
        parent::__construct($dao);
    }
 
    // Check if email format is valid before creating a user
    public function createUser($data) {
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Invalid email address.');
        }
        return $this->create($data);
    }

    public function getAllUsers() {
        return $this->getAll();
    }

    public function getUserById($user_id) {
        return $this->getById($user_id);
    }

    public function getByEmail($email) {
        return $this->dao->getByEmail($email);
    }

    public function updateUser($user_id, $data) {
        return $this->update($user_id, $data);
    }

    public function deleteUser($user_id) {
        return $this->delete($user_id);
    }
}
?>
