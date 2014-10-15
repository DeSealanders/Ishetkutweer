<?php
/**
 * Created by PhpStorm.
 * User: Peter
 * Date: 4-1-14
 * Time: 17:50
 */

class Controller {
    private $dataImport;

    public function __construct() {
        $this->init();
    }

    private function init() {
        date_default_timezone_set('utc');

        require_once('include/php/DataImport.php');
        require_once('include/php/WeatherView.php');
        require_once('include/php/WeatherMessage.php');
        require_once('include/php/view/View.php');
        require_once('include/php/view/MeasurementsView.php');
        require_once('include/php/view/TitleView.php');
        require_once('include/php/view/TimeView.php');
        require_once('include/php/view/MenuView.php');
        require_once('include/php/view/SocialMediaView.php');
        require_once('include/php/classes/WeatherStation.php');
        require_once('include/php/classes/Measurement.php');
        require_once('include/php/classes/GeoLocator.php');
        require_once('include/php/classes/GeoCompare.php');
        require_once('include/php/classes/GeoHandler.php');
        require_once('include/php/classes/Config.php');
        require_once('include/php/classes/WeatherRating.php');

        $this->dataImport = new DataImport();
        $this->renderStations();
        $this->renderWeatherMessage();
    }

    private function renderStations() {
        $stations = $this->dataImport->getStations();
        $preferedStation = $this->getPreferedStation($stations);
        new WeatherView($stations, $preferedStation, array(
            'Misschien is het kutweer' => 'default',
            'Nee, het is geen kutweer' => 'success',
            'Het is redelijk kutweer' => 'warning',
            'Ja, het is kutweer!' => 'danger'));
    }

    private function getPreferedStation($stations) {
        if (isset($_COOKIE['station'])) {
           $stationId = $_COOKIE['station'];
           foreach($stations as $station) {
               if($station->getId() == $stationId) {
                   return $station;
               }
           }
        }
        $geoHandler = new GeoHandler($stations);
        if($station = $geoHandler->getStation()) {
            return $station;
        }
        return $this->selectedStation = $stations[0];
    }

    private function renderWeatherMessage() {
    }

} 