<?php

namespace backend\modules\semisters\models;

use Yii;

/**
 * This is the model class for table "semisters".
 *
 * @property int $sem_id
 * @property string $name
 * @property string $description
 * @property string $from_date
 * @property string $to_date
 * @property int $createdBy
 * @property int $updatedBy
 * @property string $createdDate
 * @property string $updatedDate
 * @property string $status
 */
class Semisters extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'semisters';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'from_date', 'to_date','status'], 'required'],
        	[['name', 'description','status'], 'safe'],
            [['description', 'status'], 'string'],
            [['from_date', 'to_date', 'createdDate', 'updatedDate'], 'safe'],
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
            'sem_id' => 'Sem ID',
            'name' => 'Semester Name',
            'description' => 'Semester Description',
            'from_date' => 'From Date',
            'to_date' => 'To Date',
            'createdBy' => 'Created By',
            'updatedBy' => 'Updated By',
            'createdDate' => 'Created Date',
            'updatedDate' => 'Updated Date',
            'status' => 'Status',
        ];
    }
}
