<?php

namespace backend\modules\courses\models;

use Yii;

/**
 * This is the model class for table "courses_master".
 *
 * @property int $courseId
 * @property string $courseName
 * @property string $description
 * @property string $content
 * @property string $courseImage
 * @property string $attachmentUrl
 * @property string $fileType
 * @property string $status
 * @property int $createdBy
 * @property int $updatedBy
 * @property string $createdDate
 * @property string $updatedDate
 */
class CoursesMaster extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'courses_master';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['courseName', 'description', 'content', 'courseImage', 'attachmentUrl', 'fileType', 'status', 'createdBy', 'updatedBy', 'createdDate', 'updatedDate'], 'required'],
            [['description', 'content', 'courseImage', 'attachmentUrl', 'status'], 'string'],
            [['createdBy', 'updatedBy'], 'integer'],
            [['createdDate', 'updatedDate'], 'safe'],
            [['courseName', 'fileType'], 'string', 'max' => 200],
        	[['courseName', 'description', 'content', 'courseImage', 'attachmentUrl', 'fileType', 'status', 'createdBy', 'updatedBy', 'createdDate', 'updatedDate'], 'safe'],
        	['attachmentUrl', 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf,docx,doc','maxSize' => 1024 * 1024 * 1],
        	[['courseImage'],'file','extensions' => 'gif, jpg, png'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'courseId' => 'Course ID',
            'courseName' => 'Course Name',
            'description' => 'Description',
            'content' => 'Content',
            'courseImage' => 'Course Image',
            'attachmentUrl' => 'Documents',
            'fileType' => 'File Type',
            'status' => 'Status',
            'createdBy' => 'Created By',
            'updatedBy' => 'Updated By',
            'createdDate' => 'Created Date',
            'updatedDate' => 'Updated Date',
        ];
    }
}
