<?php

// Autoload dependencies using Composer
require __DIR__ . '/../vendor/autoload.php';

// Manually include service files
require_once __DIR__ . '/services/UserService.php';
require_once __DIR__ . '/services/CourseService.php';
require_once __DIR__ . '/services/LocationService.php';
require_once __DIR__ . '/services/SubscriptionService.php';
require_once __DIR__ . '/services/PaymentService.php';
require_once __DIR__ . '/services/ContactMeService.php';
require_once __DIR__ . '/services/LocationCoursesService.php';
require_once __DIR__ . '/services/AuthService.php';
require_once __DIR__ . '/middleware/AuthMiddleware.php'; // ✅ Include AuthMiddleware

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// Optional: Enable CORS for frontend-backend communication
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authentication");

// Register services
Flight::register('courseService', 'CourseService');
Flight::register('userService', 'UserService');
Flight::register('locationService', 'LocationService');
Flight::register('subscriptionService', 'SubscriptionService');
Flight::register('paymentService', 'PaymentService');
Flight::register('contactMeService', 'ContactMeService');
Flight::register('locationCoursesService', 'LocationCoursesService');
Flight::register('auth_service', 'AuthService');
Flight::register('auth_middleware', 'AuthMiddleware'); // ✅ Register middleware

// Apply global middleware
Flight::route('/*', function () {
    $url = Flight::request()->url;

    // Allow public access for root, login, and register routes
    if (
        $url === '/' ||
        strpos($url, '/auth/login') === 0 ||
        strpos($url, '/auth/register') === 0
    ) {
        return TRUE;
    }

    try {
        $token = Flight::request()->getHeader("Authentication");
        Flight::auth_middleware()->verifyToken($token); // ✅ Use middleware method
        return TRUE;
    } catch (Exception $e) {
        Flight::halt(401, $e->getMessage());
    }
});

// Load route files
require_once __DIR__ . '/routes/UserRoutes.php';
require_once __DIR__ . '/routes/CourseRoutes.php';
require_once __DIR__ . '/routes/LocationRoutes.php';
require_once __DIR__ . '/routes/SubscriptionRoutes.php';
require_once __DIR__ . '/routes/PaymentRoutes.php';
require_once __DIR__ . '/routes/ContactMeRoutes.php';
require_once __DIR__ . '/routes/LocationCoursesRoutes.php';
require_once __DIR__ . '/routes/AuthRoutes.php';

// Default route
Flight::route('/', function () {
    echo 'API is running';
});

// Start Flight
Flight::start();

?>
