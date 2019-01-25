<?php

namespace backend\modules\workshop\models;

use Yii;

/**
 * This is the model class for table "workshop".
 *
 * @property int $wId
 * @property string $name
 * @property string $description
 * @property string $from_date
 * @property string $to_date
 * @property int $ceatedBy
 * @property int $updatedBy
 * @property string $createdDate
 * @property string $updatedDate
 * @property string $status
 */
class Workshop extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'workshop';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'from_date', 'to_date', 'createdBy', 'updatedBy', 'createdDate', 'updatedDate', 'status','city'], 'required'],
            [['description', 'status'], 'string'],
            [['from_date', 'to_date', 'createdDate', 'updatedDate','city'], 'safe'],
            [['createdBy', 'updatedBy'], 'integer'],
            [['name'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'wId' => 'WID',
            'name' => 'Workshop Name',
            'description' => 'Workshop Description',
            'from_date' => 'From Date',
            'to_date' => 'To Date',
            'ceatedBy' => 'Ceated By',
            'updatedBy' => 'Updated By',
            'createdDate' => 'Created Date',
            'updatedDate' => 'Updated Date',
            'status' => 'Status',
        		'city' =>'City'
        ];
    }
}
