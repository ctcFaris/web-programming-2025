<?php

// Autoload dependencies using Composer
require __DIR__ . '/../vendor/autoload.php';

// Manually include service files (if not using namespaces)
require_once __DIR__ . '/services/UserService.php';
require_once __DIR__ . '/services/CourseService.php';
require_once __DIR__ . '/services/LocationService.php';
require_once __DIR__ . '/services/SubscriptionService.php';
require_once __DIR__ . '/services/PaymentService.php';
require_once __DIR__ . '/services/ContactMeService.php';
require_once __DIR__ . '/services/LocationCoursesService.php';

// Optional: Enable CORS for frontend-backend communication
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Register services with Flight
Flight::register('courseService', 'CourseService');
Flight::register('userService', 'UserService');
Flight::register('locationService', 'LocationService');
Flight::register('subscriptionService', 'SubscriptionService');
Flight::register('paymentService', 'PaymentService');
Flight::register('contactMeService', 'ContactMeService');
Flight::register('locationCoursesService', 'LocationCoursesService');

// Load route files
require_once __DIR__ . '/routes/UserRoutes.php';
require_once __DIR__ . '/routes/CourseRoutes.php';
require_once __DIR__ . '/routes/LocationRoutes.php';
require_once __DIR__ . '/routes/SubscriptionRoutes.php';
require_once __DIR__ . '/routes/PaymentRoutes.php';
require_once __DIR__ . '/routes/ContactMeRoutes.php';
require_once __DIR__ . '/routes/LocationCoursesRoutes.php';

// Default route
Flight::route('/', function() {
    echo 'API is running';
});

// Start Flight
Flight::start();
?>
