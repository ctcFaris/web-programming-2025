<?php
require_once __DIR__ . '/BaseDao.php';

class AuthDao extends BaseDao {
    public function __construct() {
        // Pass both the table name and the primary key column name to BaseDao constructor
        parent::__construct("users", "user_id");
    }

    // You already have get_user_by_email implemented via BaseDao's connection
    public function get_user_by_email($email) {
        $stmt = $this->connection->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch();
    }
}
?>
