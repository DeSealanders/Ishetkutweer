<?php
/**
 * Created by PhpStorm.
 * User: Peter
 * Date: 19-1-14
 * Time: 14:12
 */

class MenuView extends View {
    private $currentStation;
    private $stations;

    public function __construct($currentStation, $stations) {
        $this->currentStation = $currentStation;
        $this->stations = $stations;
        parent::__construct();
    }

    public function render() {
        ?>
        <div class="stationName">
            <ul class="nav nav-pills station-sel">
                <li class="dropdown">
                    <a class="dropdown-toggle station-select" data-toggle="dropdown" href="#">
                        <span class="menu-station-name"><?php echo $this->currentStation->getName(); ?></span>
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <?php /*<li><a href="#">Dichtst bij (Gps)</a></li>
                        <li class="divider"></li> */ ?>
                        <?php
                        foreach($this->stations as $station) {
                            if($station->getId() == $this->currentStation->getId()) {
                                $class = 'selected';
                            }
                            else {
                                $class = 'unselected';
                            }
                            ?>
                            <li><a href="#" id="<?php echo $station->getId(); ?>" class="stationmenu menu-<?php echo $class; ?>"><?php echo $station->getName(); ?></a></li>
                            <?php
                        }
                        ?>
                    </ul>
            </ul>
        </div>
    <?php
    }

} 