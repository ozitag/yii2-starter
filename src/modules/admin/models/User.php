<?php

namespace app\modules\admin\models;

use blakit\admin\interfaces\IAdminUser;

class User extends \blakit\models\User implements IAdminUser
{
    public $id;
    public $username;
    public $password;
    public $job;
    public $avatar;
    public $name;
    public $authKey;
    public $accessToken;

    private static $users = [
        '1' => [
            'id' => '1',
            'username' => 'admin',
            'password' => 'admin',
            'avatar' => 'avatar5.png',
            'name' => 'Vital Ozierski',
            'job' => 'Programmer',
            'authKey' => 'test101key',
            'accessToken' => '101-token',
        ]
    ];

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return isset(self::$users[$id]) ? new static(self::$users[$id]) : Manager::findIdentity($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param  string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        foreach (self::$users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public function getDashboardName()
    {
        return $this->name;
    }

    public function checkAdminLogin($login, $password)
    {
        $user = self::findByUsername($login);

        if ($user && $user->validatePassword($password)) {
            return $user;
        }

        return null;
    }

    /**
     * Validates password
     *
     * @param  string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }
}