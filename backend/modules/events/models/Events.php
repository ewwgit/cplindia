<?php

namespace backend\modules\events\models;

use Yii;

/**
 * This is the model class for table "events".
 *
 * @property int $event_id
 * @property string $event_name
 * @property string $event_date
 * @property int $createdBy
 * @property int $updatedBy
 * @property string $createdDate
 * @property string $updatedDate
 */
class Events extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'events';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['event_name', 'event_date', 'createdBy', 'updatedBy', 'createdDate'], 'required'],
            [['event_date', 'createdDate', 'updatedDate'], 'safe'],
            [['createdBy', 'updatedBy'], 'integer'],
            [['event_name'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'event_id' => 'Event ID',
            'event_name' => 'Event Name',
            'event_date' => 'Event Date',
            'createdBy' => 'Created By',
            'updatedBy' => 'Updated By',
            'createdDate' => 'Created Date',
            'updatedDate' => 'Updated Date',
        ];
    }
}
