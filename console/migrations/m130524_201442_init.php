<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    /** {@inheritDoc} */
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
        ]);
    }

    /** {@inheritDoc} */
    public function down()
    {
        $this->dropTable('user');
    }
}
