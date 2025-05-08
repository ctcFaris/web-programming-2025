<?php
require_once __DIR__ . '/../dao/LocationDao.php';
require_once 'BaseService.php';

class LocationService extends BaseService {
    public function __construct() {
        $dao = new LocationDao();
        parent::__construct($dao);
    }

    //  Ensure location name is not empty
    public function createLocation($data) {
        if (empty($data['name'])) {
            throw new Exception('Location name cannot be empty.');
        }
        return $this->create($data);
    }

    public function getAllLocations() {
        return $this->getAll();
    }

    public function getLocationById($location_id) {
        return $this->getById($location_id);
    }

    public function updateLocation($location_id, $data) {
        return $this->update($location_id, $data);
    }

    public function deleteLocation($location_id) {
        return $this->delete($location_id);
    }
}
?>
