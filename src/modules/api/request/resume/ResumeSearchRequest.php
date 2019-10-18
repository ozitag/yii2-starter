<?php

namespace app\modules\api\request\resume;

use app\models\User;
use ozerich\api\request\RequestModel;

class ResumeSearchRequest extends RequestModel
{
    public $id;
    public $user_id;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'id'], 'integer'],
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
            'id' => 'ID',
        ];
    }

}