<?php
/**
 * Created by PhpStorm.
 * User: Peter
 * Date: 15-5-14
 * Time: 11:40
 */

class Config {

    public function __construct() {

    }

    public function getRatingLimits($indicator) {
        $ratings = array(
            'Temperatuur' => array(true, 5, 15),
            'Windsnelheid' => array(false, 20, 50),
            'Regenval' => array(false, 0, 3)
        );
        foreach($ratings as $rating => $limits) {
            if($rating == $indicator) {
                return $limits;
            }
        }
    }

} 