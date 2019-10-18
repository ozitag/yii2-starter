<?php

use yii\db\Migration;

/**
 * Class m191018_115850_experience
 */
class m191018_115850_experience extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%experience}}', [
            'id' => $this->primaryKey(),
            'resume_id' => $this->smallInteger(1),
            'title' => $this->string()->notNull(),
            'content' => $this->text(),
            'sort' => $this->integer(),
        ]);

    }

    public function down()
    {
        $this->dropTable('{{%experience}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191018_115850_experience cannot be reverted.\n";

        return false;
    }
    */
}
