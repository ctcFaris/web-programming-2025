<?php
require_once __DIR__ . '/../dao/PaymentDao.php';
require_once 'BaseService.php';

class PaymentService extends BaseService {
    public function __construct() {
        $dao = new PaymentDao();
        parent::__construct($dao);
    }

    // Check chosen_course_subscription field is provided
    public function createPayment($data) {
        if (empty($data['chosen_course_subscription'])) {
            throw new Exception('A course or subscription name must be specified.');
        }
        return $this->create($data);
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
