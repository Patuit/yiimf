<?php

use yii\db\Migration;

/**
 * Class m190925_191115_update_authors_table
 */
class m190925_191115_update_authors_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('authors', ['name', 'second_name', 'third_name'], [
            [
                'Анна',
                'Винтур',
                '',
            ],
            [
                'Эдвард',
                'Эннинфул',
                '',
            ],
            [
                'Максим',
                'Амелин',
                'Альбертович',
            ],
            [
                'Андрей',
                'Битов',
                'Георгиевич',
            ],
            [
                'Александр',
                'Генис',
                'Александрович',
            ],
            [
                'Анатолий',
                'Азольский',
                'Алексеевич',
            ],
            [
                'Станислав',
                'Рассадин',
                'Борисович',
            ],
            [
                'Владимир',
                'Микушевич',
                'Борисович',
            ],
            [
                'Владимир',
                'Салимон',
                'Иванович',
            ],
            [
                'Александр',
                'Иванов',
                'Александрович',
            ],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190925_191115_update_authors_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190925_191115_update_authors_table cannot be reverted.\n";

        return false;
    }
    */
}
