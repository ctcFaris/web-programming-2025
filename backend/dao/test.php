<?php
require_once 'UserDao.php';
require_once 'CourseDao.php';

$userDao = new UserDao();
$courseDao = new CourseDao();

$userDao->insert([
   'name' => 'John',
   'last_name' => 'Doe',
   'email' => 'john.doe2@example.com',
   'password_hash' => password_hash('securepassword', PASSWORD_DEFAULT),  
]);

$existingUser = $userDao->getByEmail($newUser['email']);
if ($existingUser) {
    echo "User with this email already exists!";
} else {
    $userDao->insert($newUser);
    echo "New user inserted successfully.";
}

$courseDao->insert([
   'name' => 'Strength Training 101',
   'description' => 'An introductory course on strength training techniques.',
   'price' => 49.99,
   'amount_of_workouts' => '12 workouts'
]);

$users = $userDao->getAll();
echo "All Users:\n";
print_r($users);

$courses = $courseDao->getAll();
echo "All Courses:\n";
print_r($courses);

$user = $userDao->getById(1);
echo "User with ID 1:\n";
print_r($user);

$course = $courseDao->getCourseById(1);
echo "Course with ID 1:\n";
print_r($course);
?>
