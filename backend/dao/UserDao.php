<?php
require_once 'BaseDao.php';

class UserDao extends BaseDao {
    public function __construct() {
        parent::__construct("Users", "user_id");
    }

    public function createUser($data) {
        return $this->insert($data);
    }

   
    public function getAllUsers() {
        return $this->getAll();
    }

    public function getUserById($user_id) {
        return $this->getById($user_id);
    }


    public function getByEmail($email) {
        $stmt = $this->connection->prepare("SELECT * FROM Users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch();
    }


    public function updateUser($user_id, $data) {
        return $this->update($user_id, $data);
    }

    public function deleteUser($user_id) {
        return $this->delete($user_id);
    }
}
?>
