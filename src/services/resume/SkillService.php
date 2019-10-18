<?php


namespace app\services\resume;


use app\models\Experience;
use app\models\Skills;
use app\modules\api\request\skill\SkillRequest;
use app\services\Singleton;
use ozerich\api\request\InvalidRequestException;
use ozerich\api\request\RequestError;

class SkillService extends Singleton
{
    public function create(SkillRequest $request){
        $skill = new Skills();
        $skill->load($request->attributes, '');

        if(!$skill->save()){
            throw new InvalidRequestException(new RequestError('all', 'Не удалось создать скилл'));
        }
    }

    public function update(){

    }

    public function delete($id){
        Skills::findOne($id)->delete();
    }

    public function deleteFromResume($resume_id){
        Skills::deleteAll([
            'resume_id' => $resume_id
        ]);
    }


    public function search(){

    }
}