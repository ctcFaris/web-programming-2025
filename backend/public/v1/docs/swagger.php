<?php
// 1) Suppress non-fatal PHP warnings
ini_set('display_errors', 0);
error_reporting(E_ERROR);

// 2) Load Composer
require __DIR__ . '/../../../../vendor/autoload.php';

// 3) BASE_URL (for @OA\Server)
if ($_SERVER['SERVER_NAME'] === 'localhost') {
    define('BASE_URL', 'http://localhost/web-programming-2025/web-programming-2025/backend');
} else {
    define('BASE_URL', 'https://your-production-domain/backend');
}

// 4) Scan your doc_setup + all route files with correct paths
$openapi = \OpenApi\Generator::scan([
    __DIR__ . '/doc_setup.php',
    __DIR__ . '/../../../routes/ContactMeRoutes.php',
    __DIR__ . '/../../../routes/CourseRoutes.php',
    __DIR__ . '/../../../routes/LocationCoursesRoutes.php',
    __DIR__ . '/../../../routes/LocationRoutes.php',
    __DIR__ . '/../../../routes/PaymentRoutes.php',
    __DIR__ . '/../../../routes/SubscriptionRoutes.php',
    __DIR__ . '/../../../routes/UserRoutes.php',
]);

// 5) Return valid JSON
header('Content-Type: application/json');
echo $openapi->toJson();
