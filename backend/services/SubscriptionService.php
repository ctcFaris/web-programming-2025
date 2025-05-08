<?php
require_once __DIR__ . '/../dao/SubscriptionDao.php';
require_once 'BaseService.php';

class SubscriptionService extends BaseService {
    public function __construct() {
        $dao = new SubscriptionDao();
        parent::__construct($dao);
    }

    // Ensure subscription price is positive
    public function createSubscription($data) {
        if (!isset($data['price']) || $data['price'] <= 0) {
            throw new Exception('Subscription price must be a positive number.');
        }
        return $this->create($data);
    }

    public function getAllSubscriptions() {
        return $this->getAll();
    }

    public function getSubscriptionById($subscription_id) {
        return $this->getById($subscription_id);
    }

    public function getSubscriptionByName($name) {
        return $this->dao->getSubscriptionByName($name);
    }

    public function updateSubscription($subscription_id, $data) {
        return $this->update($subscription_id, $data);
    }

    public function deleteSubscription($subscription_id) {
        return $this->delete($subscription_id);
    }
}
?>
