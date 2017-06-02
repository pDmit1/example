<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Доступ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(!empty($users)):?>

        <table class="table">
            <thead>
            <tr>
                <td>#</td>
                <td>Клиент</td>
                <td>Доступ</td>
            </tr>
            </thead>

            <tbody>
            <?php foreach($users as $user):?>
                <tr>
                    <td><?= $user->id?></td>
                    <td><?= $user->name?></td>
                    <td>
                        <a class="btn btn-success" href="<?= Url::toRoute(['access/view', 'id' => $user->id]); ?>">Предоставить</a>
                    </td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>

    <?php endif;?>
</div>