<?php
/**
 * Created by PhpStorm.
 * User: Peter
 * Date: 15-5-14
 * Time: 11:48
 */

class WeatherRating {

    private $measurements;

    public function __construct() {

    }

    /**
     * Determine scores based on a value and limits
     * @param $value
     * @param $limits
     * @return bool|int
     */
    public function getRating($value, $limits) {
        $inverse = $limits[0];
        $min = $limits[1];
        $max = $limits[2];
        if($value === "-") {
            return false;
        }
        if($value > $min && $value < $max) {
            return 2;
        }
        else if($value >= $max && !$inverse) {
            return 3;
        }
        else if($value >= $max && $inverse) {
            return 1;
        }
        else if($value <= $min && !$inverse) {
            return 1;
        }
        else if($value <= $min && $inverse) {
            return 3;
        }
    }

    /**
     * Return a color based on a score
     * @param $color
     * @return string
     */
    public function getColorClass($color) {
        $base = 'alert-';
        switch($color) {
            case 1:
                return $base . 'success';
            case 2:
                return $base . 'warning';
            case 3:
                return $base . 'danger';
            default:
                return $base . 'default';
        }
    }

    /**
     * Get an indicator for the station's weather
     * @return string
     */
    public function getWeatherIndicator() {
        $score = $this->getWeatherRating();
        if(!$score) {
            return 'default';
        }
        if($score <= 1.5) {
            return 'success';
        }
        else if($score >= 2.5) {
            return 'danger';
        }
        else {
            return 'warning';
        }
    }

    /**
     * Determine the total score for a weatherstation
     * @return bool|float
     */
    private function getWeatherRating() {
        $rating = 0;
        $amount = count($this->measurements);
        foreach($this->measurements as $measurement) {
            if(!$measurement->getRating()) {
                $amount--;
            }
            else {
                $rating += $measurement->getRating();
            }
        }
        if($amount > 0) {
            return $rating / $amount;
        }
        else {
            return false;
        }
    }

    public function setMeasurements($measurements) {
        $this->measurements = $measurements;
    }

} 