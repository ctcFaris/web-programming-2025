<?php
require_once 'BaseDao.php';

class PaymentDao extends BaseDao {
    public function __construct() {
        parent::__construct("Payments", "payment_id");
    }

    public function createPayment($data) {
        return $this->insert($data);
    }

   
    public function getAllPayments() {
        return $this->getAll();
    }

  
    public function getPaymentById($paymentId) {
        return $this->getById($paymentId);
    }

    public function updatePayment($paymentId, $data) {
        return $this->update($paymentId, $data);
    }


    public function deletePayment($paymentId) {
        return $this->delete($paymentId);
    }
}
?>