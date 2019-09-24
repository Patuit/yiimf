<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "authors".
 *
 * @property int $id
 * @property string $name
 * @property string $second_name
 * @property string $third_name
 *
 * @property MagazinsAuthors[] $magazinsAuthors
 */
class Authors extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'authors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'second_name', 'third_name'], 'string', 'max' => 255],
            [['name', 'second_name'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'second_name' => 'Second Name',
            'third_name' => 'Third Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMagazinsAuthors()
    {
        return $this->hasMany(MagazinsAuthors::className(), ['id_aut' => 'id']);
    }

}
