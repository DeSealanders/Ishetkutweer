<?php
/**
 * Created by PhpStorm.
 * User: Peter
 * Date: 19-1-14
 * Time: 14:12
 */

class SocialMediaView extends View {

    public function __construct() {
        parent::__construct();
    }

    public function render() {
        ?>
        <div class="socialmedia">
            <a href="https://www.facebook.com/ishetkutweer" target="_blank"><img class="facebookicon" src="include/images/socialmedia/facebook.png"></a>
            <a href="https://twitter.com/ishetkutweer" target="_blank"><img class="twittericon" src="include/images/socialmedia/twitter.png"></a>
        </div>
        <?php
    }

} 