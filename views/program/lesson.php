<?php
/* @var $this yii\web\View */

/* @var $programTitle */
/* @var $lesson */

$this->title = $lesson->title;
$this->params['breadcrumbs'][] = ['label' => $programTitle->title, 'url' => ['/program', 'id' => $programTitle->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-content">
    <?= $lesson->content?>
</div>
<h2>Оставить отчет к этому уроку:</h2>
<div class="form-cont">
    <?php if (Yii::$app->session->getFlash('comment')):?>
        <div class="alert alert-success" role="alert">
            <?= Yii::$app->session->getFlash('comment')?>
        </div>
    <?php endif;?>

    <?php $form = \yii\widgets\ActiveForm::begin([
        'action' => ['comment', 'id'=>$lesson->id],
        'options'=>['class'=>'contact-form', 'role'=>'form']
    ])?>
    <?= $form->field($commentForm, 'comment')
        ->textarea(['class'=>'form-control', 'placeholder'=>'Напиши отчет','rows'=>8])
        ->label(false); ?>
    <button type="submit" class="btn btn-default" name="login-button">Отправить</button>
    <?php \yii\widgets\ActiveForm::end()?>
</div>
<?php if (!empty($comments)):?>
    <?php foreach ($comments as $comment):?>
        <div class="blog-comment">
            <ul>
                <li><strong><?= $comment->user->name?></strong></li> |
                <li><?= $comment->getDate()?></li>
            </ul>
            <p><?= $comment->text?></p>
        </div>
    <?php endforeach;?>
<?php endif;?>
