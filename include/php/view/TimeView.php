<?php
/**
 * Created by PhpStorm.
 * User: Peter
 * Date: 19-1-14
 * Time: 14:12
 */

class TimeView extends View {
    private $time;

    public function __construct($time) {
        $this->time = $time;
        parent::__construct();
    }

    public function render() {
        ?>
        <div class="time small">
        <?php
        echo 'Gemeten om ' . $this->time;
        ?>
        </div>
        <?php
    }

} 