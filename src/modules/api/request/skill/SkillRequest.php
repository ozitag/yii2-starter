<?php


namespace app\modules\api\request\skill;

use app\models\Resume;
use ozerich\api\request\RequestModel;

class SkillRequest extends RequestModel
{
    public $experience;
    public $title;
    public $percent;
    public $resume_id;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'resume_id'], 'required'],
            [['title', 'experience'], 'string'],
            [['percent'], 'integer'],
            [['resume_id'], 'integer'],
            [
                ['resume_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Resume::className(),
                'targetAttribute' => ['resume_id' => 'id']
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'title' => 'title',
            'percent' => 'percent',
            'experience' => 'experience',
            'resume_id' => 'reesume ID',
        ];
    }
}