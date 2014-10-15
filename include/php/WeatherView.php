<?php
/**
 * Created by PhpStorm.
 * User: Peter
 * Date: 1-1-14
 * Time: 22:52
 */
class WeatherView {
    private $stations;
    private $titleOptions;
    private $preferedStation;

    public function __construct($stations, $preferedStation, $titleOptions) {
        $this->stations = $stations;
        $this->titleOptions = $titleOptions;
        $this->preferedStation = $preferedStation;
        if(count($this->stations) > 0) {
            $this->renderAll();
        }
    }

    private function renderAll() {
            $this->renderTitles($this->titleOptions);
            $this->renderMenu();
            $this->renderSocialmediaButtons();
            $this->renderMeasurements();
    }

    private function renderTitles($titleOptions) {
        new TitleView($titleOptions, $this->preferedStation->getWeatherRating()->getWeatherIndicator());
    }

    private function renderMenu() {
        new MenuView($this->preferedStation, $this->stations);
    }

    private function renderMeasurements() {
        foreach($this->stations as $station) {
            if($station == $this->preferedStation) {
                $extraClass = "selected";
            }
            else {
                $extraClass = "hidden";
            }
            $extraClass .= " " . $station->getWeatherRating()->getWeatherIndicator();
            ?>
            <div id="station-<?php echo $station->getId(); ?>" class="weatherstation <?php echo $extraClass; ?>">
            <?php
            new MeasurementsView($station->getMeasurements());
            new TimeView($station->getTime());
            ?>
            </div>
        <?php
        }
    }

    private function renderSocialmediaButtons() {
        new SocialMediaView();
    }
}