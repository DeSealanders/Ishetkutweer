<?php
/**
 * Created by PhpStorm.
 * User: Peter
 * Date: 15-5-14
 * Time: 12:01
 */

class WeatherMessage
{

    private $measurements;
    private $config;
    private $weatherRating;
    private $message;
    private $kutmessage;
    private $rating;

    public function __construct($data)
    {
        $this->config = new Config();
        $this->weatherRating = new WeatherRating();
        $this->message = $data['tekst_middellang'];
        $windspeed = $this->windforceToWindspeed($data['dag-plus1']['windkracht']);
        $rain = $this->calcRegenVal(array(
                    'minmmregen' => $data['dag-plus1']['minmmregen'],
                    'maxmmregen' => $data['dag-plus1']['maxmmregen']));
        $temperature = $this->calcTemperature(array(
                    'mintemp' => $data['dag-plus1']['mintemp'],
                    'mintempmax' => $data['dag-plus1']['mintempmax'],
                    'maxtemp' => $data['dag-plus1']['maxtemp'],
                    'maxtempmax' => $data['dag-plus1']['maxtempmax']));


        $this->createMeasurement('Temperatuur', '°C', 'thermometer.png', round($temperature), $this->config->getRatingLimits('Temperatuur'), true);
        $this->createMeasurement('Windsnelheid', 'km/uur', 'wind.png', round($windspeed), $this->config->getRatingLimits('Windsnelheid'), true);
        $this->createMeasurement('Regenval', 'mm/uur', 'rain.png', round($rain, 2), $this->config->getRatingLimits('Regenval'), true);


        $this->weatherRating->setMeasurements($this->measurements);
        $this->rating = $this->weatherRating->getWeatherIndicator();
        $this->setMessage();

    }

    /**
     * Reken windkracht om van beaufort tot km/h
     * @param $windforce
     * @return mixed
     */
    private function windforceToWindspeed($windforce)
    {
        return ($windforce * (1 + ($windforce / 7))) * 3.6;
    }

    private function calcRegenVal($regenParams)
    {
        return ($regenParams['minmmregen'] + $regenParams['maxmmregen'])/2;
    }

    private function calcTemperature($tempParams) {
        $minTemp = ($tempParams['mintemp'] + $tempParams['mintempmax'])/2;
        $maxTemp =  ($tempParams['maxtemp'] + $tempParams['maxtempmax'])/2;
        return ($minTemp + $maxTemp)/2;
    }

    private function createMeasurement($name, $suffix, $icon, $value, $limits, $addtolist) {
        $rating = $this->weatherRating->getRating($value, $limits);
        $measurement = new Measurement($name, $suffix, $icon, $value, $this->weatherRating->getColorClass($rating), $rating);
        if($addtolist) {
            $this->measurements[] = $measurement;
        }
        return $measurement;
    }

    private function setMessage() {
        $msgs = array(
            'Het is morgen misschien kutweer! ' => 'default',
            'Het is morgen geen kutweer!' => 'success',
            'Het is morgen redelijk kutweer' => 'warning',
            'Het is morgen kutweer!!' => 'danger'
        );
        foreach($msgs as $msg => $rating) {
            if($this->rating == $rating) {
                $this->kutmessage = $msg;
            }
        }
    }

    public function getTweet() {
        $tweet = $this->kutmessage;
        $measurementMsgs = array();
        foreach($this->measurements as $measurement) {
            $measurementMsgs[strtolower($measurement->getName())] = strtolower($measurement->getName()) . ': ' .  $measurement->getValue() . $measurement->getSuffix();
        }
        $tweet .= ' ' . $measurementMsgs['temperatuur'] . ', ' . $measurementMsgs['regenval'] . ' en ' . $measurementMsgs['windsnelheid'];
        return $tweet;
    }

    public function getFbPost() {
        $post = $this->kutmessage;
        $post .= ' ' . trim(preg_replace( '/\s+/', ' ', $this->message));
        return $post;
    }

} 