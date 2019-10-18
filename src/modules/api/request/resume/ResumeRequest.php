<?php

namespace app\modules\api\request\resume;

use app\models\User;
use ozerich\api\request\RequestModel;

class ResumeRequest extends RequestModel
{
    public $id;
 public $user_id;
 public $profession;
 public $about;
 public $competencies;
 public $education;
 public $courses;
 public $english;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'profession', 'about', 'competencies', 'education', 'english'], 'required'],
            [['user_id'], 'integer'],
            [['about',  'competencies', 'education', 'courses'], 'safe'],
            [['profession', 'english'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
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