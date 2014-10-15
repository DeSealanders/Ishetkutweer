<?php
/**
 * Created by PhpStorm.
 * User: Peter
 * Date: 4-1-14
 * Time: 23:13
 */

class Measurement {
    private $name;
    private $suffix;
    private $value;
    private $icon;
    private $class;
    private $rating;

    public function __construct($name, $suffix, $icon, $value, $class, $rating) {
        $this->name = $name;
        $this->suffix = $suffix;
        $this->value = $value;
        $this->icon = $icon;
        $this->class = $class;
        $this->rating = $rating;
    }

    public function getName() {
        return $this->name;
    }

    public function getSuffix() {
        return $this->suffix;
    }

    public function getIcon() {
        return 'include/images/icons/' . $this->icon;
    }

    public function getValue() {
        return $this->value;
    }

    public function getClass() {
        return $this->class;
    }

    public function getRating() {
        return $this->rating;
    }
} 