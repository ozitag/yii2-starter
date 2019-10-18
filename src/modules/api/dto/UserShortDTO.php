<?php


namespace app\modules\api\dto;


use app\models\User;
use ozerich\api\interfaces\DTO;

class UserShortDTO extends User implements DTO
{
    /** @var User $model */
    public $model;

    public function __construct(User $model)
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
            'name' => $this->model->name,
            'phone' => $this->model->phone,
            'email' => $this->model->email,
        ];
    }
}