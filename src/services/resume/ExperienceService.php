<?php


namespace app\services\resume;


use app\models\Experience;
use app\modules\api\request\experience\ExperienceRequest;
use app\services\Singleton;
use ozerich\api\request\InvalidRequestException;
use ozerich\api\request\RequestError;

class ExperienceService extends Singleton
{
    public function create(ExperienceRequest $request){
        $exp = new Experience();
        $exp->load($request->attributes, '');

        if(!$exp->save()){
            throw new InvalidRequestException(new RequestError('all', 'Не удалось создать работу'));
        }
    }


    public function update(){

    }

    public function delete($id){
        Experience::findOne($id)->delete();
    }

    public function deleteFromResume($resume_id){
        Experience::deleteAll([
            'resume_id' => $resume_id
        ]);
    }


    public function search(){

    }
}