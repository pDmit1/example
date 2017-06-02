
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\Lesson */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Доступ';
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="article-form">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>Выделите уроки, для предоставления доступа</p>
    <?php $form = ActiveForm::begin(); ?>

    <?= Html::dropDownList('lesson', $selectedLessons, $lessons, ['class'=>'form-control', 'multiple'=>true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Применить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>