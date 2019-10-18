<?php


namespace app\modules\api\dto;

use app\models\Experience;
use app\models\Resume;
use app\models\Skills;
use app\models\User;
use ozerich\api\interfaces\DTO;
use ozerich\api\response\ArrayResponse;

class ResumeFullDTO extends ResumeShortDTO implements DTO
{

    /**
     * @return array
     * @throws Throwable
     */
    public function toJSON(): array
    {
        $json = parent::toJSON();
        return array_merge($json, [
            'about' => $this->model->about,
            'competencies' => $this->model->competencies,
            'education' => $this->model->education,
            'courses' => $this->model->courses,
            'english' => $this->model->english,
            'experience' => (new ArrayResponse(
                Experience::findAll([
                    'resume_id' => $this->model->id
                ]) , ExpShortDTO::class
            ))->toJSON(),
            'skills' => (new ArrayResponse(
                Skills::findAll([
                    'resume_id' => $this->model->id
                ]) , SkillShortDTO::class
            ))->toJSON(),
        ]);
    }
}