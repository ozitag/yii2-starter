<?php


namespace app\modules\api\dto;

use app\models\Resume;
use app\models\User;
use ozerich\api\interfaces\DTO;

class ResumeShortDTO extends Resume implements DTO
{

    /** @var Resume $model */
    public $model;
    
    public function __construct(Resume $model)
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
            'user_id' => (new UserShortDTO(User::findOne($this->model->user_id)))->toJSON(),
            'nameENG' => 'NAME_ENG',
            'profession' => $this->model->profession,
        ];
    }
}