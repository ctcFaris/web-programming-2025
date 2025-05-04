<?php
require_once __DIR__ . '/../dao/CourseDao.php';
require_once 'BaseService.php';

class CourseService extends BaseService {
    public function __construct() {
        $dao = new CourseDao();
        parent::__construct($dao);
    }

    // Ensure course name is not empty
    public function createCourse($data) {
        if (empty($data['name'])) {
            throw new Exception('Course name cannot be empty.');
        }
        return $this->create($data);
    }

    public function getAllCourses() {
        return $this->getAll();
    }

    public function getCourseById($courseId) {
        return $this->getById($courseId);
    }

    public function updateCourse($courseId, $data) {
        return $this->update($courseId, $data);
    }

    public function deleteCourse($courseId) {
        return $this->delete($courseId);
    }
}
?>
