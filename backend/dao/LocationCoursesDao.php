<?php
require_once 'BaseDao.php';

class LocationCoursesDao extends BaseDao {
    public function __construct() {
        parent::__construct("Location_Courses", "location_id");
    }

  
    public function addCourseToLocation($locationId, $courseId) {
        $stmt = $this->connection->prepare("INSERT INTO Location_Courses (location_id, course_id) VALUES (:location_id, :course_id)");
        $stmt->bindParam(':location_id', $locationId);
        $stmt->bindParam(':course_id', $courseId);
        return $stmt->execute();
    }

  
    public function getCoursesByLocation($locationId) {
        $stmt = $this->connection->prepare("SELECT course_id FROM Location_Courses WHERE location_id = :location_id");
        $stmt->bindParam(':location_id', $locationId);
        $stmt->execute();
        return $stmt->fetchAll();
    }

   
    public function getLocationsByCourse($courseId) {
        $stmt = $this->connection->prepare("SELECT location_id FROM Location_Courses WHERE course_id = :course_id");
        $stmt->bindParam(':course_id', $courseId);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    
    public function removeCourseFromLocation($locationId, $courseId) {
        $stmt = $this->connection->prepare("DELETE FROM Location_Courses WHERE location_id = :location_id AND course_id = :course_id");
        $stmt->bindParam(':location_id', $locationId);
        $stmt->bindParam(':course_id', $courseId);
        return $stmt->execute();
    }
}
?>
