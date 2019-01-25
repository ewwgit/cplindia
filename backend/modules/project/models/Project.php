<?php

namespace backend\modules\project\models;

use Yii;

/**
 * This is the model class for table "project".
 *
 * @property int $projectId
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
class Project extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'from_date', 'to_date', 'createdBy', 'updatedBy', 'createdDate', 'updatedDate', 'status'], 'required'],
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
            'projectId' => 'Project ID',
            'name' => 'Project Name',
            'description' => 'Project Description',
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
