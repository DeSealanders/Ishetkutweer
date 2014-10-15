<?php
/**
 * Created by PhpStorm.
 * User: Peter
 * Date: 4-1-14
 * Time: 18:05
 */

class WeatherStation {
    private $measurements;
    private $name;
    private $title;
    private $id;
    private $date;

    public function __construct($station) {
        $this->name = $station['stationnaam'];
        $this->id = $station['stationcode'];
        $this->date = $station['datum'];
        $this->lat = $station['latGraden'];
        $this->lon = $station['lonGraden'];
        $this->weatherRating = new WeatherRating();
        $this->measurements = array();
        $this->config = new Config();
        $this->createMeasurements($station);
        $this->weatherRating->setMeasurements(($this->measurements));
    }

    private function createMeasurements($station) {
        $this->createMeasurement('Temperatuur', '&deg;c', 'thermometer.png', $station['temperatuurGC'], $this->config->getRatingLimits('Temperatuur'), true);
        $this->createMeasurement('Windsnelheid', 'km/uur', 'wind.png', round($station['windsnelheidMS']*3.6), $this->config->getRatingLimits('Windsnelheid'), true);
        $this->createMeasurement('Regenval', 'mm/uur', 'rain.png', round($station['regenMMPU'], 2), $this->config->getRatingLimits('Regenval'), true);
    }

    private function createMeasurement($name, $suffix, $icon, $value, $limits, $addtolist) {
        $rating = $this->weatherRating->getRating($value, $limits);
        $measurement = new Measurement($name, $suffix, $icon, $value, $this->weatherRating->getColorClass($rating), $rating);
        if($addtolist) {
            $this->measurements[] = $measurement;
        }
        return $measurement;
    }

    public function getMeasurements() {
        return $this->measurements;
    }

    public function getName() {
        return $this->name;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getId() {
        return $this->id;
    }

    public function getTime() {
        return date_format(date_create_from_format('m/d/Y H:i:s', $this->date), 'H:i');
    }

    public function getLocation() {
        return array($this->lat, $this->lon);
    }

    public function getWeatherRating() {
        return $this->weatherRating;
    }

} 