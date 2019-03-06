<?php

namespace backend\modules\courses\models;

use Yii;

/**
 * This is the model class for table "courses".
 *
 * @property int $courseId
 * @property int $sem_id
 * @property string $name
 * @property string $description
 * @property int $createdBy
 * @property int $updatedBy
 * @property string $createdDate
 * @property string $updatedDate
 * @property string $status
 */
class Courses extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
	public $sem_name;
    public static function tableName()
    {
        return 'courses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'name', 'description', 'createdBy', 'updatedBy', 'createdDate', 'updatedDate', 'status'], 'required'],
          //  [['sem_id', 'createdBy', 'updatedBy'], 'integer'],
            [['description', 'status'], 'string'],
            [['createdDate', 'updatedDate'], 'safe'],
            [['name'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'courseId' => 'Course ID',
            'sem_id' => 'Semester Name',
            'name' => 'Course Name',
            'description' => 'Course Description',
            'createdBy' => 'Created By',
            'updatedBy' => 'Updated By',
            'createdDate' => 'Created Date',
            'updatedDate' => 'Updated Date',
            'status' => 'Status',
        ];
    }
}
