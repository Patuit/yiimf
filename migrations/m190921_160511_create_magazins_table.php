<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%magazins}}`.
 */
class m190921_160511_create_magazins_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%magazins}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'description' => $this->text(),
            'image' => $this->string(),
            'date' => $this->date(),
        ]);
        $this->alterColumn('{{%magazins}}', 'id', $this->smallInteger(11).' NOT NULL AUTO_INCREMENT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%magazins}}');
    }
}
