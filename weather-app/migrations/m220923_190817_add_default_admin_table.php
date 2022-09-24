<?php


use yii\db\Migration;

/**
 * Class m220923_190817_add_default_admin_table
 */
class m220923_190817_add_default_admin_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $transaction = $this->getDb()->beginTransaction();
        $user = \Yii::createObject([
            'class' => \app\models\User::className(),
            'username' => 'admin',
            'password' => 'admin@123',
            'auth_key' => 'admins6d5ZwZvwgYloM6d6d6serIL987',
            'access_token' => 'adminVWK7R2G78GPAVBRgMHHChCXnAdu',
            'role' => \app\models\User::ROLE_ADMIN,
            'verified' => 1,
        ]);
        if (!$user->insert(false)) {
            $transaction->rollBack();
            return false;
        }
        $transaction->commit();
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220923_190817_add_default_admin_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220923_190817_add_default_admin_table cannot be reverted.\n";

        return false;
    }
    */
}
