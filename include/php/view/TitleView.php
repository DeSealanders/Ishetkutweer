<?php
/**
 * Created by PhpStorm.
 * User: Peter
 * Date: 19-1-14
 * Time: 14:12
 */

class TitleView extends View {
    private $titleOptions;

    public function __construct($titleOptions, $indicator) {
        $this->indicator = $indicator;
        $this->titleOptions = $titleOptions;
        parent::__construct();
    }

    public function render() {
        ?>
        <div class="outer-title">
        <?php
        foreach($this->titleOptions as $title => $class) {
            $extraClass = '';
            if($class != $this->indicator) {
                $extraClass = ' hidden';
            }
            ?>
                <div class="title alert-<?php echo $class . $extraClass; ?>">
                    <?php echo $title; ?>
                </div>
        <?php
        }
        ?>
        </div>
        <?php
    }

} 