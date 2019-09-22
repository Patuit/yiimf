<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "magazins_authors".
 *
 * @property int $id
 * @property int $id_mag
 * @property int $id_aut
 *
 * @property Authors $aut
 * @property Magazins $mag
 */
class MagazinsAuthors extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'magazins_authors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_mag', 'id_aut'], 'integer'],
            [['id_aut'], 'exist', 'skipOnError' => true, 'targetClass' => Authors::className(), 'targetAttribute' => ['id_aut' => 'id']],
            [['id_mag'], 'exist', 'skipOnError' => true, 'targetClass' => Magazins::className(), 'targetAttribute' => ['id_mag' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_mag' => 'Id Mag',
            'id_aut' => 'Id Aut',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAut()
    {
        return $this->hasOne(Authors::className(), ['id' => 'id_aut']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMag()
    {
        return $this->hasOne(Magazins::className(), ['id' => 'id_mag']);
    }
}
