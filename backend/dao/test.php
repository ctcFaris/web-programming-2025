<?php
require_once 'UserDao.php';
require_once 'CourseDao.php';

$userDao = new UserDao();
$courseDao = new CourseDao();

// Prepare new user data
$newUser = [
   'name' => 'John',
   'last_name' => 'Doe',
   'email' => 'john.doe221222@example.com',
   'password_hash' => password_hash('securepassword', PASSWORD_DEFAULT),
];

// Check if user already exists by email
$existingUser = $userDao->getByEmail($newUser['email']);
if ($existingUser) {
    echo "User with this email already exists!\n";
} else {
    $userDao->insert($newUser);
    echo "New user inserted successfully.\n";
}

// Insert a new course
$courseDao->insert([
   'name' => 'Strength Training 101',
   'description' => 'An introductory course on strength training techniques.',
   'price' => 49.99,
   'amount_of_workouts' => '12 workouts'
]);

// Fetch and print all users
$users = $userDao->getAllUsers();
echo "All Users:\n";
print_r($users);

// Fetch and print all courses
$courses = $courseDao->getAll();
echo "All Courses:\n";
print_r($courses);

// Fetch user by ID and print
$user = $userDao->getUserById(1);
echo "User with ID 1:\n";
print_r($user);

// Fetch course by ID and print (assuming you have getCourseById in CourseDao)
$course = $courseDao->getCourseById(1);
echo "Course with ID 1:\n";
print_r($course);
