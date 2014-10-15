<?php
/**
 * Created by PhpStorm.
 * User: Peter
 * Date: 21-1-14
 * Time: 20:37
 */

class GeoCompare {
    private $location;
    private $stations;

    public function __construct($location, $stations) {
        $this->location = $location;
        $this->stations = $stations;

    }

    public function getStation() {
        if($distances = $this->getDistances()) {
            return $this->getClosestStation($distances);
        }
        else {
            return false;
        }
    }

    private function getDistances() {
        $distanceList = array();
        foreach($this->stations as $station) {
            $locationToCheck = $station->getLocation();
            $myLocation = $this->location;
            $distance = $this->distance($myLocation[0], $myLocation[1], $locationToCheck[0], $locationToCheck[1], 'k');
            $distanceList[$station->getId()] = $distance;
        }
        if(count($distanceList) > 0 ) {
            return $distanceList;
        }
        else {
            return false;
        }
    }

    private function distance($lat1, $lon1, $lat2, $lon2, $unit) {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);
        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
    }

    private function getClosestStation($distanceList) {
        if(asort($distanceList)) {
            $stationId = reset(array_keys($distanceList));
            return $this->getStationById($stationId);
        }
    }

    private function getStationById($id) {
        foreach($this->stations as $station) {
            if($station->getId() == $id) {
                return $station;
            }
        }
        return false;
    }


} 