<?php
/**
 * Created by PhpStorm.
 * User: Peter
 * Date: 19-1-14
 * Time: 14:12
 */

class MeasurementsView extends View {
    private $measurements;

    public function __construct($measurements) {
        $this->measurements = $measurements;
        parent::__construct();
    }

    public function render() {
        foreach($this->measurements as $measurement) {
            ?>
            <div class="measurement">
                <div class="measurement-text">
                    <div class="measurement-icon">
                        <span class="centerer"></span>
                        <img src="<?php echo $measurement->getIcon(); ?>">
                    </div>
                    <div class="text">
                        <?php echo $measurement->getName(); ?>
                    </div>
                </div>
                <div class="measurement-value alert <?php echo $measurement->getClass(); ?> ">
                    <a href="#" class="alert-link"><?php echo $measurement->getValue(); ?>
                        <span class="suffix">
                        <?php echo $measurement->getSuffix(); ?>
                        </span>
                    </a>
                </div>
            </div>
        <?php
        }
    }

} 