<?php
require_once __DIR__ . '/../dao/LocationCoursesDao.php';
require_once 'BaseService.php';

class LocationCoursesService extends BaseService {
    public function __construct() {
        $dao = new LocationCoursesDao();
        parent::__construct($dao);
    }

    // Ensure both locationId and courseId are valid
    public function addCourseToLocation($locationId, $courseId) {
        if (empty($locationId) || empty($courseId)) {
            throw new Exception('Both location ID and course ID are required.');
        }
        return $this->dao->addCourseToLocation($locationId, $courseId);
    }

    public function getCoursesByLocation($locationId) {
        return $this->dao->getCoursesByLocation($locationId);
    }

    public function getLocationsByCourse($courseId) {
        return $this->dao->getLocationsByCourse($courseId);
    }

    public function removeCourseFromLocation($locationId, $courseId) {
        return $this->dao->removeCourseFromLocation($locationId, $courseId);
    }
}
?>
