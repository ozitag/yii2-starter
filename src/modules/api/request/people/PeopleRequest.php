<?php

namespace app\modules\api\request\people;

use app\models\User;
use ozerich\api\request\RequestModel;

class PeopleRequest extends RequestModel
{
    public $name;
    public $phone;
    public $email;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'name'], 'string', 'max' => 100],
            [['email'], 'email'],
            [['phone'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'name' => 'ФИО',
            'phone' => 'Телефон',
        ];
    }

}