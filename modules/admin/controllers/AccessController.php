<?php
/**
 * Created by PhpStorm.
 * User: PDmitA
 * Date: 23.04.2017
 * Time: 7:35
 */

namespace app\modules\admin\controllers;

use app\models\Lesson;
use app\models\User;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class AccessController extends Controller
{
    public function actionIndex()
    {
        $users = User::find()->orderBy('id desc')->all();

        return $this->render('index', [
            'users' => $users,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Lesson::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    public function actionView($id)
    {

        $user = User::findOne($id);

        $selectedLessons = $user->getSelectedLesson();
        $lessons = ArrayHelper::map(Lesson::find()->all(), 'id','title');

        if(Yii::$app->request->isPost)
        {
            $lessons = Yii::$app->request->post('lesson');
            $user->saveLesson($lessons,$id);
            return $this->redirect(['view', 'id'=>$user->id]);
        }

        return $this->render('view', [
            'selectedLessons' => $selectedLessons,
            'lessons' => $lessons,
        ]);
    }
}