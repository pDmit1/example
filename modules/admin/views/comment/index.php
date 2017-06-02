<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Отчеты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(!empty($comments)):?>

        <table class="table">
            <thead>
            <tr>
                <td>#</td>
                <td>Author</td>
                <td>Text</td>
                <td>Action</td>
            </tr>
            </thead>

            <tbody>
            <?php foreach($comments as $comment):?>
                <tr>
                    <td><?= $comment->id?></td>
                    <td><?= $comment->user->name?></td>
                    <td><?= $comment->text?></td>
                    <td>
                        <?php if($comment->isAllowed()):?>
                            <?= Html::a('Отключить', ['comment/disallow', 'id' => $comment->id], ['class' => 'btn btn-warning']) ?>
                        <?php else:?>
                            <?= Html::a('Добавить', ['comment/allow', 'id' => $comment->id], ['class' => 'btn btn-success']) ?>
                        <?php endif?>
                        <?= Html::a('Удалить', ['comment/delete', 'id' => $comment->id], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Ты уверена, что хочеш удалить этот отчет!',
                                'method' => 'post',
                            ],
                        ]) ?>
                    </td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>

    <?php endif;?>
</div>