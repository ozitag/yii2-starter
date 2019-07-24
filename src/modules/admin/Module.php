<?php

namespace app\modules\admin;

class Module extends \ozerich\admin\Module
{
    public $userIdentityClass = 'app\modules\admin\models\User';

    public $menu = [
        [
            'id' => 'users',
            'link' => '/users',
            'label' => 'Пользователи',
            'submenu' => [
                [
                    'id' => 'users-active',
                    'link' => '/users',
                    'label' => 'Активные'
                ],
                [
                    'id' => 'users-blocked',
                    'link' => '/users/blocked',
                    'label' => 'Заблокированные'
                ]
            ]
        ]
    ];
}