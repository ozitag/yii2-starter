<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "skills".
 *
 * @property int $id
 * @property int $resume_id
 * @property string $title
 * @property string $experience
 * @property int $percent
 * @property int $sort
 */
class Skills extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'skills';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['resume_id', 'percent', 'sort'], 'integer'],
            [['title'], 'required'],
            [['experience'], 'string'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'resume_id' => 'Резюме ID',
            'title' => 'Заголовок',
            'experience' => 'Опыт',
            'percent' => 'Процент',
            'sort' => 'sort',
        ];
    }
}
