<?php
namespace app\models;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;
/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property integer $isAdmin
 * @property string $photo
 *
 * @property Comment[] $comments
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['isAdmin'], 'integer'],
            [['name', 'email', 'password', 'photo'], 'string', 'max' => 255],
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'email' => 'Почта',
            'password' => 'Пароль',
            'isAdmin' => 'Is Admin',
            'photo' => 'Photo',
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['user_id' => 'id']);
    }

    public function getLessons()
    {
        return $this->hasMany(Lesson::className(), ['id' => 'lesson_id'])
            ->viaTable('lesson_user', ['user_id' => 'id']);
    }

    public function getSelectedLesson()
    {
        $selectedLessons = $this->getLessons()->select('id')->asArray()->all();
        return ArrayHelper::getColumn($selectedLessons,'id');
    }

    public function saveLesson($lessons,$id)
    {
        if (is_array($lessons))
        {
            $this->clearCurrentTags();
            foreach($lessons as $lesson_id)
            {
                $lesson = Lesson::findOne($lesson_id);
                $lesUs = new LessonUser();
                $lesUs->lesson_id = $lesson->id;
                $lesUs->user_id = $id;
                $lesUs->save();
            }
        }
    }

    public function clearCurrentTags()
    {
        LessonUser::deleteAll(['user_id'=>$this->id]);
    }

    public static function findIdentity($id)
    {
        return User::findOne($id);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }

    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        // TODO: Implement findIdentityByAccessToken() method.
    }

    public static function findByEmail($email)
    {
        return User::find()->where(['email'=>$email])->one();
    }

    public function validatePassword($password)
    {
        return ($this->password == $password) ? true : false;
    }

    public function create()
    {
        return $this->save(false);
    }

    public function getImage()
    {
        return $this->photo;
    }
}