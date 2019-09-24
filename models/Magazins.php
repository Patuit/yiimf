<?php

namespace app\models;

use Yii;
use app\models\MagazinsAuthors;

/**
 * This is the model class for table "magazins".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $image
 * @property string $date
 *
 * @property MagazinsAuthors[] $magazinsAuthors
 */
class Magazins extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'magazins';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['date'], 'safe'],
            [['title', 'image'], 'string', 'max' => 255],
            [['title'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'image' => 'Image',
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMagazinsAuthors()
    {
        return $this->hasMany(MagazinsAuthors::className(), ['id_mag' => 'id']);
    }
}
