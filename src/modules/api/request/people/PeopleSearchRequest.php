<?php

namespace app\modules\api\request\people;

use app\models\User;
use ozerich\api\request\RequestModel;

class PeopleSearchRequest extends RequestModel
{
    public $id;
    public $name;
    public $phone;
    public $email;
    public $role;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role', 'id'], 'integer'],
            [['email', 'name'], 'string', 'max' => 100],
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
            'role' => 'Роль',
            'email' => 'Email',
            'name' => 'ФИО',
            'phone' => 'Телефон',
        ];
    }

}