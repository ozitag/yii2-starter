<?php

namespace app\modules\api\request\resume;

use app\models\User;
use ozerich\api\request\RequestModel;

class ResumeDownloadRequest extends RequestModel
{
    public $id;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['id'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
        ];
    }

}