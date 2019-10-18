<?php
namespace app\modules\api\controllers;

use app\models\Resume;
use app\models\User;
use app\modules\api\dto\ResumeFullDTO;
use app\modules\api\dto\ResumeShortDTO;
use app\modules\api\request\resume\ResumeDownloadRequest;
use app\modules\api\request\resume\ResumeRequest;
use app\modules\api\request\resume\ResumeSearchRequest;
use app\modules\api\request\resume\UploadImageRequest;
use app\traits\ServicesTrait;
use Firebase\JWT\JWT;
use Firebase\JWT\SignatureInvalidException;
use ozerich\api\controllers\Controller;
use ozerich\api\controllers\SecuredController;
use ozerich\api\filters\AccessControl;
use ozerich\api\request\InvalidRequestException;
use ozerich\api\request\RequestError;
use ozerich\api\response\CollectionResponse;
use yii\data\ActiveDataProvider;
use yii\web\Response;
use yii\web\UploadedFile;

class ResumeController extends SecuredController
{
    use ServicesTrait;

    protected $allowGuestActions = ['raw'];

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
                    'action' => 'list',
                    'verbs' => 'GET',
                    'roles' => [User::ROLE_ADMIN]
                ],
                [
                    'action' => 'raw',
                    'verbs' => 'GET'
                ],
                [
                    'action' => 'create',
                    'verbs' => 'POST',
                    'roles' => [User::ROLE_ADMIN]
                ],
                [
                    'action' => 'pdf',
                    'verbs' => 'POST',
                    'roles' => [User::ROLE_ADMIN]
                ],
                [
                    'action' => 'upload',
                    'verbs' => 'POST',
                    'roles' => [User::ROLE_ADMIN]
                ],
            ]
        ];

        return $behaviors;
    }


    public function actionIndex(){
        $request = new ResumeSearchRequest();
        $request->load();


        $dataProvider = new ActiveDataProvider([
            'query' => $this->resumeService()->searchResume($request)
        ]);

        return new CollectionResponse($dataProvider, ResumeShortDTO::class);
    }

    public function actionList(){
        $request = new ResumeSearchRequest();
        $request->load();


        $dataProvider = new ActiveDataProvider([
            'query' => $this->resumeService()->searchResume($request)
        ]);

        return new CollectionResponse($dataProvider, ResumeFullDTO::class);
    }

    public function actionCreate(){
        $request = new ResumeRequest();
        $request->load();

        $this->resumeService()->createResume($request);

        return [
            'success' => true
        ];
    }


    public function actionPdf($download = false){
        $request = new ResumeDownloadRequest();
        $request->load();

        if($download){
            $this->resumeService()->createPDF(Resume::findOne($request->id), $download);
        }
        return $this->resumeService()->createPDF(Resume::findOne($request->id));
    }


    public function actionRaw($id = null){

        try{
            $jwt = JWT::decode($id, getenv('JWT_KEY'), array('HS256'));
        }
        catch (SignatureInvalidException $err){
            throw new InvalidRequestException(new RequestError('all', 'Эй, хватит...'));
        }
        $resume = Resume::findOne(
            ((array)$jwt)['resume_id']
        );
        if($resume){
            $response = \Yii::$app->response;
            $response->format = Response::FORMAT_HTML;
            $response->getHeaders()->set('Content-Type', 'application/xml; charset=utf-8');

            return $this->renderPartial('resume', compact('resume'));
        }
        throw new InvalidRequestException(new RequestError('all', 'Хмм... Это странно'));

    }


    public function actionUpload(){

        $file = UploadedFile::getInstanceByName('file');

        $model = \Yii::$app->media->createFileFromUploadedFile($file, 'avatar');

        return [
            'image' => $model->toJSON()
        ];

    }

}