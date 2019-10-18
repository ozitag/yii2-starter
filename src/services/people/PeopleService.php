<?php

namespace app\services\people;

use app\models\Resume;
use app\models\User;
use app\modules\api\request\people\PeopleRequest;
use app\modules\api\request\people\PeopleSearchRequest;
use app\modules\api\request\resume\ResumeRequest;
use app\modules\api\request\resume\ResumeSearchRequest;
use app\services\Singleton;
use Firebase\JWT\JWT;
use mikehaertl\wkhtmlto\Pdf;
use ozerich\api\request\InvalidRequestException;
use ozerich\api\request\RequestError;
use yii\helpers\Url;

class PeopleService extends Singleton
{
    public function createPeople(PeopleRequest $request) {
        $res = new User([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'role' => User::ROLE_USER,
            'password_hash' => \Yii::$app->security->generateRandomString(),
            'auth_key' => \Yii::$app->security->generateRandomString(),
        ]);
        if(!$res->save()){
            throw new InvalidRequestException(new RequestError('all', 'Не удалось создать пользователя :C'));
        }
    }

    public function search(PeopleSearchRequest $req){
        return User::find()
            ->andFilterWhere([ 'id' => $req->id])
            ->andFilterWhere([ 'role' => $req->role])
            ->andFilterWhere(["LIKE", 'name' , $req->name])
            ->andFilterWhere(["LIKE", 'phone' , $req->phone]);
    }


}