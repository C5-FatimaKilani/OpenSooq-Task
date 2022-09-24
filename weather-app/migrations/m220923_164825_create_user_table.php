<?php


use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m220923_164825_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->unique(),
            'password' => $this->string(),
            'auth_key' => $this->string(),
            'access_token' => $this->text(),
            'role' => $this->integer()->defaultValue(\app\models\User::ROLE_USER),
            'verified' => $this->boolean()->defaultValue(true),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
