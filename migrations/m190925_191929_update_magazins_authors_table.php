<?php

use yii\db\Migration;

/**
 * Class m190925_191929_update_magazins_authors_table
 */
class m190925_191929_update_magazins_authors_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('magazins_authors', ['id_mag', 'id_aut'], [
            [
                '1',
                '1',
            ],
            [
                '1',
                '2',
            ],
            [
                '2',
                '2',
            ],
            [
                '2',
                '1',
            ],
            [
                '2',
                '6',
            ],
            [
                '3',
                '5',
            ],
            [
                '4',
                '3',
            ],
            [
                '5',
                '10',
            ],
            [
                '6',
                '9',
            ],
            [
                '7',
                '8',
            ],
            [
                '9',
                '7',
            ],
            [
                '10',
                '6',
            ],
            [
                '10',
                '4',
            ],
            [
                '9',
                '5',
            ],
            [
                '8',
                '8',
            ],
            [
                '7',
                '4',
            ],
            [
                '6',
                '8',
            ],
            [
                '5',
                '2',
            ],
            [
                '7',
                '9',
            ],
            [
                '2',
                '7',
            ],
            [
                '4',
                '10',
            ]
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190925_191929_update_magazins_authors_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190925_191929_update_magazins_authors_table cannot be reverted.\n";

        return false;
    }
    */
}
