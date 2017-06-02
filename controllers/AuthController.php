<?php

namespace app\controllers;

use app\models\LoginForm;
use Yii;
use yii\web\Controller;

class AuthController extends Controller
{
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect('/auth/login');
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            Yii::$app->getSession()->set('username',Yii::$app->user->id);
            if ($model->email === 'admin@admin.ru')
            {
                return $this->redirect('/admin');
            } else {
                return $this->goBack();
            }
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect('/auth/login');
    }
}