<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "program".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $content
 * @property string $image
 * @property integer $status
 */
class Program extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'program';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description', 'content'], 'string'],
            [['status'], 'integer'],
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
            'image' => 'Картинка',
            'status' => 'Опубликовать',
        ];
    }

    public function saveImage($filename)
    {
        $this->image = $filename;
        return $this->save(false);
    }

    public function getImage()
    {
        return ($this->image) ? '/uploads/ImageUpload/' . $this->image : '/no-image.png';
    }

    public static function getLessonByProgram($id)
    {
        return $lesson = Lesson::find()->where(['program_id'=>$id, 'status'=>1])->all();
    }

    public static function testAccess($lessons, $accessLessons)
    {
        if (is_array($accessLessons))
        {
            foreach($accessLessons as $access)
            {
                if($access === $lessons)
                    return true;

            }
        }
        return false;
    }

}
