<?php
/**
 * Created by PhpStorm.
 * User: Peter
 * Date: 1-1-14
 * Time: 22:53
 */

class DataImport {
    private $stationgegevens;

    public function __construct() {
        if($xml = $this->importXml()) {
            $this->stationgegevens = $this->convertToArray($xml);
        }
    }

    private function importXml() {
        $xmlstring = file_get_contents('http://xml.buienradar.nl/');
        if(isset($xmlstring) && !empty($xmlstring)) {
            return $xmlstring;
        }
        else {
            return false;
        }
    }

    private function convertToArray($xml) {
        $json = json_encode(simplexml_load_string($xml));
        $array = json_decode($json,TRUE);
        return $array;
    }

    public function getWeerstation($station) {
        $weerstations = $this->stationgegevens['weergegevens']['actueel_weer']['weerstations']['weerstation'];
        foreach($weerstations as $weerstation) {
            if($weerstation['stationnaam'] == $station) {
                return new WeatherStation($weerstation);
            }
        }
    }

    public function getStationNames() {
        $stationNames = array();
        $weerstations = $this->stationgegevens['weergegevens']['actueel_weer']['weerstations']['weerstation'];
        foreach($weerstations as $weerstation) {
            $stationNames[] = $weerstation['stationnaam'];
        }
        return $stationNames;

    }

    public function getStations() {
        $stations = array();
        foreach($this->stationgegevens['weergegevens']['actueel_weer']['weerstations']['weerstation'] as $station) {
            $stations[] = new WeatherStation($station);
        }
        return $stations;

    }

    public function getWeatherMsg() {
        return $this->stationgegevens['weergegevens']['verwachting_meerdaags'];
    }

} 