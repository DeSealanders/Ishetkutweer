<?php
/**
 * Created by PhpStorm.
 * User: Peter
 * Date: 21-1-14
 * Time: 19:51
 */

class GeoLocator {

    public function __construct() {

    }

    public function getLocation() {
        if($ip = $this->getIp()) {
            $geodata = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ip));
            if(isset($geodata['geoplugin_latitude']) && isset($geodata['geoplugin_longitude'])) {
                $lat = $geodata['geoplugin_latitude'];
                $lon = $geodata['geoplugin_longitude'];
                return array($lat, $lon);
            }
        }
        else {
            return false;
        }
    }

    private function getIp() {
        $ip = $_SERVER['REMOTE_ADDR'];
        //$ip = '213.34.236.130';
        $splitIp = explode('.', $ip);
        if(count($splitIp) == 4) {
            return $ip;
        }
        else {
            return false;
        }

    }

} 