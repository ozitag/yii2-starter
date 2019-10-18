<?php


namespace app\modules\api\dto;


use app\models\Experience;
use ozerich\api\interfaces\DTO;

class ExpShortDTO extends Experience implements DTO
{
    /** @var Experience $model */
    public $model;

    public function __construct(Experience $model)
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
            'content' => $this->model->content
        ];
    }
}