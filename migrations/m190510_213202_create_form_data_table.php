<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%form_data}}`.
 */
class m190510_213202_create_form_data_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%form_data}}', [
            'id' => $this->primaryKey(),
            'parameters' => $this->text()->notNull(),
            'result' => $this->string(255),
            'browser' => $this->text(),
            'created_at' => $this->dateTime()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%form_data}}');
    }
}
