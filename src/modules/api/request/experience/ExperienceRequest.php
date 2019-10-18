<?php


namespace app\modules\api\request\experience;

use app\models\Resume;
use ozerich\api\request\RequestModel;

class ExperienceRequest extends RequestModel
{
    public $content;
    public $title;
    public $resume_id;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'resume_id'], 'required'],
            [['title', 'content'], 'string'],
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
            'content' => 'content',
            'resume_id' => 'resume ID',
        ];
    }
}