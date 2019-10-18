<?php


namespace app\modules\api\controllers;


use app\models\User;
use app\modules\api\dto\UserShortDTO;
use app\modules\api\request\people\PeopleRequest;
use app\modules\api\request\people\PeopleSearchRequest;
use app\traits\ServicesTrait;
use ozerich\api\controllers\Controller;
use ozerich\api\controllers\SecuredController;
use ozerich\api\filters\AccessControl;
use ozerich\api\response\CollectionResponse;
use yii\data\ActiveDataProvider;

class PeopleController extends SecuredController
{
    use ServicesTrait;

    public function behaviors(): array
    {
        $behaviors = parent::behaviors();

        $behaviors['access'] = [
            'class' => AccessControl::class,
            'rules' => [
                [
                    'action' => 'index',
                    'verbs' => 'GET',
                    'roles' => [User::ROLE_ADMIN, User::ROLE_USER]
                ],
                [
                    'action' => 'create',
                    'verbs' => 'POST',
                    'roles' => [User::ROLE_ADMIN, User::ROLE_USER]
                ],
            ]
        ];

        return $behaviors;
    }


    public function actionIndex(){
        $request = new PeopleSearchRequest();
        $request->load();


        $dataProvider = new ActiveDataProvider([
            'query' => $this->peopleService()->search($request)
        ]);

        return new CollectionResponse($dataProvider, UserShortDTO::class);
    }


    public function actionCreate(){
        $request = new PeopleRequest();
        $request->load();

        $this->peopleService()->createPeople($request);

        return [
            'success' => true
        ];
    }

}