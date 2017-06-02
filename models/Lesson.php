<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lesson".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $content
 * @property string $image
 * @property integer $user_id
 * @property integer $status
 * @property integer $program_id
 */
class Lesson extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lesson';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description', 'content'], 'string'],
            [['user_id', 'status', 'program_id'], 'integer'],
            [['title', 'image'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'description' => 'Описание',
            'content' => 'Содержание',
            'image' => 'Image',
            'user_id' => 'User ID',
            'status' => 'Опубликовать',
            'program_id' => 'Программа',
        ];
    }

    public function getProgram()
    {
        return $this->hasOne(Program::className(), ['id' => 'program_id']);
    }

    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])
            ->viaTable('lesson_user', ['lesson_id' => 'id']);
    }

    public function saveProgram($program_id)
    {
        $program = Program::findOne($program_id);

        if($program != null)
        {
            $this->link('program', $program);
            return true;
        }
    }

    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['lesson_id' => 'id']);
    }

    public function getLessonComments()
    {
        return $this->getComments()->where(['status'=>1])->all();
    }
}
