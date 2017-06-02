<?php

namespace app\controllers;

use app\models\CommentForm;
use app\models\Lesson;
use app\models\LessonUser;
use app\models\Program;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class ProgramController extends Controller
{
    public function actionIndex($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/auth/login');
        }

        $user_id = Yii::$app->user->id;
        $lessons = Program::getLessonByProgram($id);
        $title = Program::findOne($id);
        $accessLesson = ArrayHelper::map(LessonUser::getAccessByUser($user_id), 'id', 'lesson_id');

        return $this->render('index', [
            'lessons' => $lessons,
            'accessLesson' => $accessLesson,
            'title' => $title,
        ]);
    }

    public function actionLessons($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('/auth/login');
        }

        $lesson = Lesson::findOne($id);
        $programTitle = Program::findOne($lesson->program_id);
        $comments = $lesson->getLessonComments();
        $commentForm = new CommentForm();

        return $this->render('lesson', [
            'lesson' => $lesson,
            'commentForm' => $commentForm,
            'comments' => $comments,
            'programTitle'=>$programTitle
        ]);
    }

    public function actionComment($id)
    {
        $model = new CommentForm();

        if (Yii::$app->request->isPost)
        {
            $model->load(Yii::$app->request->post());
            $model->comment = htmlspecialchars($model->comment);
            if ($model->saveComment($id))
            {
                Yii::$app->getSession()->setFlash('comment', 'Спасибо! Твой отчет скоро появится.');
                return $this->redirect(['/program/lessons', 'id'=>$id]);
            }
        }

    }
}