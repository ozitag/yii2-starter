<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "resume".
 *
 * @property int $id
 * @property int $user_id
 * @property string $profession
 * @property string $about
 * @property string $competencies
 * @property string $education
 * @property string $courses
 * @property string $english
 */
class Resume extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'resume';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'profession', 'about', 'competencies', 'education','english'], 'required'],
            [['user_id'], 'integer'],
            [['about',  'competencies', 'education', 'courses'], 'string'],
            [['profession', 'english'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'profession' => 'Профессия',
            'about' => 'О человеке',
            'competencies' => 'Опыт с технологиями',
            'education' => 'Образование',
            'courses' => 'Курсы и сертификаты',
            'english' => 'Уровень английского',
        ];
    }
}
