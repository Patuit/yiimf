<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%magazins_authors}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%magazins}}`
 * - `{{%authors}}`
 */
class m190921_160811_create_magazins_authors_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%magazins_authors}}', [
            'id' => $this->primaryKey(),
            'id_mag' => $this->smallInteger(),
            'id_aut' => $this->smallInteger(),
        ]);
        $this->alterColumn('{{%magazins_authors}}', 'id', $this->smallInteger(11).' NOT NULL AUTO_INCREMENT');

        // creates index for column `id_mag`
        $this->createIndex(
            '{{%idx-magazins_authors-id_mag}}',
            '{{%magazins_authors}}',
            'id_mag'
        );

        // add foreign key for table `{{%magazins}}`
        $this->addForeignKey(
            '{{%fk-magazins_authors-id_mag}}',
            '{{%magazins_authors}}',
            'id_mag',
            '{{%magazins}}',
            'id',
            'CASCADE'
        );

        // creates index for column `id_aut`
        $this->createIndex(
            '{{%idx-magazins_authors-id_aut}}',
            '{{%magazins_authors}}',
            'id_aut'
        );

        // add foreign key for table `{{%authors}}`
        $this->addForeignKey(
            '{{%fk-magazins_authors-id_aut}}',
            '{{%magazins_authors}}',
            'id_aut',
            '{{%authors}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%magazins}}`
        $this->dropForeignKey(
            '{{%fk-magazins_authors-id_mag}}',
            '{{%magazins_authors}}'
        );

        // drops index for column `id_mag`
        $this->dropIndex(
            '{{%idx-magazins_authors-id_mag}}',
            '{{%magazins_authors}}'
        );

        // drops foreign key for table `{{%authors}}`
        $this->dropForeignKey(
            '{{%fk-magazins_authors-id_aut}}',
            '{{%magazins_authors}}'
        );

        // drops index for column `id_aut`
        $this->dropIndex(
            '{{%idx-magazins_authors-id_aut}}',
            '{{%magazins_authors}}'
        );

        $this->dropTable('{{%magazins_authors}}');
    }
}
