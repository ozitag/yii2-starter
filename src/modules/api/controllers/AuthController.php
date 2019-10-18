<?php


namespace app\modules\api\controllers;


use app\models\User;
use app\modules\api\request\auth\LoginRequest;
use ozerich\api\controllers\Controller;
use ozerich\api\filters\AccessControl;
use ozerich\api\request\InvalidRequestException;use ozerich\api\request\RequestError;

class AuthController extends Controller
{
    public function behaviors(): array
    {
        $behaviors = parent::behaviors();

        $behaviors['access'] = [
            'class' => AccessControl::class,
            'rules' => [
                [
                    'action' => 'index',
                    'verbs' => 'GET',
                ],
                [
                    'action' => 'logout',
                    'verbs' => 'GET',
                ],
            ]
        ];

        return $behaviors;
    }

    public function actionIndex(){
        $request = new LoginRequest();
        $request->load();

        /** @var User $user */
        $user = User::findByEmail($request->login)->one();

        if (!$user) {
            throw new InvalidRequestException(
                new RequestError('email', 'Пользователь потерян')
            );
        }

        if ($user->validatePassword($request->password) == false) {
            throw new InvalidRequestException(
                new RequestError('password', 'Неверный пароль')
            );
        }

        if (\Yii::$app->user->login($user) == false) {
            throw new InvalidRequestException(
                new RequestError('password', 'Ошибка авторизации, обратитесь по телефону +375 (29) 133-12-13')
            );
        }

        $_SESSION['auth_status'] = true;
        $_SESSION['auth_id'] = $user->id;
        $_SESSION['auth_jwt'] = $user->getJWT();

        return [
            'jwt' => $user->getJWT()

        ];
    }

    public function actionLogout()
    {
        \Yii::$app->user->logout();
        return [];
    }
}