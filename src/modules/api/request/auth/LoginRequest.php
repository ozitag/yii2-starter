<?php

namespace app\modules\api\request\auth;

use app\modules\api\components\RequestModel;

class LoginRequest extends \ozerich\api\request\RequestModel
{
    public $login;
    public $password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['login', 'password'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'login' => 'Логин',
            'password' => 'Пароль'
        ];
    }
}
