<?php

use yii\db\Migration;

/**
 * Class m191018_115549_skills
 */
class m191018_115549_skills extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->dropColumn('{{%resume}}', 'skills');
        $this->dropColumn('{{%resume}}', 'experience');
        $this->createTable('{{%skills}}', [
            'id' => $this->primaryKey(),
            'resume_id' => $this->smallInteger(1),
            'title' => $this->string()->notNull(),
            'experience' => $this->text(),
            'percent' => $this->integer(),
            'sort' => $this->integer(),
        ]);

    }

    public function down()
    {
        $this->dropTable('{{%skills}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191018_115549_skills cannot be reverted.\n";

        return false;
    }
    */
}
