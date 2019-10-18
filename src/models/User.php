<?php

namespace app\models;

use Firebase\JWT\JWT;
use Yii;
use yii\db\ActiveQuery;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property int $role
 * @property string $auth_key
 * @property string $email
 * @property string $name
 * @property string $password_hash
 * @property string $phone
 * @property string $created_at
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    const ROLE_ADMIN = 1;
    const ROLE_USER =10;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role', 'auth_key', 'email', 'name', 'password_hash'], 'required'],
            [['role'], 'integer'],
            [['created_at'], 'safe'],
            [['auth_key'], 'string', 'max' => 32],
            [['email', 'name'], 'string', 'max' => 100],
            [['password_hash'], 'string', 'max' => 60],
            [['phone'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role' => 'Role',
            'auth_key' => 'Auth Key',
            'email' => 'Email',
            'name' => 'Name',
            'password_hash' => 'Password Hash',
            'phone' => 'Phone',
        ];
    }
    /**
     * @param $email
     * @return ActiveQuery
     */
    public static function findByEmail($email)
    {
        return User::find()->andWhere(['email' => $email]);
    }

    public function validatePassword($password)
    {
        if ($password) {
            return $password ==  \Yii::$app->security->validatePassword($password, $this->password_hash);
        } else {
            return false;
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        try {
            $decoded = JWT::decode($token, \Yii::$app->params['jwt_key'], ['HS256']);
            if ($decoded->id) {
                return User::findIdentity($decoded->id);
            } else {
                return null;
            }
        } catch (\Exception $ex) {
            return null;
        }
    }

    public function getJWT()
    {
        $jwt = JWT::encode([
            'id' => $this->id,
            'email' => $this->email,
            'phone' => $this->phone,
            'name' => $this->name,
        ], getenv('JWT_KEY'));

        return $jwt;
    }



}
