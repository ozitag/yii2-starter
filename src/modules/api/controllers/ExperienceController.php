<?php


namespace app\modules\api\controllers;


use app\models\Experience;
use app\models\Skills;
use app\models\User;
use app\modules\api\dto\ExpShortDTO;
use app\modules\api\request\experience\ExperienceRequest;
use app\modules\api\request\experience\SingleExperienceRequest;
use app\modules\api\request\resume\SingleResumeRequest;
use app\modules\api\request\skill\SingleSkillRequest;
use app\traits\ServicesTrait;
use ozerich\api\controllers\Controller;
use ozerich\api\controllers\SecuredController;
use ozerich\api\filters\AccessControl;
use ozerich\api\response\ArrayResponse;

class ExperienceController extends SecuredController
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
                    'roles' => [User::ROLE_ADMIN]
                ],
                [
                    'action' => 'create',
                    'verbs' => 'POST',
                    'roles' => [User::ROLE_ADMIN]
                ],
                [
                    'action' => 'delete',
                    'verbs' => 'POST',
                    'roles' => [User::ROLE_ADMIN]
                ],
                [
                    'action' => 'delete-all',
                    'verbs' => 'POST',
                    'roles' => [User::ROLE_ADMIN]
                ]
            ]
        ];

        return $behaviors;
    }

    public function actionIndex(){

        return new ArrayResponse(Experience::find()->all(), ExpShortDTO::class);
    }

    public function actionCreate(){

        $request = new ExperienceRequest();
        $request->load();

        $this->experienceService()->create($request);

        return [
            'success' => true
        ];
    }


    public function actionDelete(){
        $request = new SingleExperienceRequest();
        $request->load();

        $this->experienceService()->delete($request->id);

        return [
            'success' => ''
        ];

    }

    public function actionDeleteAll(){
        $request = new SingleResumeRequest();
        $request->load();

        $this->experienceService()->deleteFromResume($request->id);


        return [
            'success' => ''
        ];
    }
}