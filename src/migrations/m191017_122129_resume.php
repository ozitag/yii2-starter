<?php

use yii\db\Migration;

/**
 * Class m191017_122129_resume
 */
class m191017_122129_resume extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%resume}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->smallInteger(1)->notNull(),
            'profession' => $this->string()->notNull(),
            'about' => $this->text()->notNull(),
            'experience' => $this->text()->notNull(),
            'skills' => $this->text()->notNull(),
            'competencies' => $this->text()->notNull(),
            'education' => $this->text()->notNull(),
            'courses' => $this->text(),
            'english' => $this->string()->notNull()
        ]);

    }

    public function down()
    {
        $this->dropTable('{{%resume}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191017_122129_resume cannot be reverted.\n";

        return false;
    }
    */
}
