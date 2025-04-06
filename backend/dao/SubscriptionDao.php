<?php
require_once 'BaseDao.php';

class SubscriptionDao extends BaseDao {
    public function __construct() {
        parent::__construct("Subscriptions", "subscription_id");
    }

   
    public function createSubscription($data) {
        return $this->insert($data);
    }

    
    public function getAllSubscriptions() {
        return $this->getAll();
    }

    
    public function getSubscriptionById($subscription_id) {
        return $this->getById($subscription_id);
    }

   
    public function getSubscriptionByName($name) {
        $stmt = $this->connection->prepare("SELECT * FROM Subscriptions WHERE name = :name");
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        return $stmt->fetch();
    }

   
    public function updateSubscription($subscription_id, $data) {
        return $this->update($subscription_id, $data);
    }

    
    public function deleteSubscription($subscription_id) {
        return $this->delete($subscription_id);
    }
}
?>
