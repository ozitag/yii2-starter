<?php


namespace app\modules\api\dto;


use app\models\Skills;
use app\models\User;
use ozerich\api\interfaces\DTO;

class SkillShortDTO extends Skills implements DTO
{
    /** @var Skills $model */
    public $model;

    public function __construct(Skills $model)
    {
        parent::__construct();

        $this->model = $model;
    }

    /**
     * @return array
     * @throws Throwable
     */
    public function toJSON(): array
    {
        return [
            'id' => $this->model->id,
            'resume_id' => $this->model->resume_id,
            'title' => $this->model->title,
            'experience' => $this->model->experience,
            'percent' => $this->model->percent,
        ];
    }
}