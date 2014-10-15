<?php
/**
 * Created by PhpStorm.
 * User: Peter
 * Date: 21-1-14
 * Time: 21:09
 */

class GeoHandler {

    public function __construct($stations) {
        $this->stations = $stations;
    }

    public function getStation() {
        if($location = $this->getLocation()) {
            return $this->getClosestStation($location, $this->stations);
        }
    }

    private function getLocation() {
        $geoLocator = new GeoLocator();
        return $geoLocator->getLocation();
    }

    private function getClosestStation($location, $stations) {
        $geoCompare = new GeoCompare($location, $stations);
        return $geoCompare->getStation();

    }

} 