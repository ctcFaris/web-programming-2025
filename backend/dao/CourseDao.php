<?php
require_once 'BaseDao.php';

class CourseDao extends BaseDao {
    public function __construct() {
        parent::__construct("Courses", "course_id");
    }

    
    public function createCourse($data) {
        return $this->insert($data);
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
