<?php

use yii\db\Migration;

/**
 * Migration creates tables: 'user', 'country', 'region', 'city'.
 */
class m170222_130014_init extends Migration
{
    /** {@inheritDoc} */
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'password_hash' => $this->string()->notNull(),
            'access_token' => $this->string(32)->notNull()->unique(),
        ]);

        $this->createTable('country', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
        ]);

        $this->createTable('region', [
            'id' => $this->primaryKey(),
            'country_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
        ]);
        $this->createIndex('region_country_id', 'region', 'country_id');

        $this->createTable('city', [
            'id' => $this->primaryKey(),
            'region_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
        ]);
        $this->createIndex('city_region_id_name', 'city', ['region_id', 'name'], true);
    }

    /** {@inheritDoc} */
    public function down()
    {
        $this->dropTable('city');
        $this->dropTable('region');
        $this->dropTable('country');
        $this->dropTable('user');
    }
}
