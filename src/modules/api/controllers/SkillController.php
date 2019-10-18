<?php


namespace app\modules\api\controllers;


use app\models\Resume;
use app\models\Skills;
use app\models\User;
use app\modules\api\dto\SkillShortDTO;
use app\modules\api\request\experience\ExperienceRequest;
use app\modules\api\request\resume\SingleResumeRequest;
use app\modules\api\request\skill\SingleSkillRequest;
use app\modules\api\request\skill\SkillRequest;
use app\traits\ServicesTrait;
use ozerich\api\controllers\Controller;
use ozerich\api\controllers\SecuredController;
use ozerich\api\filters\AccessControl;
use ozerich\api\filters\JwtAuth;
use ozerich\api\response\ArrayResponse;
use ozerich\api\response\ModelResponse;
use yii\db\StaleObjectException;

class SkillController extends SecuredController
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
                ],
            ]
        ];

        return $behaviors;
    }

    public function actionIndex(){
        return new ArrayResponse(Skills::find()->all(), SkillShortDTO::class);
    }

    public function actionCreate(){

        $request = new SkillRequest();
        $request->load();

        $this->skillService()->create($request);

        return [
            'success' => true
        ];
    }

    public function actionDelete(){
        $request = new SingleSkillRequest();
        $request->load();

        $this->skillService()->delete($request->id);

        return [
            'success' => ''
        ];

    }

    public function actionDeleteAll(){
        $request = new SingleResumeRequest();
        $request->load();

        $this->skillService()->deleteFromResume($request->id);

        return [
            'success' => ''
        ];
    }
}