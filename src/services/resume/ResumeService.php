<?php

namespace app\services\resume;

use app\models\Experience;
use app\models\Resume;
use app\models\Skills;
use app\models\User;
use app\modules\api\request\experience\ExperienceRequest;
use app\modules\api\request\resume\ResumeRequest;
use app\modules\api\request\resume\ResumeSearchRequest;
use app\modules\api\request\skill\SkillRequest;
use app\services\Singleton;
use app\traits\ServicesTrait;
use Firebase\JWT\JWT;
use mikehaertl\tmp\File;
use mikehaertl\wkhtmlto\Pdf;
use ozerich\api\request\InvalidRequestException;
use ozerich\api\request\RequestError;
use yii\helpers\Url;

class ResumeService extends Singleton
{
    use ServicesTrait;

    public function createResume(ResumeRequest $resume){
        $resume->competencies = json_encode($resume->competencies);
        $resume->education = json_encode($resume->education);
        $resume->courses = json_encode($resume->courses);

        $res = new Resume();
        if(!$res->load($resume->attributes, '') || !$res->save()){
            throw new InvalidRequestException(new RequestError('all', 'Не удалось создать резюме :C'));
        }

    }

    public function searchResume(ResumeSearchRequest $req){
        return Resume::find()
            ->andFilterWhere([ 'user_id' => $req->user_id])
            ->andFilterWhere([ 'id' => $req->id]);
    }


    public function createPDF(Resume $res, $download = false){

        $pdf = new Pdf(array(
            'margin-top'    => 5,
            'binary' => '/usr/local/bin/wkhtmltopdf',
            'ignoreWarnings' => true,
            'commandOptions' => array(
                'useExec' => true,
                'procEnv' => array(
                    'LANG' => 'en_US.utf-8',
                ),
            ),

        ));

        $jwt = JWT::encode([
            'resume_id' => $res->id
        ], getenv('JWT_KEY'));

        $pdf->addPage(Url::toRoute(['resume/raw', 'id' => $jwt], true),  [
            'header-html' => '<!DOCTYPE html><html><img src="' .Url::base(true) . '/logo.png" style="float: left; width: 150px; height: auto" alt=""></html>',
//            'header-spacing' => '20'
        ] );
        $File_name =  User::findOne($res->user_id)->name . '_'. \Yii::$app->security->generateRandomString(11) . '.pdf';

        if (!$pdf->saveAs(__DIR__ . '/../../web/uploads/documents/' . $File_name)) {
            throw new InvalidRequestException(new RequestError('all', 'Не удалось сохранить резюме :C'));
        }
        if($download){
            return \Yii::$app->response->sendFile(__DIR__ . '/../../web/uploads/documents/' . $File_name);

        }
        return [
            "URL" => Url::base(true) . "/uploads/documents/" . $File_name
        ];
    }
}