<?php
/* @var $this yii\web\View */

use yii\helpers\Url;

/* @var $lessons */
?>
<div class="row">
    <div id="portfolio">
    <?php foreach ($programs as $program) :?>
        <div class="col-md-6 portfolio-item">
            <div class="main-info">
            <a href="<?= Url::toRoute(['/program', 'id'=>$program->id]);?>"  class="portfolio-link">
                <div class="caption">
                    <div class="caption-content">
                    </div>
                </div>
                <img src="<?= $program->getImage();?>" class="img-responsive">
            </a>
                <h1><a href="<?= Url::toRoute(['/program', 'id'=>$program->id]);?>"><?= $program->title?></a></h1>
            </div>
        </div>
    <?php endforeach;?>
    </div>
</div>