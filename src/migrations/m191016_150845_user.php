<?php

use yii\db\Migration;

/**
 * Class m191016_150845_user
 */
class m191016_150845_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'role' => $this->smallInteger(1)->notNull(),
            'auth_key' => $this->string(32)->notNull(),
            'email' => $this->string(100)->notNull(),
            'name' => $this->string(100)->notNull(),
            'password_hash' => $this->string(60)->notNull(),
            'phone' => $this->string(20),
            'created_at' => $this->timestamp()->null()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->insert('{{%users}}', [
            'id' => 1,
            'auth_key' => Yii::$app->security->generateRandomString(32),
            'email' => 'admin@admin.com',
            'name' => 'admin',
            'password_hash' => Yii::$app->security->generatePasswordHash('admin'),
            'role' => 1,
            'phone' => '',
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%users}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m191016_150845_user cannot be reverted.\n";

        return false;
    }
    */
}
