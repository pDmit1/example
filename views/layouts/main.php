<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>

    <div class="wrap">
        <?php
        NavBar::begin();
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                Yii::$app->user->isGuest ? (
                ['label' => '']
                ) : ('<li>'.
                    Html::a('Главная', ['/'], ['class' => 'profile-link']).
                    '<li>'.
                    '<li>'
                    . Html::beginForm(['/auth/logout'], 'post')
                    . Html::submitButton(
                        'Выход (' . Yii::$app->user->identity->name . ')',
                        ['class' => 'btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>'
                )
            ],
        ]);
        NavBar::end();
        ?>

        <div class="container">
            <div class="head-logo">
                <a href="http://my.coachwoman.ru/"><img src="/i/logo_sp.jpg" title="Со-твори счастливую себя" alt="Практики личностного и духовного роста, саморазвитие"></a>
            </div>
            <?= Breadcrumbs::widget([
                'homeLink' => ['label' => 'Главная', 'url' => Yii::$app->homeUrl],
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>

    <?php $this->endBody() ?>
    <?php
    $js = <<< 'SCRIPT'
    /* To initialize BS3 tooltips set this below */
    $(function () { 
        $("[data-toggle='tooltip']").tooltip(); 
    });;
    /* To initialize BS3 popovers set this below */
    $(function () { 
        $("[data-toggle='popover']").popover(); 
    });
SCRIPT;
    // Register tooltip/popover initialization javascript
    $this->registerJs($js);?>
    </body>
    </html>
<?php $this->endPage() ?>