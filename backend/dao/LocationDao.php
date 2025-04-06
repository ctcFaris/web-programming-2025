<?php
require_once 'BaseDao.php';

class LocationDao extends BaseDao {
   public function __construct() {
       parent::__construct("Locations", "location_id");
   }

   +
   public function createLocation($data) {
       return $this->insert($data);
   }

   +
   public function getAllLocations() {
       return $this->getAll();
   }

   +
   public function getLocationById($location_id) {
       return $this->getById($location_id);
   }

   +
   public function updateLocation($location_id, $data) {
       return $this->update($location_id, $data);
   }

   +
   public function deleteLocation($location_id) {
       return $this->delete($location_id);
   }
}
?>