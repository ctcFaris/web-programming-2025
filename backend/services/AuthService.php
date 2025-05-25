<?php
require_once 'BaseService.php';
require_once __DIR__ . '/../dao/AuthDao.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthService extends BaseService {
    private $auth_dao;

    public function __construct() {
        $this->auth_dao = new AuthDao();
        parent::__construct($this->auth_dao);
    }

    public function get_user_by_email($email) {
        return $this->auth_dao->get_user_by_email($email);
    }

    public function register($entity) {
    if (empty($entity['email']) || empty($entity['password'])) {
        return ['success' => false, 'error' => 'Email and password are required.'];
    }

    $email_exists = $this->auth_dao->get_user_by_email($entity['email']);
    if ($email_exists) {
        return ['success' => false, 'error' => 'Email already registered.'];
    }

    // Hash password into password_hash field for DB
    $entity['password_hash'] = password_hash($entity['password'], PASSWORD_BCRYPT);
    unset($entity['password']); // Remove plaintext password

    // Insert user and get inserted ID
    $inserted_id = parent::create($entity);

    if ($inserted_id) {
        // Fetch the full user by ID
        $created_user = $this->auth_dao->getById($inserted_id);
        if ($created_user) {
            unset($created_user['password_hash']); // Hide hash in response
            return ['success' => true, 'data' => $created_user];
        } else {
            return ['success' => false, 'error' => 'Failed to retrieve created user.'];
        }
    } else {
        return ['success' => false, 'error' => 'Registration failed.'];
    }
}


    public function login($entity) {
        if (empty($entity['email']) || empty($entity['password'])) {
            return ['success' => false, 'error' => 'Email and password are required.'];
        }

        $user = $this->auth_dao->get_user_by_email($entity['email']);

        if (!$user || !password_verify($entity['password'], $user['password_hash'])) {
            return ['success' => false, 'error' => 'Invalid email or password.'];
        }

        unset($user['password_hash']);

        $jwt_payload = [
            'user' => $user,
            'iat' => time(),
            'exp' => time() + (60 * 60 * 24) // 24 hours
        ];

        $token = JWT::encode(
            $jwt_payload,
            Config::JWT_SECRET(),
            'HS256'
        );

        return ['success' => true, 'data' => array_merge($user, ['token' => $token])];
    }
}
