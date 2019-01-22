<?php

namespace backend\modules\subject\models;

use Yii;

/**
 * This is the model class for table "subjects".
 *
 * @property int $subId
 * @property string $name
 * @property string $description
 * @property string $attachmentUrl
 * @property int $createdBy
 * @property int $updatedBy
 * @property string $createdDate
 * @property string $updatedDate
 */
class Subjects extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subjects';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['courseId','name', 'description','createdBy', 'updatedBy', 'createdDate', 'updatedDate','fileType'], 'required'],
          [['attachmentUrl'], 'required','on'=>'create'],
            [['createdBy', 'updatedBy'], 'integer'],
            [['createdDate', 'updatedDate'], 'safe'],
            [['name', 'description'], 'string', 'max' => 250],
        	['attachmentUrl', 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf,docx,doc','maxSize' => 1024 * 1024 * 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'subId' => 'Sub ID',
            'name' => 'Name',
            'description' => 'Description',
            'attachmentUrl' => 'Attachment Url',
            'createdBy' => 'Created By',
            'updatedBy' => 'Updated By',
            'createdDate' => 'Created Date',
            'updatedDate' => 'Updated Date',
        ];
    }
}
