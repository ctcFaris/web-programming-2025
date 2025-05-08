<?php
require_once __DIR__ . '/services/UserService.php';
require_once __DIR__ . '/services/SubscriptionService.php';
require_once __DIR__ . '/services/PaymentService.php';
require_once __DIR__ . '/services/LocationService.php';
require_once __DIR__ . '/services/LocationCoursesService.php';
require_once __DIR__ . '/services/CourseService.php';
require_once __DIR__ . '/services/ContactMeService.php';


echo "<pre>"; // Make the output easier to read

try {
    // Test User Service
    $userService = new UserService();
    $newUser = [
        'email' => 'testuser55561@example.com',
        'password_hash' => 'password123',
        'name' => 'Test User'
    ];
    $userResult = $userService->createUser($newUser);
    print_r("User created:\n");
    print_r($userResult);

    // Test Subscription Service
    $subscriptionService = new SubscriptionService();
    $newSubscription = [
        'name' => 'Premium Plan',
        'price' => 99.99
    ];
    $subscriptionResult = $subscriptionService->createSubscription($newSubscription);
    print_r("Subscription created:\n");
    print_r($subscriptionResult);

    // Test Payment Service
    $newPayment = [
        'user_id' => 1, // this user_id must exist
        'chosen_course_subscription' => 'Premium Plan',
        'subscription_id' => 1, // make sure this subscription_id exists
        'course_id' => 1 // make sure this course_id exists
    ];
    $paymentService = new PaymentService();

    $paymentResult = $paymentService->createPayment($newPayment);
    print_r("Payment created:\n");
    print_r($paymentResult);

    // Test Location Service
    $locationService = new LocationService();
    $newLocation = [
        'name' => 'Downtown Gym'
    ];
    $locationResult = $locationService->createLocation($newLocation);
    print_r("Location created:\n");
    print_r($locationResult);

    // Test Course Service
    $courseService = new CourseService();
    $newCourse = [
        'name' => 'Yoga Basics'
    ];
    $courseResult = $courseService->createCourse($newCourse);
    print_r("Course created:\n");
    print_r($courseResult);

    // Test LocationCourses Service (link course to location)
    $locationCoursesService = new LocationCoursesService();
    $linkResult = $locationCoursesService->addCourseToLocation(1, 1); // Assuming IDs exist
    print_r("Course linked to location:\n");
    print_r($linkResult);

    // Test ContactMe Service
    $contactMeService = new ContactMeService();
    $newMessage = [
        'user_id' => 1, // Make sure this user_id exists
        'message' => 'I would like to know more about personal training packages.'
    ];
    $messageResult = $contactMeService->createMessage($newMessage);
    print_r("Contact message created:\n");
    print_r($messageResult);

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

echo "</pre>";
?>
