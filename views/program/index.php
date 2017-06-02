<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $lessons */
/* @var $accessLesson */
/* @var $title */

$this->title = $title->title;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <ul>
    <?php foreach ($lessons as $lesson) :?>
        <?php if (\app\models\Program::testAccess($lesson->id,$accessLesson)) :?>
            <li>
                <a class="link" href="<?= Url::toRoute(['/program/lessons', 'id'=> $lesson->id]);?>"><?= $lesson->title?></a></p>
            </li>
        <?php else: ?>
                <li>
                    <?= Html::tag('span', $lesson->title, [
                            'data-content'=>'У Вас нет доступа',
                            'data-toggle'=>'popover',
                            'style'=>'text-decoration: underline; cursor:pointer;color:#ccc'
                        ]);
                    ?>
                </li>
        <?php endif;?>
    <?php endforeach;?>
    </ul>
</div>